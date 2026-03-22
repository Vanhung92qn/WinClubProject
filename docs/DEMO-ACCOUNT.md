# Tài khoản mẫu (MySQL `vinplay`)

Dùng để **đăng nhập thử** khi luồng đăng ký client còn lỗi. Tạo trực tiếp trong DB bằng procedure `update_user_info` (type `9`) + `UPDATE nick_name`.

| Trường | Giá trị |
|--------|---------|
| **user_name** | `winclubdemo` |
| **nick_name** | `winclubnick01` |
| **Mật khẩu** | `123456` (plain text — client web sẽ mã hóa `md52` giống login; API test có thể gửi MD5 32 ký tự) |
| **password trong DB** | `e10adc3949ba59abbe56e057f20f883e` (MD5 của `123456`) |

## Tạo lại / trên máy khác

```sql
USE vinplay;
CALL update_user_info(0, 'winclubdemo,e10adc3949ba59abbe56e057f20f883e', 9);
UPDATE users SET nick_name='winclubnick01' WHERE user_name='winclubdemo';
```

Nếu `user_name` hoặc `nick_name` đã tồn tại, đổi tên trong hai lệnh trên.

## Gợi ý bảo mật

- Chỉ dùng **môi trường dev / nội bộ**.
- Trước production: đổi mật khẩu hoặc xóa user (`DELETE FROM users WHERE user_name='winclubdemo'`).
