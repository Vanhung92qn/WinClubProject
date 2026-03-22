# System Memory & Context Graph

*This file acts as the long-term memory for the AI Agent. It must be updated whenever significant changes occur.*

## Changelog (gần đây)

### 2026-03-21 — Login c=3 mã 1007 dù đúng mật khẩu (CryptoJS + khoảng trắng)

- **Triệu chứng:** Client gửi `pw` mã hóa (AES+base64 lồng), server trả **1007**; cùng user gửi **MD5 32 ký tự** thì **đăng nhập được**.
- **Nguyên nhân:** Sau giải mã OpenSSL-style, plaintext thực tế là **`123456` + khoảng trắng cuối** (EditBox / copy-paste / CryptoJS), `MD5("123456 ")` ≠ `MD5("123456")` trong DB.
- **Fix server:** `WebPasswordNormalizer` — `.trim()` sau `decryptOpenSslStyle` rồi mới `getMD5Hash`.
- **Fix client:** `.trim()` mật khẩu trước khi `md52` / `PortalPassword.forApi` (PopUplogin, LobbyController, PopUploginV2, PopupUpdatePhone, PopupUpdateNicknameSunwin).

### 2026-03-21 — Login c=3 treo vĩnh viễn (kickSession infinite loop)

- **Nguyên nhân:** `PortalUtils.kickSession()` đặt nickname vào Hazelcast map `LOGIN_OTHER_DEVICE_MAP`, gửi signal vào queue `LOGIN_OTHER_DEVICE_QUEUE`, rồi **while-loop chờ game server xóa key**. Không có game server chạy → vòng lặp vĩnh viễn, block thread Jetty.
- **Fix:** Thêm `KICK_TIMEOUT_MS = 5000` — nếu game server không xóa key trong 5s, Portal tự `map.remove()` và tiếp tục login bình thường. File: `server/api/VinPlayPortal/src/main/java/com/vinplay/api/utils/PortalUtils.java`.
- JAR rebuild bằng `javac` + `jar uf`, restart Portal.

### 2026-03-21 — Đăng ký: recover sau `c=5` chậm / mất phản hồi

- **`Http.get`:** tham số 4 `{ timeoutMs, quiet }`; `onerror`/`ontimeout` gọi callback (`done` một lần) để không treo loading; `c=5` đăng ký dùng **120s** + **quiet** (tránh popup Connection Error trùng). **`PopupRegister`:** nếu lỗi mạng/parse/`response == null`/HTTP ≠ 200 → toast + `finishNickFlow()` (broadcast `UPDATE_NICKNAME_SUCCESS` → `actLogin`) vì server có thể đã gán nick. Thông báo khi `c=17` báo nick trùng: gợi ý đăng nhập. Chi tiết: [`CLIENT-AND-OPS-CONFIG.md`](./CLIENT-AND-OPS-CONFIG.md) §1.4.

### 2026-03-21 — Giải thích API đăng ký cho user / QA

- **`c=1`** trả `success: true` + `errorCode: "0"` = **đăng ký đã thành công**; nhiều người nhầm vì chờ token — token có sau **`c=5`** hoặc **`c=3`**. **`1006`** = trùng **username** (`un`), không phải nick. Bảng mã: [`docs/CLIENT-AND-OPS-CONFIG.md`](./CLIENT-AND-OPS-CONFIG.md) §1.4. Client [`PopupRegister.ts`](../client/assets/games/Lobby/src/PopupRegister.ts) hiển thị toast sau bước `c=1` thành công.

### 2026-03-21 — Tài khoản demo DB (`vinplay`)

- User mẫu đăng nhập: **`winclubdemo` / `123456`**, nick **`winclubnick01`**, password DB = MD5(`123456`). SQL: [`docs/DEMO-ACCOUNT.md`](./DEMO-ACCOUNT.md).

### 2026-03-21 — GitHub remote & clone

- Repo Git: `https://github.com/Vanhung92qn/WinClubProject.git` — branch `main`, commit ban đầu trên VPS (push cần PAT/SSH từ máy user). Hướng dẫn clone/push: [`README.md`](../README.md).
- `.gitignore`: thêm `docker/data/` (volume runtime, không đẩy lên Git).

### 2026-03-21 — Client: đăng ký / đặt nick dùng cùng mã hóa mật khẩu như login

