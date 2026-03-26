package game.tele;

import com.mongodb.client.FindIterable;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoCursor;
import com.mongodb.client.MongoDatabase;
import com.mongodb.client.result.UpdateResult;
import game.ContextHolder;
import game.dto.data.UserTele;
import game.repository.MongoDBConnectionFactory;
import okhttp3.*;
import org.apache.commons.lang3.RandomStringUtils;
import org.bson.Document;
import org.json.JSONArray;
import org.json.JSONObject;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.telegram.telegrambots.bots.TelegramLongPollingBot;
import org.telegram.telegrambots.meta.api.methods.send.SendMessage;
import org.telegram.telegrambots.meta.api.objects.CallbackQuery;
import org.telegram.telegrambots.meta.api.objects.Contact;
import org.telegram.telegrambots.meta.api.objects.Message;
import org.telegram.telegrambots.meta.api.objects.Update;

import javax.annotation.PostConstruct;
import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;
import java.nio.charset.StandardCharsets;
import java.security.SecureRandom;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Iterator;
import java.util.Objects;
import java.util.Queue;
import java.util.concurrent.*;

@Service
public class TeleAuthentication extends TelegramLongPollingBot {

    private static final String TELEGRAM_API_URL = "https://api.telegram.org/bot8684178141:AAEFo8e2Nx-S_3h4vdcbGZjfuMuRaOS5aEI/sendMessage";
    private static final String GAME_NAME = "WINCLUB";
    private static final String GAME_LINK = "https://play.sieuno.online/";

    private static final String BTN_SEND_PHONE = "\uD83D\uDCF1 Gui so dien thoai";
    private static final String BTN_GET_OTP    = "\uD83D\uDD10 Lay ma OTP";

    private final OkHttpClient client = new OkHttpClient.Builder()
            .connectTimeout(3, TimeUnit.SECONDS)
            .writeTimeout(3, TimeUnit.SECONDS)
            .readTimeout(3, TimeUnit.SECONDS)
            .build();
    private SecureRandom random = new SecureRandom();
    static final int RATE_LIMIT = 30;
    public static final int THREAD_POOL_SIZE = 10;
    public static final LinkedBlockingQueue<Integer> blockingQueue = new LinkedBlockingQueue<>(RATE_LIMIT);
    public static final ScheduledExecutorService rateLimitScheduler = Executors.newSingleThreadScheduledExecutor();
    public static Queue<TeleMessageProcess> messageQueue = new ConcurrentLinkedQueue<>();
    public static final ScheduledExecutorService messageScheduler = Executors.newScheduledThreadPool(10);

    public TeleAuthentication() {
        super();
    }

    @PostConstruct
    public void init() {
        rateLimitScheduler.scheduleAtFixedRate(() -> {
            for (int i = 0; i < RATE_LIMIT; i++) {
                if (blockingQueue.size() == RATE_LIMIT) {
                    break;
                }
                blockingQueue.add(i);
            }
        }, 0, 1, TimeUnit.SECONDS);

        for (int i = 0; i < THREAD_POOL_SIZE; i++) {
            messageScheduler.execute(() -> {
                TeleMessageProcess messageProcess;
                while (true) {
                    messageProcess = messageQueue.poll();
                    if (messageProcess != null) {
                        try {
                            messageProcess.execute();
                        } catch (Exception ex) {
                            ex.printStackTrace();
                        }
                    } else {
                        try {
                            Thread.sleep(100);
                        } catch (InterruptedException e) {
                            throw new RuntimeException(e);
                        }
                    }
                }
            });
        }
    }

    // ======================== DISPATCHER ========================

    @Override
    public void onUpdateReceived(Update update) {
        if (update.hasMessage() && update.getMessage().hasText()) {
            Message message = update.getMessage();
            String chatId = message.getChatId().toString();
            UserTele u = getInfoByChatID(chatId);
            String text = message.getText();

            if (text.contains("/start")) {
                handleStart(message, chatId, u);
            } else if (text.equals(BTN_GET_OTP) || text.contains("Lay ma OTP") || text.contains("LAY MA OTP")
                    || text.equals("Lấy lại mã kích hoạt") || text.equals("LAY LAI MA OTP")) {
                handleGetOTP(chatId, u);
            }
        } else if (update.hasCallbackQuery()) {
            CallbackQuery callbackQuery = update.getCallbackQuery();
            String chatId = callbackQuery.getMessage().getChatId().toString();
            if ("get_otp".equals(callbackQuery.getData())) {
                handleGetOTP(chatId, getInfoByChatID(chatId));
            }
        } else if (update.hasMessage() && update.getMessage().hasContact()) {
            Contact contact = update.getMessage().getContact();
            String phoneNumber = contact.getPhoneNumber();
            String chatId = String.valueOf(update.getMessage().getChatId());
            handlePhoneNumber(chatId, phoneNumber);
        }
    }

