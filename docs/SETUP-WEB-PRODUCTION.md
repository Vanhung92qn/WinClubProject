# Setup chạy WinClub trên web (production-style)

Tài liệu thủ công cho dev/VPS: domain mẫu **sieuno.online** (Cloudflare → VPS). Kiến trúc bám mẫu [`sites-available/vic68.win`](../sites-available/vic68.win): Nginx TLS termination, static Cocos `web-mobile`, reverse proxy API/WebSocket tới các process Java/Node trên localhost.

**Nguyên tắc lâu dài**

- Một file snippet cho mọi route game/API dùng chung → tránh copy-paste hai server block như cũ.
- Secret chỉ trong `docker/.env` và config backend — không nhét vào repo công khai.
- Dịch vụ backend nên chạy dưới **systemd** (restart, log), không phụ thuộc terminal.
- Cloudflare: bật proxy (cam) sau khi origin HTTPS ổn định; **SSL/TLS** = *Full (strict)* cần chứng chỉ origin mà Cloudflare tin cậy — **Origin Certificate** (khuyến nghị) hoặc Let’s Encrypt; xem [`CLOUDFLARE-ORIGIN-SSL.md`](./CLOUDFLARE-ORIGIN-SSL.md).

---

## 0. Chuẩn bị

| Yêu cầu | Ghi chú |
|---------|---------|
| VPS Ubuntu 22.04 LTS (hoặc tương đương) | RAM/CPU tùy số game server đồng thời |
| Docker + Compose | DB stack: [`SETUP.md`](../SETUP.md), [`docker/env-setup-docker-compose.yml`](../docker/env-setup-docker-compose.yml) |
| Java 8 hoặc 11 | Build [`server/`](../server/) |
| Nginx | `sudo apt install nginx` |
| Certbot | `sudo apt install certbot python3-certbot-nginx` (hoặc webroot) |
| Node (nếu dùng CMS/admin) | Port 3002, 3003, … theo site config |
| Cocos Creator | Build **web-mobile** cho client |

**DNS (Cloudflare)**

- `A` / `AAAA`: `sieuno.online`, `www`, `play`, `adp`, `quantri`, `agent` → IP VPS (hoặc gom subdomain tùy nhu cầu).
- Trước khi xin chứng chỉ: tạm tắt proxy cam hoặc dùng DNS-only cho bản ghi challenge (tùy phương án certbot).

---

## 1. Cấu trúc thư mục public (khuyến nghị)

```text
/var/www/winclub/
  play/web-mobile/     # output build Cocos web-mobile (index.html, assets, src/)
  landing/             # landing page + config.json
  livestream/          # tùy chọn, alias /livestream/
```

Tạo thư mục (cần quyền root):

```bash
sudo mkdir -p /var/www/winclub/play/web-mobile /var/www/winclub/landing /var/www/winclub/livestream
sudo chown -R $USER:www-data /var/www/winclub
```

---

## 2. Build và đẩy client (Cocos)

1. Mở project [`client/`](../client/) trong Cocos Creator.
2. **Project → Build**: platform **Web Mobile**, output ví dụ trỏ tới `client/build/web-mobile` (theo `client/local/builder.json`).
3. Build xong, đồng bộ lên VPS:

```bash
rsync -avz --delete client/build/web-mobile/ user@vps:/var/www/winclub/play/web-mobile/
```

**Cấu hình domain trong client**

- File [`client/assets/scripts/common/VersionConfig.ts`](../client/assets/scripts/common/VersionConfig.ts): với bản production web, đặt `ENV` phù hợp và **`DOMAIN_PRO` / `DOMAIN_DEV`** trỏ tới hostname mà người chơi truy cập (ví dụ `play.sieuno.online` nếu game chỉ chạy trên subdomain play).
- [`Configs.ts`](../client/assets/scripts/common/Configs.ts): khi chạy web production, API thường là `https://<DOMAIN>/api-portal` — phải khớp với Nginx (cùng host với trang game hoặc CORS đã cấu hình).

Sau khi đổi domain, **build lại** web-mobile rồi deploy lại.

---

## 3. Backend: DB + build Java

