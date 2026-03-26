import Configs from "../../../../scripts/common/Configs";
import Http from "../../../../core/network/Http";
import ApiIDEnum from "../enum/ApiIDEnum";
import GameURL from "../../../../scripts/common/game/GameURL";

/**
 * LobbyService — thin HTTP layer cho Lobby screen.
 *
 * Trước: LobbyController.ts gọi Http.get() trực tiếp, trộn lẫn API logic với UI logic.
 * Sau:   LobbyController gọi LobbyService, không cần biết c= integer hay params.
 *
 * Tất cả callbacks dùng Node-style: (err, result) — nhất quán với Http.ts.
 */
export default class LobbyService {

    /**
     * Tải URLs mạng xã hội & cấu hình liên kết (c=4112).
     * Kết quả tự cập nhật vào GameURL static fields.
     */
    static getUrlLinks(callback?: (err: Error) => void): void {
        Http.get(Configs.App.API, { c: ApiIDEnum.GET_URL_LINK }, (err, res) => {
            if (err || !res || !res.success) {
                callback && callback(err || new Error(res?.errorCode));
                return;
            }
            if (res.md5)             GameURL.MD5_CHECKER          = res.md5;
            if (res.groupFacebook)   GameURL.GROUP_FACEBOOK        = res.groupFacebook;
            if (res.teleCSKH)        GameURL.CSKH_TELEGRAM         = res.teleCSKH;
            if (res.botTele)         GameURL.BOT_TELEGRAM          = res.botTele;
            if (res.checkLocTele)    GameURL.CHECK_LOC_TELEGRAM    = res.checkLocTele;
            if (res.fanPage)         GameURL.FANPAGE               = res.fanPage;
            if (res.groupTele)       GameURL.TELEGRAM_COMMUNITY    = res.groupTele;
            if (res.liveChat)        GameURL.LIVE_CHAT             = res.liveChat;
            callback && callback(null);
        });
    }

    /**
     * Lấy thông báo hệ thống / secret code (c=4015).
     * Trả về text2 của response (dùng cho marquee/thông báo).
     */
    static getSystemNotice(nickname: string, callback: (err: Error, text?: string) => void): void {
        Http.get(Configs.App.API, { c: 4015, u: nickname }, (err, res) => {
            if (err) { callback(err); return; }
            callback(null, res["text2"]);
        });
    }

    /**
     * Kiểm tra game BanCa có khả dụng không (c=4074, t=49).
     * Dùng trước khi tải scene ShootFish để tránh vào game đang off.
     */
    static checkBancaAvailable(callback: (err: Error) => void): void {
        Http.get(Configs.App.API, { c: 4074, t: 49 }, (err, json) => {
            callback(err || null);
        });
    }

    /**
     * Lấy số mail chưa đọc (c=402).
     * Trả về { mailNotRead: number }.
     */
    static getMailCount(nickname: string, callback: (err: Error, mailNotRead?: number) => void): void {
        Http.get(Configs.App.API, { c: ApiIDEnum.GET_MAIL, nn: nickname, p: 0 }, (err, res) => {
            if (err || !res) { callback(err || new Error("no response")); return; }
            if (res.success) {
                callback(null, res.mailNotRead as number);
            } else {
                callback(null, 0);
            }
        });
    }

    /**
     * Gửi OTP nhanh qua Telegram (c=4125).
     */
    static sendQuickOTP(nickname: string, callback: (err: Error, success?: boolean) => void): void {
        Http.get(Configs.App.API, { c: ApiIDEnum.QUICK_OTP_TELEGRAM, nickname }, (err, res) => {
            if (err) { callback(err); return; }
            callback(null, !!res.success);
        });
    }
}
