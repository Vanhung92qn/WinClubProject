# Client domain cũ → sieuno.online & trạng thái dịch vụ

## 1. Domain / URL cũ đang nằm ở đâu (để bạn thay)

### 1.1 `client` — Cocos (quan trọng nhất)

| Vị trí | Nội dung điển hình |
|--------|---------------------|
| [`client/assets/scripts/common/Configs.ts`](../client/assets/scripts/common/Configs.ts) | `CONFIG_URL` → GitHub `production.json`; `DOMAIN` / `API` mặc định `demo.sieuno.online`, `sieuno.online`; `BUNDLE_URL` `sieuno.online`; các link `honghunghoi.net`; mảng `HOST_*` subdomain `*.sieuno.online` |
| [`client/assets/scripts/common/VersionConfig.ts`](../client/assets/scripts/common/VersionConfig.ts) | `DOMAIN_LOCAL`, `DOMAIN_DEV`, `DOMAIN_PRO` = `bon.tips` / IP cũ; **`ENV` mặc định = `ENV_LOCAL`** |
| [`client/assets/Loading/src/LoadingController.ts`](../client/assets/Loading/src/LoadingController.ts) | Sau khi tải JSON từ `CONFIG_URL`, ghi `localStorage`: `DOMAIN_GAME_PROD` = `data['production']` (chỉ **hostname**, không có `https://`) |
| [`client/assets/Script/GameChecker.ts`](../client/assets/Script/GameChecker.ts) | Fallback `DOMAIN_GAME_PROD` hardcode **`bon.tips`** (nếu dùng scene này) |

**Luồng Web production thực tế:** build web đọc `CONFIG_URL` → nhận JSON → set `DOMAIN_GAME_PROD` → `Configs.App.init()` với `VersionConfig.ENV === ENV_PROD` → API = `https://{DOMAIN_GAME_PROD}/api-portal`, WebSocket = `wss://{DOMAIN_GAME_PROD}/socket-client/{context}` (context ví dụ `minigame`, `taixiu`).

**Để chạy với `play.sieuno.online`:**

1. Đặt **`VersionConfig.ENV = VersionConfig.ENV_PROD`** trong [`VersionConfig.ts`](../client/assets/scripts/common/VersionConfig.ts) (bản build đưa lên server).
2. Host file JSON giống [`docs/examples/client-production.json`](examples/client-production.json) — chỉnh `bundleUrl` / `hotupdateUrl` theo chỗ bạn thật sự phục vụ bundle.
3. Trỏ **`Configs.App.CONFIG_URL`** tới URL JSON đó (ví dụ `https://sieuno.online/production.json` hoặc `https://play.sieuno.online/production.json`), **hoặc** dùng cùng file trên GitHub repo của bạn.
4. Đảm bảo Nginx có đủ `location /socket-client/...` khớp từng game (snippet hiện tại bám [`vic68.win`](../sites-available/vic68.win); game **OverUnder** có thể cần thêm location nếu client dùng `HOST_TAI_XIU_MINI2` — hiện **chưa** set trong `LoadingController`).

### 1.2 Local / test nhanh

- **`ENV_LOCAL`**: dùng `VersionConfig.DOMAIN_LOCAL` + **port** trực tiếp (1644, 2044, …) — không qua `/socket-client/` trên 443.
- Test qua Nginx giống production: dùng **`ENV_PROD`** + `DOMAIN_GAME_PROD=play.sieuno.online` + context `minigame`, `taixiu`, …

### 1.3 CMS (PHP)

- Thư mục [`cms/`](../cms/) — **PHP + Composer**, không phải Node port 3002.
- Nginx mẫu `adp.sieuno.online` → `127.0.0.1:3002` là **stack khác** (thường Node admin). Muốn dùng CMS PHP: cần `php-fpm` + `root`/`location` tới `cms/public` (hoặc chỉnh lại vhost).

---

## 1.4 API Portal — đăng ký / kiểm tra (đọc `errorCode` đúng cách)

**Quan trọng:** Với **`c=1` (đăng ký nhanh)**, phản hồi **`"success": true` và `"errorCode": "0"`** = **đã tạo user trong DB** — không phải lỗi. Bước tiếp theo trong game là **`c=5`** (đặt nickname + nhận token) hoặc **`c=3`** đăng nhập (nếu chưa có nick sẽ trả **`2001`**).