1. Làm theo [`SETUP.md`](../SETUP.md): Docker MySQL/Mongo/Redis/RabbitMQ/Hazelcast, import `mysql/server_orig.sql`.
2. Trong `server/`: `./gradlew build` (hoặc script build từng module game theo quy trình nội bộ).
3. Cấu hình từng game server (`config/db_pool.properties`, `mongo.properties`, `rmq.properties`, `hazelcast.properties`) trỏ tới **localhost** (hoặc IP Docker bridge `10.5.0.x` nếu bind đúng cổng host).

**Cổng tham chiếu** (khớp snippet — điều chỉnh nếu môi trường bạn khác):

| Path Nginx | Backend (localhost) |
|------------|---------------------|
| `/api`, `/api-portal` | `127.0.0.1:8081` (portal API) |
| `/socket-client/minigame` | BitZero WS (ví dụ `1644`) |
| … | Xem [`nginx/snippets/winclub-game-routes.inc`](../nginx/snippets/winclub-game-routes.inc) |

Mỗi process game nên có **unit systemd** `Restart=always`, `WorkingDirectory` trỏ tới thư mục chứa `config/` và JAR.

---

## 4. Nginx + snippet (DRY)

1. Copy snippet vào hệ thống:

```bash
sudo cp /var/WinClubProject/nginx/snippets/winclub-game-routes.inc /etc/nginx/snippets/
```

2. Kiểm tra site mẫu [`sites-available/sieuno.online`](../sites-available/sieuno.online): chỉnh `root`, `ssl_certificate` nếu tên chứng chỉ Let’s Encrypt khác (thư mục thường là FQDN “chính” bạn truyền cho certbot).

3. Bật site:

```bash
sudo ln -sf /var/WinClubProject/sites-available/sieuno.online /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl reload nginx
```

**Lần đầu chưa có TLS:** tạm thời comment các khối `listen 443 ssl` và dùng chỉ `listen 80` + `certbot certonly --webroot` hoặc cài cert rồi bật lại HTTPS — tránh `nginx -t` fail vì thiếu file `.pem`.

---

## 5. Chứng chỉ Let’s Encrypt (ví dụ SAN)

```bash
sudo certbot certonly --nginx \
  -d sieuno.online -d www.sieuno.online -d play.sieuno.online \
  -d adp.sieuno.online -d quantri.sieuno.online -d agent.sieuno.online
```

Sau đó mở Cloudflare SSL **Full (strict)**.

**Ghi log client IP thật (tùy chọn):** thêm `set_real_ip_from` theo [Cloudflare IP ranges](https://www.cloudflare.com/ips/) vào `http` context — tránh toàn bộ log là IP Cloudflare.

---

## 6. Cloudflare

- **HTTPS / Origin cert:** chi tiết cài **Cloudflare Origin Certificate** lên Nginx: [`CLOUDFLARE-ORIGIN-SSL.md`](./CLOUDFLARE-ORIGIN-SSL.md).
- **Full (strict):** bật sau khi file `/etc/ssl/cloudflare/sieuno.online.pem` và `.key` là Origin CA (hoặc Let’s Encrypt).
- **WebSocket:** bật; không chặn upgrade header.
- **Hỏi cổng đặc biệt:** game chỉ dùng 443 qua Nginx (`wss://play.sieuno.online/socket-client/...`), không cần mở trực tiếp hàng chục cổng BitZero ra public nếu chỉ chơi web.

---

## 7. Kiểm tra nhanh

```bash
curl -sI https://play.sieuno.online/ | head -5
curl -sI https://play.sieuno.online/api-portal | head -5
# WebSocket: kiểm tra từ DevTools Network tab sau khi mở game
```

---

## 8. Khi thêm game / đổi cổng BitZero

1. Sửa **một chỗ**: [`nginx/snippets/winclub-game-routes.inc`](../nginx/snippets/winclub-game-routes.inc) (thêm hoặc sửa `location /socket-client/<tên>`).
2. `sudo cp ... /etc/nginx/snippets/` và `sudo nginx -t && sudo systemctl reload nginx`.
3. Đảm bảo client dùng đúng `host` trong WebSocket (thường qua `Configs.App.DOMAIN` + đường dẫn `/socket-client/...`).

---

## 9. Liên quan

- Kiến trúc tổng thể: [`ARCHITECTURE.md`](./ARCHITECTURE.md)
- Changelog agent: [`MEMORY.md`](./MEMORY.md)
- Mẫu nginx dev khác: [`sites-available/vic68.win`](../sites-available/vic68.win)
