# Lobby/src — Hướng Dẫn Phân Loại File (Phase 2B)

> **Quan trọng:** Phải dùng **Cocos Creator Editor** để kéo thả file (giữ UUID .meta).
> Sau khi kéo thả xong, chạy script cập nhật import paths bên dưới.

---

## Cấu trúc mục tiêu

```
Lobby/src/
├── controller/          ← Logic điều hướng scene
│   └── Lobby.LobbyController.ts  ✅ đã đúng chỗ
│
├── ui/                  ← UI popup thuần túy (chỉ hiển thị, không gọi API)
│   ├── Lobby.PopUplogin.ts        ✅ đã đúng chỗ
│   ├── Lobby.PopUploginV2.ts      ✅ đã đúng chỗ
│   ├── PopupRegister.ts           ✅ đã đúng chỗ
│   ├── PopupUpdateNicknameSunwin.ts ✅ đã đúng chỗ
│   └── PopupUpdatePhone.ts        ✅ đã đúng chỗ
│
├── service/             ← Gọi API (NEW — không cần move)
│   └── LobbyService.ts            ✅ đã tạo
│
├── account/             ← Tài khoản, bảo mật, profile
├── shop/                ← Nạp/rút tiền
├── game/                ← Cài đặt, giftcode
├── event/               ← Banner, sự kiện
└── enum/                ← Constants, enums
```

---

## Bảng phân loại — CÁC FILE CẦN MOVE

### → `ui/` (Popup hiển thị, chưa gọi API)

| File hiện tại (src/) | Di chuyển đến |
|----------------------|---------------|
| `Lobby.PopupBoomTan.ts` | `ui/` |
| `Lobby.PopupCardInfo.ts` | `ui/` |
| `Lobby.PopupEventLogin.ts` | `ui/` |
| `Lobby.PopupLuckyWheel.ts` | `ui/` |
| `Lobby.PopupRulerGame.ts` | `ui/` |
| `Lobby.PopupTinTuc.ts` | `ui/` |
| `Lobby.menuPopup.ts` | `ui/` |

### → `account/` (Quản lý tài khoản — đã có `account/` subdir)

| File hiện tại (src/) | Di chuyển đến |
|----------------------|---------------|
| `Lobby.PopupChangeAvatar.ts` | `account/` |
| `Lobby.PopupChangePassword.ts` | `account/` |
| `Lobby.PopupDaiLy.ts` | `account/` |
| `Lobby.PopupProfile.ts` | `account/` |
| `Lobby.PopupSecurity.ts` | `account/` |
| `Lobby.PopupSecurityPhone.ts` | `account/` |
| `Lobby.PopupTranferToDaiLY.ts` | `account/` |
| `Lobby.PopupTransferToUser.ts` | `account/` |
| `LobbySetting.ts` | `account/` |
| `PopupUpdateBankCashout.ts` | `account/` |
| `PopupUpdateNickname.ts` | `account/` |

### → `shop/` (Giao dịch nạp/rút — đã có `shop/` subdir)

| File hiện tại (src/) | Di chuyển đến |
|----------------------|---------------|
| `Lobby.PopupCashout.ts` | `shop/` |
| `Lobby.PopupChiTietRut.ts` | `shop/` |
| `Lobby.PopupGiaoDichRut.ts` | `shop/` |
| `Lobby.PopupGiaoDichRutThe.ts` | `shop/` |
| `Lobby.PopupLichSuNapRut.ts` | `shop/` |
| `Lobby.PopupTransaction.ts` | `shop/` |
| `Lobby.Popupnaprut.ts` | `shop/` |
| `Lobby.PopUpHuongDanNap.ts` | `shop/` |

### → `event/` (Sự kiện — đã có `event/` subdir)

| File hiện tại (src/) | Di chuyển đến |
|----------------------|---------------|
| `Lobby.PopupGiftCode.ts` | `event/` |
| `Lobby.PopupKetsat.ts` | `event/` |

### → giữ nguyên ở `src/` (Scene components, không phải popup)

| File | Lý do giữ |
|------|-----------|
| `Lobby.ButtonListJackpot.ts` | Scene widget |
| `Lobby.HotUpdate.ts` | Hot update manager |
| `Lobby.Huheader.ts` | Jackpot header |
| `Lobby.ItemEvent.ts` | List item (dùng trong scene) |
| `Lobby.ItemGame.ts` | List item (dùng trong scene) |
| `Lobby.ItemSlotGame.ts` | List item |
| `Lobby.ItemTaiXiu.ts` | List item |
| `Lobby.ItemTopHu.ts` | List item |
| `Lobby.PopupBoomTan.ts` | Scene overlay |
| `Lobby.SystemMessage.ts` | Scene ticker |
| `Lobby.TabsListGame.ts` | Tab widget |
| `Lobby.TabsListLobbyGame.ts` | Tab widget |
| `Lobby.TopHu.ts` | Scene display |
| `lobby.MenuController.ts` | Sub-controller |
| `ColorChild.ts` | Utility |
| `StringUtil.ts` | Utility → xem xét move lên `scripts/common/` |

---

## Sau khi kéo thả xong trong Cocos Editor

Mỗi file sau khi move cần cập nhật import paths bên trong file đó.
Ví dụ `Lobby.PopupCashout.ts` được move từ `src/` → `src/shop/`:

```diff
- import LobbyController from "../controller/Lobby.LobbyController";
- import Configs from "../../../../scripts/common/Configs";
+ import LobbyController from "../../controller/Lobby.LobbyController";
+ import Configs from "../../../../../scripts/common/Configs";
```

**Quy tắc:**
- Thêm 1 cấp `../` cho mỗi subdirectory thêm vào
- `shop/` → `../../../../../scripts/` (thêm 1 `../` so với `src/`)
- `account/` → `../../../../../scripts/` (thêm 1 `../` so với `src/`)

Sau khi move, báo cáo lại file nào đã move để cập nhật imports.

---

## Các file đã có sẵn ở đúng chỗ (không cần move)

- `account/PopupForgetPassword.ts`
- `account/PopupUserInformation.ts`
- `event/PopupBigBanner.ts`
- `event/TabFirstCharge.ts`
- `game/PopupGiftcode.ts`
- `game/PopupSetting.ts`
- `game/PopupSupport.ts`
- `shop/PopupCashout.ts` ⚠️ Có thể trùng với `src/Lobby.PopupCashout.ts` — kiểm tra trước khi move
- `shop/PopupShop.ts` ⚠️ Có thể trùng với `src/Lobby.PopupShop.ts`
