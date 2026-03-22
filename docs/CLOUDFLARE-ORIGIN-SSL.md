# Cloudflare Full (Strict) + Nginx trên VPS

## Nginx đã cấu hình sẵn

- Site: [`sites-available/sieuno.online`](../sites-available/sieuno.online) → symlink ` /etc/nginx/sites-enabled/sieuno.online`
- Snippet: `/etc/nginx/snippets/winclub-game-routes.inc` (copy từ [`nginx/snippets/winclub-game-routes.inc`](../nginx/snippets/winclub-game-routes.inc))
- **Chứng chỉ origin** (Nginx đọc cố định hai file sau):
  - `/etc/ssl/cloudflare/sieuno.online.pem` — full chain (Cloudflare Origin **Certificate** dán vào đây)
  - `/etc/ssl/cloudflare/sieuno.online.key` — private key

Sau khi thay file, chạy: `sudo nginx -t && sudo systemctl reload nginx`.

## “SSL free Cloudflare” vs Full (Strict)

- **Universal SSL** (miễn phí) chỉ bảo vệ khách ↔ Cloudflare.
- **Full (Strict)** buộc Cloudflare kết nối HTTPS tới **origin** (VPS) với chứng chỉ mà Cloudflare **tin cậy**:
  - **Cloudflare Origin Certificate** (khuyến nghị, miễn phí, cài trên Nginx), hoặc
  - **Let’s Encrypt** (công khai) trên origin.

Chứng chỉ **tự ký** trên VPS **không** đủ cho Full (Strict) → thường gặp **526**.

## Cách lấy Cloudflare Origin Certificate (bạn làm trên dashboard)

1. Cloudflare → domain **sieuno.online** → **SSL/TLS** → **Origin Server**.
2. **Create certificate** → chọn host: tối thiểu `sieuno.online`, `*.sieuno.online` (hoặc liệt kê `play.sieuno.online`, `www.sieuno.online`, …).
3. Copy **Origin Certificate** (PEM) và **Private key** (chỉ hiện một lần — lưu an toàn).

**Không** dán private key vào chat, ticket, hoặc git — coi như đã lộ nếu đã làm; hãy **tạo lại Origin Certificate** trên Cloudflare và ghi đè hai file dưới.

Trên VPS (dán nội dung qua SSH/`scp`, không commit lên git):

```bash
sudo nano /etc/ssl/cloudflare/sieuno.online.pem   # dán toàn bộ certificate (có thể nhiều block)
sudo nano /etc/ssl/cloudflare/sieuno.online.key   # dán private key
sudo chmod 640 /etc/ssl/cloudflare/sieuno.online.key
sudo chown root:root /etc/ssl/cloudflare/sieuno.online.pem /etc/ssl/cloudflare/sieuno.online.key
sudo nginx -t && sudo systemctl reload nginx
```

Trình duyệt vẫn tin cậy chuỗi do Cloudflare phục vụ phía người dùng; Origin CA chỉ dùng cho kênh Cloudflare ↔ VPS.

## DNS bạn đã trỏ

`play`, `www`, apex → IP VPS: đúng hướng. Nếu bật **proxy (cam)**:

- Đảm bảo **SSL/TLS** = Full (Strict) sau khi origin đã có cert Origin CA (hoặc LE).
- **WebSockets**: Network → domain → có thể cần bật tương thích WS (thường mặc định ổn với Nginx upgrade).

## Kiểm tra nhanh

```bash
curl -svI https://play.sieuno.online/ 2>&1 | head -20
# Từ VPS (bỏ qua verify nếu test origin trực tiếp):
openssl s_client -connect 127.0.0.1:443 -servername play.sieuno.online </dev/null 2>/dev/null | openssl x509 -noout -subject -issuer
```

Nếu Cloudflare báo 526: origin chưa dùng đúng cert hoặc Nginx chưa reload.