| API | Ý nghĩa tóm tắt |
|-----|------------------|
| **`c=17`**, `tp=1`, `data=<nickname>` | `success: true` + **`1100`** = nickname **chưa ai dùng**. `success: false` + **`1010`** = nickname **đã tồn tại** (đổi nick khác). |
| **`c=17`**, `tp=0`, `data=<username>` | `success: true` + **`1111`** = username **còn trống**. `success: false` + **`1010`** = username **đã có** — đừng nhầm với mã nick. |
| **`c=1`** đăng ký | `success: true` + **`errorCode: "0"`** = **đăng ký thành công**. **`1006`** = **username đã tồn tại** (chọn `un` khác, hoặc đăng nhập). |
| **`c=5`** đặt nick | Cần sau `c=1`; thành công thì có `accessToken` / `sessionKey`. **`1013`** = tài khoản **đã có nickname** (có thể bỏ qua và đăng nhập `c=3`). |

`c=17` **không** trả `accessToken` — đó là API kiểm tra, không phải đăng nhập.

**Đăng ký xong mà client “tắt” sau ~10s, nick lần sau báo đã tồn tại:** thường là **`c=5` đã chạy xong trên server** nhưng trình duyệt **timeout / lỗi parse / mất gói** — nick đã ghi DB. Client đã có **recover**: `Http.get` gọi `c=5` với **timeout 120s**, `quiet` (không popup Connection Error trùng), và khi lỗi mạng gọi `UPDATE_NICKNAME_SUCCESS` → lobby **`actLogin`**. Nếu nick đã gán, đăng nhập thành công; nếu chưa, nhận `2001` và popup đặt nick.

---

## 2. Trên VPS hiện đang chạy gì? (đăng nhập / game / CMS)

| Thành phần | Trạng thái điển hình trên VPS |
|------------|-------------------------------|
| **Docker** MySQL, Mongo, Redis, RabbitMQ | Đã chạy (stack DB/message/cache) |
| **Hazelcast** | Cần `docker/config/hazelcast/hazelcast.xml` tương thích image **3.9** (đã bổ sung bản minimal) |
| **VinPlay Portal API :8081** | **Chưa** thấy process lắng nghe → **đăng nhập / đăng ký HTTP chưa hoạt động** cho tới khi bạn start JAR + `config` đúng DB |
| **BitZero từng game** (1644, 2044, …) | **Chưa** thấy port → **game real-time chưa chạy** |
| **Node :3002 / :3003** (admin/agent) | **Chưa** thấy → **chưa** tương đương CMS PHP |
| **Nginx + TLS** | Đã phục vụ static + reverse proxy tới backend **localhost** |

**Kết luận:** Infrastructure nền đã sẵn; **ứng dụng Java game + Portal + CMS chưa được khởi chạy và cấu hình xong** — chưa thể xác nhận “đăng nhập / đăng ký / full game / admin” cho tới khi từng service được start và trỏ config về MySQL/Mongo/Redis/RabbitMQ/Hazelcast trong Docker.

---

## 3. Checklist cấu hình tiếp (ngắn gọn)

1. **Portal** — tìm JAR/main class VinPlayPortal trong `server/api/VinPlayPortal`, chạy với `config/api_portal.xml` (port 8081), JVM 8/11, biến môi trường nếu có.
2. **Từng game** — JAR trong `server/game/<tên>/build/libs/`, mỗi game `config/*.properties` trỏ `localhost:3306`, Mongo, Rabbit, Hazelcast `127.0.0.1:5701` (và group/password khớp `.env`).
3. **Systemd** — một unit mỗi dịch vụ (`Restart=always`).
4. **Client** — `ENV_PROD` + `production.json` + `CONFIG_URL`; build **web-mobile** → deploy `/var/www/winclub/play/web-mobile`.
5. **CMS** — quyết định Node admin (3002) hay PHP `cms/`; chỉnh vhost cho khớp.

Chi tiết triển khai web: [`SETUP-WEB-PRODUCTION.md`](SETUP-WEB-PRODUCTION.md).