- **Vấn đề:** Login (`c=3`) gửi `pw` = CryptoJS AES + base64 (key `12345`); đăng ký (`c=1`) và đặt nick (`c=5`) trước đây dùng `md5()` — server vẫn chấp nhận, nhưng `Http.get` không `encodeURIComponent` nên chuỗi base64 có thể chứa `+`/`/` và làm hỏng query; timeout 10s dễ fail khi `loginSuccess` chậm → **Connection Error** / timeout.
- **Sửa:** [`client/assets/scripts/common/PortalPassword.ts`](../client/assets/scripts/common/PortalPassword.ts) — `forApi()` = cùng thuật toán với `Lobby.PopUplogin.md52`; [`PopupRegister.ts`](../client/assets/games/Lobby/src/PopupRegister.ts) + [`PopupUpdateNickname.ts`](../client/assets/games/Lobby/src/PopupUpdateNickname.ts) dùng `PortalPassword.forApi`, thêm `pf` + `countIdx` cho `c=5`; [`Http.ts`](../client/assets/scripts/common/Http.ts) — `encodeURIComponent` toàn bộ query, timeout GET/POST **45s**, log lỗi console. **`errorCode` 1013** sau đăng ký: coi như đã có nick → `BroadcastReceiver.UPDATE_NICKNAME_SUCCESS` để lobby gọi `actLogin`.

### 2026-03-21 — Đăng ký web: mật khẩu phải trùng chuẩn đăng nhập

- **API `c=17` (CheckRegister):** `success:true` + `errorCode:"1100"` với `tp=1` nghĩa là **nickname chưa bị trùng** — không phải OTP; `accessToken`/`sessionKey` luôn null ở API này.
- **Đăng nhập `c=3`:** `1007` = sai mật khẩu hoặc không có user; **`2001`** = user **chưa có nick_name** (đăng ký nhanh chỉ tạo `user_name`, client cần bước đặt nickname `c=5` trước khi login đầy đủ).
- **Bug đã sửa:** `QuickRegisterProcessor` (`c=1`) trước đây lưu nguyên chuỗi `pw` từ client; web gửi Base64+AES (giống login) nên DB lưu sai → login luôn `1007`. Đã thêm `WebPasswordNormalizer` (giải mã giống `LoginProcessor`, chuẩn hóa MD5) dùng cho **đăng ký, đăng nhập, và đặt nick (`UpdateNicknameProcesscor` / `c=5`)** — trước đó `c=5` so sánh `pw` thô với DB nên client web cũng bị `1007`. Tài khoản tạo **trước** bản sửa mật khẩu vẫn cần đăng ký lại hoặc sửa DB.

### 2026-03-21 — Portal + infra fixes (VPS)

- **MongoDB (Docker dev):** `docker/config/mongod/mongod.conf` bỏ replica set + `keyFile` để entrypoint tạo user `admin` từ `MONGO_INITDB_ROOT_*` trên volume trống. Compose bỏ mount `replset88.key`. Password Portal: `server/api/VinPlayPortal/config/mongo.properties` (khớp `MONGO_INITDB_ROOT_PASSWORD` trong `docker/.env` — **không** dùng biến `MONGO_ROOT_PASSWORD` vì không tồn tại trong `.env`).
- **Redis (Bitnami):** volume `./data/redis` cần quyền ghi user container (`sudo chown -R 1001:1001 docker/data/redis`); nên bật `vm.overcommit_memory=1` trên host.
- **VinPlayPortal:** chạy từ `server/api/VinPlayPortal`: `java -cp "libs/*:build/libs/VinPlayPortal.jar" com.vinplay.api.server.JettyServer` (log có thể ghi `/tmp/portal_run.log` hoặc `logs/`). API kiểm tra: `curl 'http://127.0.0.1:8081/api?c=130&cp=R&cl=R&pf=web&at='`.
- **Tai Xiu Mini:** `server/run_taixiubasic.sh` — `LOG_DIR` mặc định `/var/WinClubProject/server/logs`, `SCRIPT_PATH` theo vị trí script; `sysctl` ưu tiên `sudo`.
- **CMS trên web:** Cài `php8.3-fpm` + pool `/etc/php/8.3/fpm/pool.d/winclub-cms.conf` (socket `/run/php/php8.3-fpm-cms.sock`, env `DB_*`, `BASE_URL`, `API_URL`). Vhost `sites-available/sieuno.online` — khối `adp`/`quantri` serve PHP từ `/var/WinClubProject/cms`. Mẫu pool (không secret): [`cms/deploy/php-fpm-pool-cms.example.conf`](../cms/deploy/php-fpm-pool-cms.example.conf).

### 2025-03-21 — Client domain map & ops status

