# WinClub API Reference

## Gateway Routes (Nginx)

| Path | Backend | Port | Domain |
|------|---------|:----:|--------|
| `/api/v1` | VinPlayPortal | 8081 | User: login, register, profile, shop |
| `/api/v1/admin` | VinPlayBackend | 8082 | Admin & Agent management |
| `/api/v1/board` | BoardService | 8087 | Leaderboard, hotupdate |
| `/api/v1/pay` | WSPay | 18081 | Payment processing |
| `/api-portal` | VinPlayPortal | 8081 | **Legacy** — backward-compat, không thêm endpoints mới |

**Format:** `GET https://sieuno.online/api/v1?c={command_id}&{params}`

**Versioning policy:** Mọi endpoint mới dùng `/api/v1`. Client cũ (chưa update) vẫn dùng `/api-portal` — không xóa route đó cho đến khi 100% client đã update.

---

## Authentication

| c | Name | Params | Response | Note |
|---|------|--------|----------|------|
| 1 | Register | `un`, `pw` (AES), `nn`, `cp`, `cid` | `{ success, errorCode }` | Password: BCrypt stored |
| 3 | Login | `un`, `pw` (AES), `pf` | `{ success, errorCode, accessToken, sessionKey }` | sessionKey = base64(JSON userInfo) |
| 4 | LoginWithOTP | `un`, `pw`, `otp` | `{ success, errorCode }` | 2FA login |
| 5 | UpdateNickname | `un`, `pw` (AES), `nn`, `pf` | `{ success, errorCode, accessToken, sessionKey }` | After register |
| 17 | CheckRegister | `data`, `tp` (0=username, 1=nickname) | `{ success }` | Validate availability |

## Config & Server

| c | Name | Params | Response |
|---|------|--------|----------|
| 6 | GetAppConfig | - | App configuration JSON |
| 9 | GetTimeServer | - | Server timestamp |
| 130 | GetBilling | `cp`, `cl`, `pf` | Billing/payment config |

## User Profile & Security

| c | Name | Params | Response |
|---|------|--------|----------|
| 124 | CaptchaProcessor | - | Captcha image |
| 125 | UpdateAvatar | `nn`, avatar data | `{ success }` |
| 126 | GetVippoint | `nn` | VIP point data |
| 127 | ForgetPassword | credentials | Password reset |
| 4096 | ActiveTelegram | `nickname` | Activate Telegram OTP |
| 4119 | CheckOtp | `nickname`, `otp` | Verify OTP code |
| 4122 | DeactivateTelegram | `nickname` | Remove Telegram |
| 4123 | ActivePhone | phone data | Activate phone security |
| 4125 | RequestOTPTelegram | `nickname` | Quick OTP via Telegram |

## Mail & Notifications

| c | Name | Params | Response |
|---|------|--------|----------|
| 402 | ListMailBox | `nn`, `p` (page) | `{ success, mailNotRead, list }` |
| 403 | DeleteMailBox | `nn`, mail id | `{ success }` |
| 404 | UpdateStatusMail | `nn`, mail id | `{ success }` |

## Shop & Payment

| c | Name | Params | Response |
|---|------|--------|----------|
| 4109 | GiftCode | `nn`, `code` | `{ success }` |
| 4110 | UserBankInfo | bank data | Save bank info |
| 4111 | GetUserBankInfo | `nn` | Bank info |
| 4114 | GetRechargeInfo | `nn` | Recharge history |
| 4087 | NapThe | card data | Card recharge |
| 4088 | RutThe | card data | Card withdrawal |

## Game History

| c | Name | Params | Response |
|---|------|--------|----------|
| 100 | LSGDTaiXiu | `nn`, pagination | Transaction history |
| 101 | TopWinTX | - | TaiXiu leaderboard |
| 102 | ChiTietPhien | session id | Session detail |
| 105 | LSGDMiniPoker | `nn` | MiniPoker history |
| 136 | TopKhoBau | - | Slot leaderboard |
| 137 | LSGDSlot | `nn` | Slot history |

## Links & Social

| c | Name | Params | Response |
|---|------|--------|----------|
| 4112 | GetLinkSocial | - | `{ success, groupFacebook, teleCSKH, fanPage, ... }` |

---

## Error Codes

| Code | Meaning |
|------|---------|
| 0 | Success |
| 101 | Invalid username format |
| 102 | Invalid password format |
| 1001 | Server internal error / connection lost |
| 1005 | Account not found |
| 1006 | Username already exists |
| 1007 | Wrong password |
| 1009 | Login failed (generic) |
| 1010 | Nickname already exists |
| 1013 | Nickname already set |
| 1109 | Account locked |
| 1114 | System maintenance |
| 2001 | No nickname (need UpdateNickname c=5) |

---

## WebSocket Game Servers

All game WebSocket traffic goes through Nginx reverse proxy:

```
wss://sieuno.online/socket-client/{gamePath}
```

| Game Path | Internal Port | Game |
|-----------|:------------:|------|
| minigame | 1644 | MiniGame (jackpot, etc.) |
| slotmachine | 1844 | Slot machines |
| taixiu | 2044 | Tai Xiu |
| taixiumd5 | 12044 | Tai Xiu MD5 |
| taixiu-kubet | 22044 | Tai Xiu Kubet |
| xocdia | 2344 | Xoc Dia |
| xocdiakubet | 22344 | Xoc Dia Kubet |
| bacay | 1044 | Ba Cay |
| baicao | 1144 | Bai Cao |
| binh | 1244 | Mau Binh |
| poker | 1744 | Poker |
| sam | 1944 | Sam |
| tienlenmiennam | 2144 | Tien Len |
| banca | 2083 | Ban Ca (ShootFish) |
| baucua | 3644 | Bau Cua |

**WS Auth:** After WebSocket open, client sends binary login packet:
```
[controllerId=1] [cmdId=LOGIN] [nickname: string] [accessToken: string]
```