    // ======================== HANDLERS ========================

    private void handleStart(Message message, String chatId, UserTele u) {
        String[] parts = message.getText().split("\\s+");
        String nickname = null;

        if (parts.length > 1) {
            nickname = parts[1];
        } else if (u != null) {
            nickname = u.getNickname();
        }

        if (nickname == null || nickname.isEmpty()) {
            sendTextMessage(chatId,
                    brandHeader()
                            + "Vui lòng mở link kích hoạt từ game.\n"
                            + brandFooter());
            return;
        }

        if (u != null && !Objects.equals(u.getNickname(), nickname) && u.isActive()) {
            sendTextMessage(chatId,
                    brandHeader()
                            + "Telegram này đã liên kết với tài khoản <b>" + u.getNickname() + "</b>.\n"
                            + "Vui lòng sử dụng Telegram khác.\n"
                            + brandFooter());
            return;
        }

        if (u == null) {
            saveUserInfo(nickname, chatId);
            u = getInfoByChatID(chatId);
        } else if (!Objects.equals(u.getNickname(), nickname)) {
            updateNickname(chatId, nickname);
            u = getInfoByChatID(chatId);
        }

        if (u != null && u.isActive()) {
            sendActivatedMenu(chatId, nickname);
        } else {
            sendActivationMenu(chatId,
                    brandHeader()
                            + "Xin Chào <b>" + nickname + "</b>!\n\n"
                            + "Để kích hoạt bảo mật tài khoản, vui lòng:\n"
                            + "1. Nhấn nút <b>'" + BTN_SEND_PHONE + "'</b> bên dưới\n"
                            + "2. Chia sẻ số điện thoại để nhận mã OTP\n"
                            + "3. Nhập OTP vào game để hoàn tất\n\n"
                            + brandFooter());
        }
    }

    /**
     * Unified OTP handler — works for both activation resend and transaction OTP
     */
    private void handleGetOTP(String chatId, UserTele u) {
        if (u == null) {
            sendTextMessage(chatId,
                    brandHeader()
                            + "Vui lòng mở link từ game để kích hoạt.\n"
                            + brandFooter());
            return;
        }

        if (!u.isActive()) {
            if (u.getPhoneNumber() == null || u.getPhoneNumber().isEmpty()) {
                sendActivationMenu(chatId,
                        brandHeader()
                                + "Bạn chưa xác thực số điện thoại.\n"
                                + "Vui lòng nhấn <b>'" + BTN_SEND_PHONE + "'</b> trước.\n"
                                + brandFooter());
            } else {
                String otp = generateOTP();
                saveOTP(chatId, otp);
                saveOTPPhone(u.getNickname(), otp, u.getPhoneNumber());
                sendActivationOTP(chatId, otp);
            }
            return;
        }

        String otp = generateOTP();
        saveOTP(chatId, otp);
        saveOTPPhone(u.getNickname(), otp, u.getPhoneNumber());
        sendTransactionOTP(chatId, otp);
    }