- **Doc:** [`CLIENT-AND-OPS-CONFIG.md`](./CLIENT-AND-OPS-CONFIG.md) — domain cũ (eloras/bon.tips/honghunghoi), luồng `CONFIG_URL` + `ENV_PROD`, ví dụ [`examples/client-production.json`](./examples/client-production.json).
- **Hazelcast Docker:** `docker/config/hazelcast/hazelcast.xml` dùng schema **3.9** (minimal) khớp image `hazelcast/hazelcast:3.9` (file 3.10 từ `server/env-setup` gây lỗi schema).

### 2025-03-21 — Cloudflare Full (Strict) + Nginx TLS paths

- Site `sieuno.online` dùng chứng chỉ origin tại **`/etc/ssl/cloudflare/sieuno.online.pem`** và **`.key`** (Full Strict cần Origin CA hoặc Let’s Encrypt — xem [`CLOUDFLARE-ORIGIN-SSL.md`](./CLOUDFLARE-ORIGIN-SSL.md)).

### 2025-03-21 — VPS bootstrap (`/var/WinClubProject`)

- Đã cài: `docker.io`, `docker-compose-v2`, `nginx`, `openjdk-11-jdk`, `certbot`.
- Docker Compose infra chạy; **Mongo dev** dùng `mongod.conf` đơn giản (auth, không repl/keyFile) — xem changelog 2026-03-21.
- MySQL: import `mysql/server_orig.sql` qua `docker exec mysql-game-db2`.
- Nginx: snippet + `sites-available/sieuno.online`; TLS tạm **self-signed** tại `/etc/letsencrypt/live/sieuno.online/` — thay bằng Let’s Encrypt trước production.
- `server/gradlew`: sửa CRLF; build JDK 11: thêm JAXB/JAX-WS (`VbeeCommon`, `VinPlayUserCore`, `VinPlayPortal`, `wspay`); sửa comment encoding trong `JettyServer.java`; `chown -R` user build trên `server/` nếu copyJar lỗi quyền.

### 2025-03-21 — Web production setup (sieuno.online)

- **Thêm** [`docs/SETUP-WEB-PRODUCTION.md`](./SETUP-WEB-PRODUCTION.md): quy trình thủ công VPS — Cloudflare, thư mục `/var/www/winclub`, build Cocos web-mobile, Nginx TLS, Certbot SAN, systemd/backend, kiểm tra.
- **Thêm** [`nginx/snippets/winclub-game-routes.inc`](../nginx/snippets/winclub-game-routes.inc): gom `location` API/WebSocket/relay (trích từ mẫu `vic68.win`) để không lặp giữa `play` và landing.
- **Thêm** [`sites-available/sieuno.online`](../sites-available/sieuno.online): vhost mẫu (`play`, landing, admin, agent) + redirect HTTP→HTTPS.
- **Thêm** [`nginx/README.md`](../nginx/README.md): mô tả file nginx trong repo.

### 2025-03-21 — Deep Scan follow-up

- **Thêm** [`docs/ARCHITECTURE.md`](./ARCHITECTURE.md): mô tả stack, Docker services/ports, luồng BitZero (Extension → Module → Cmd/Msg), persistence (MySQL/Mongo/Hazelcast/RMQ), và gợi ý tái cấu trúc.
- **Infra:** [`docker/env-setup-docker-compose.yml`](../docker/env-setup-docker-compose.yml) chuyển secrets và đường dữ liệu có thể cấu hình sang biến môi trường; mẫu khai báo tại [`docker/.env.example`](../docker/.env.example). File [`docker/.env`](../docker/.env) dùng local (gitignored) — bắt buộc `cp docker/.env.example docker/.env` trên môi trường mới.
- **Chạy Compose:** từ root repo dùng `docker compose --env-file docker/.env -f docker/env-setup-docker-compose.yml …` (đã cập nhật [`SETUP.md`](../SETUP.md)). Kiểm tra cú pháp: `docker compose --env-file docker/.env -f docker/env-setup-docker-compose.yml config` (cần Docker CLI trên máy chạy lệnh).

## Context cố định

- **Tên dự án:** WinClub (Game Portal).
- **Ràng buộc Agent:** trước thay đổi cấu trúc đọc `ARCHITECTURE.md` + file này; không đoán mật khẩu/port production; cập nhật changelog khi thêm feature / sửa bug lớn.
- **Live casino:** dữ liệu live qua relay Python (JSON), không HTTP scrape trực tiếp từ Java.