    private void handlePhoneNumber(String chatId, String phoneNumber) {
        if (phoneNumber != null) {
            phoneNumber = phoneNumber.trim();
            if (phoneNumber.startsWith("+")) {
                phoneNumber = phoneNumber.replace("+", "");
            }
        }
        try {
            UserTele userTele = getInfoByChatID(chatId);
            if (userTele == null) {
                sendTextMessage(chatId,
                        brandHeader()
                                + "Vui long mo link kich hoat tu game truoc.\n"
                                + brandFooter());
                return;
            }

            if (userTele.isActive()) {
                sendActivatedMenu(chatId, userTele.getNickname());
                return;
            }

            String storedPhone = getPhoneByNickname(userTele.getNickname());
            if (!storedPhone.isEmpty() && !normalizePhoneNumber(storedPhone).equals(normalizePhoneNumber(phoneNumber))) {
                sendTextMessage(chatId,
                        brandHeader()
                                + "So dien thoai khong khop voi SDT da dang ky trong game (<b>" + userTele.getNickname() + "</b>).\n"
                                + "Vui long dung dung SDT da nhap trong game.\n"
                                + brandFooter());
                return;
            }

            savePhone(chatId, phoneNumber);
            String otp = generateOTP();
            saveOTP(chatId, otp);
            saveOTPPhone(userTele.getNickname(), otp, phoneNumber);
            sendActivationOTP(chatId, otp);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    // ======================== UI: KEYBOARDS & MESSAGES ========================

    private String brandHeader() {
        return "============================\n"
                + "      \uD83C\uDFAE <b>" + GAME_NAME + "</b> \uD83C\uDFAE\n"
                + "         Game Chính Hãng\n"
                + "============================\n\n";
    }

    private String brandFooter() {
        return "\n\uD83C\uDF10 " + GAME_LINK;
    }

    /** Keyboard for unactivated users — share phone button */
    private void sendActivationMenu(String chatId, String text) {
        JSONArray keyboard = new JSONArray();

        JSONObject phoneButton = new JSONObject();
        phoneButton.put("text", BTN_SEND_PHONE);
        phoneButton.put("request_contact", true);
        keyboard.put(new JSONArray().put(phoneButton));

        sendKeyboardMessage(chatId, text, keyboard);
    }

    /** Keyboard for activated users — get OTP button */
    private void sendActivatedMenu(String chatId, String nickname) {
        String text = brandHeader()
                + "\u2705 Tài khoản <b>" + nickname + "</b> đã được bảo mật!\n\n"
                + "Nhấn <b>'" + BTN_GET_OTP + "'</b> khi cần mã OTP giao dịch.\n"
                + brandFooter();

        JSONArray keyboard = new JSONArray();

        JSONObject otpButton = new JSONObject();
        otpButton.put("text", BTN_GET_OTP);
        keyboard.put(new JSONArray().put(otpButton));

        sendKeyboardMessage(chatId, text, keyboard);
    }

    private void sendActivationOTP(String chatId, String otp) {
        String text = brandHeader()
                + "\uD83D\uDCE9 <b>MA KICH HOAT</b>\n\n"
                + "\uD83D\uDD11 Ma OTP: <code>" + otp + "</code>\n"
                + "\u23F0 Hieu luc: 5 phut\n\n"
                + "Nhap ma OTP trong game de hoan tat kich hoat bao mat.\n"
                + brandFooter();
        sendTextMessage(chatId, text);
    }

    private void sendTransactionOTP(String chatId, String otp) {
        String text = brandHeader()
                + "\uD83D\uDCB0 <b>MA OTP GIAO DICH</b>\n\n"
                + "\uD83D\uDD11 Ma OTP: <code>" + otp + "</code>\n"
                + "\u23F0 Hieu luc: 5 phut\n\n"
                + "Nhap ma OTP trong game de xac nhan giao dich.\n"
                + "Khong chia se ma nay voi bat ky ai!\n"
                + brandFooter();
        sendTextMessage(chatId, text);
    }

    // ======================== LOW-LEVEL TELEGRAM API ========================

    private void sendKeyboardMessage(String chatId, String text, JSONArray keyboard) {
        TeleMessageProcess messageProcess = () -> {
            JSONObject replyMarkup = new JSONObject();
            replyMarkup.put("keyboard", keyboard);
            replyMarkup.put("resize_keyboard", true);
            replyMarkup.put("one_time_keyboard", false);

            JSONObject jsonBody = new JSONObject();
            jsonBody.put("chat_id", chatId);
            jsonBody.put("text", text);
            jsonBody.put("parse_mode", "HTML");
            jsonBody.put("reply_markup", replyMarkup);

            RequestBody body = RequestBody.create(
                    MediaType.get("application/json; charset=utf-8"),
                    jsonBody.toString()
            );
            Request request = new Request.Builder()
                    .url(TELEGRAM_API_URL)
                    .post(body)
                    .build();
            Response response = null;
            try {
                String traceId = RandomStringUtils.randomNumeric(10);
                System.out.println("Waiting TPS..." + traceId);
                if (blockingQueue.poll(10, TimeUnit.SECONDS) != null) {
                    System.out.println("Send message..." + traceId);
                    response = client.newCall(request).execute();
                } else {
                    System.out.println("Send message timeout " + traceId);
                }
            } catch (Exception e) {
                e.printStackTrace();
                throw new RuntimeException(e);
            } finally {
                if (response != null) {
                    response.close();
                }
            }
        };
        messageQueue.add(messageProcess);
    }

    public void sendTextMessage(String chatId, String text) {
        TeleMessageProcess messageProcess = () -> {
            Response response = null;
            try {
                OkHttpClient httpClient = HttpCommon.getInstance().getHttpClient().newBuilder()
                        .connectTimeout(3, TimeUnit.SECONDS)
                        .readTimeout(3, TimeUnit.SECONDS)
                        .build();
                Request request = new Request.Builder()
                        .url(TELEGRAM_API_URL + "?text=" + encodeValue(text)
                                + "&chat_id=" + chatId + "&parse_mode=HTML")
                        .method("GET", null)
                        .build();
                response = httpClient.newCall(request).execute();
            } catch (Exception e) {
                e.printStackTrace();
            } finally {
                if (response != null) {
                    response.close();
                }
            }
        };
        messageQueue.add(messageProcess);
    }

    // keep old name for external callers
    public void sendMessageToUser(String message, String chatId) {
        sendTextMessage(chatId, message);
    }

    // ======================== DATABASE ========================

    public String getPhoneByNickname(String nickname) {
        MongoDBConnectionFactory mongoDBConnectionFactory = ContextHolder.applicationContext.getBean(MongoDBConnectionFactory.class);
        MongoDatabase db = mongoDBConnectionFactory.getDB();
        MongoCollection<Document> collection = db.getCollection("user_phone");
        Document filter = new Document("nickname", nickname);
        FindIterable<Document> result = collection.find(filter);
        Iterator<Document> iterator = result.iterator();
        if (iterator.hasNext()) {
            Document document = iterator.next();
            return document.getString("phone");
        } else {
            return "";
        }
    }

    private UserTele getInfoByChatID(String chatID) {
        MongoDBConnectionFactory mongoDBConnectionFactory = ContextHolder.applicationContext.getBean(MongoDBConnectionFactory.class);
        MongoDatabase db = mongoDBConnectionFactory.getDB();
        MongoCollection<Document> collection = db.getCollection("user_tele");
        Document filter = new Document("chatID", chatID);
        MongoCursor<Document> cursor = collection.find(filter).iterator();
        try {
            if (cursor.hasNext()) {
                Document doc = cursor.next();
                return extractUserInfo(doc);
            } else {
                return null;
            }
        } finally {
            cursor.close();
        }
    }

    private UserTele extractUserInfo(Document doc) {
        String id = doc.getObjectId("_id").toString();
        String nickname = doc.getString("nickname");
        String phoneNumber = doc.getString("phoneNumber");
        boolean isActive = doc.getBoolean("isActive");
        String otp = doc.getString("otp");
        long timeToExpired = doc.getInteger("timeToExpired");
        String createdDate = doc.getString("createdDate");
        String chatID = doc.getString("chatID");
        UserTele user = new UserTele();
        user.setId(id);
        user.setNickname(nickname);
        user.setPhoneNumber(phoneNumber);
        user.setActive(isActive);
        user.setOtp(otp);
        user.setTimeToExpired(timeToExpired);
        user.setCreatedDate(createdDate);
        user.setChatID(chatID);
        return user;
    }

    private void saveUserInfo(String nickname, String chatId) {
        MongoDBConnectionFactory mongoDBConnectionFactory = ContextHolder.applicationContext.getBean(MongoDBConnectionFactory.class);
        MongoDatabase db = mongoDBConnectionFactory.getDB();
        MongoCollection<Document> collection = db.getCollection("user_tele");
        Document document = new Document();
        document.put("nickname", nickname);
        document.put("chatID", chatId);
        document.put("phoneNumber", "");
        document.put("isActive", false);
        document.put("otp", "");
        document.put("timeToExpired", 0);
        DateFormat dateFormat = new SimpleDateFormat("yyyy/MM/dd HH:mm:ss");
        document.put("createdDate", dateFormat.format(new Date()));
        collection.insertOne(document);
    }

    private void updateNickname(String chatId, String nickname) {
        MongoDBConnectionFactory mongoDBConnectionFactory = ContextHolder.applicationContext.getBean(MongoDBConnectionFactory.class);
        MongoDatabase db = mongoDBConnectionFactory.getDB();
        MongoCollection<Document> collection = db.getCollection("user_tele");
        Document filter = new Document("chatID", chatId);
        Document updateDocument = new Document("$set", new Document("nickname", nickname).append("isActive", false).append("phoneNumber", ""));
        collection.updateOne(filter, updateDocument);
    }

    private void saveOTP(String chatId, String otp) {
        MongoDBConnectionFactory mongoDBConnectionFactory = ContextHolder.applicationContext.getBean(MongoDBConnectionFactory.class);
        MongoDatabase db = mongoDBConnectionFactory.getDB();
        MongoCollection<Document> collection = db.getCollection("user_tele");
        Document filter = new Document("chatID", chatId);
        DateFormat dateFormat = new SimpleDateFormat("yyyy/MM/dd HH:mm:ss");
        Date date = new Date();
        Document updateDocument = new Document("$set", new Document("otp", otp).append("timeToExpired", 300000).append("createdDate", dateFormat.format(date)));
        collection.updateOne(filter, updateDocument);
    }

    private void savePhone(String chatId, String phone) {
        if (phone != null) {
            phone = phone.trim();
            if (phone.startsWith("+")) {
                phone = phone.replace("+", "").trim();
            }
        }
        MongoDBConnectionFactory mongoDBConnectionFactory = ContextHolder.applicationContext.getBean(MongoDBConnectionFactory.class);
        MongoDatabase db = mongoDBConnectionFactory.getDB();
        MongoCollection<Document> collection = db.getCollection("user_tele");
        Document filter = new Document("chatID", chatId);
        Document updateDocument = new Document("$set", new Document("phoneNumber", phone));
        collection.updateOne(filter, updateDocument);
    }

    private void saveOTPPhone(String nickname, String otp, String phone) {
        if (phone != null) {
            phone = phone.trim();
            if (phone.startsWith("+")) {
                phone = phone.replace("+", "").trim();
            }
        }
        MongoDBConnectionFactory mongoDBConnectionFactory = ContextHolder.applicationContext.getBean(MongoDBConnectionFactory.class);
        MongoDatabase db = mongoDBConnectionFactory.getDB();
        MongoCollection<Document> collection = db.getCollection("user_phone");
        Document filter = new Document("nickname", nickname);
        DateFormat dateFormat = new SimpleDateFormat("yyyy/MM/dd HH:mm:ss");
        Date date = new Date();
        Document updateDocument = new Document("$set", new Document("otp", otp).append("timeToExpired", 300000).append("createdDate", dateFormat.format(date)).append("phone", phone));
        UpdateResult result = collection.updateOne(filter, updateDocument);
        if (result.getMatchedCount() == 0) {
            Document newDocument = new Document("nickname", nickname).append("isActive", false).append("otp", otp).append("phone", phone).append("timeToExpired", 300000).append("createdDate", dateFormat.format(date));
            collection.insertOne(newDocument);
        }
    }

    private static String normalizePhoneNumber(String phoneNumber) {
        if (phoneNumber == null) {
            return "";
        }
        phoneNumber = phoneNumber.trim().replaceAll("\\s+", " ");
        if (phoneNumber.startsWith("+")) {
            phoneNumber = phoneNumber.substring(1);
        }
        if (phoneNumber.startsWith("84")) {
            phoneNumber = "0" + phoneNumber.substring(2);
        }
        return phoneNumber;
    }

    private String generateOTP() {
        StringBuilder otp = new StringBuilder();
        for (int i = 0; i < 6; i++) {
            otp.append(random.nextInt(10));
        }
        return otp.toString();
    }

    private static String encodeValue(String value) throws UnsupportedEncodingException {
        return URLEncoder.encode(value, StandardCharsets.UTF_8.toString());
    }

    @Override
    public String getBotUsername() {
        return "otpvarder4_bot";
    }

    @Override
    public String getBotToken() {
        return "8684178141:AAEFo8e2Nx-S_3h4vdcbGZjfuMuRaOS5aEI";
    }
}
