# Cocos Creator Migration Guide - Lazy Loading Architecture

## QUAN TRONG: Tại sao phải làm trong Cocos Creator Editor

Cocos Creator 2.x quản lý mọi asset qua file `.meta` chứa UUID.
Nếu di chuyển file bằng Terminal/Explorer, UUID sẽ bị mất -> Prefab hiện "Script Missing", Button mất Event.

**QUY TAC:** Mọi thao tác di chuyển/xóa/đổi tên file PHẢI thực hiện trong giao diện Cocos Creator Editor.

---

## Bước 1: Xóa liên kết Prefab trong Lobby Scene (BAT BUOC)

Sau khi code đã xóa 22 `@property(cc.Prefab)`, bạn cần xóa liên kết trong Cocos Editor:

1. Mở **Cocos Creator 2.x**
2. Mở scene **Lobby** (double-click `client/assets/games/Lobby/res/Lobby.fire`)
3. Trong **Node Tree**, tìm node chứa component `Lobby.LobbyController`
4. Trong **Properties Inspector** bên phải, bạn sẽ thấy các field prefab hiện **cảnh báo vàng** (vì code đã xóa @property)
5. Cocos sẽ tự động bỏ qua các property không còn trong code
6. **Save scene** (Ctrl+S)

**Lưu ý:** Các field Tier 1 vẫn giữ nguyên:
- `popupLogin` -> vẫn kéo prefab PopupLogin.prefab vào
- `popupRegister` -> vẫn kéo prefab PopupRegister.prefab vào
- `loadingSun` -> vẫn kéo prefab tương ứng vào

---

## Bước 2: Tổ chức thư mục (TUY CHON - làm sau khi stable)

Nếu muốn tổ chức lại thư mục client theo kiến trúc mới:

### 2A. Tạo thư mục core

1. Trong **Assets panel** (góc trái dưới), click chuột phải vào `assets/`
2. Chọn **Create > Folder** -> đặt tên `core`
3. Trong `core/`, tạo các thư mục con:
   - `core/network/`
   - `core/auth/`
   - `core/store/`
   - `core/utils/`

### 2B. Di chuyển script bằng kéo-thả

**CHUYEN `PortalPassword.ts` -> `core/auth/`:**
1. Trong Assets panel, tìm `assets/scripts/common/PortalPassword.ts`
2. **Kéo-thả** file này vào thư mục `core/auth/`
3. Cocos sẽ tự động:
   - Di chuyển file `.ts` + file `.meta`
   - Cập nhật tất cả UUID references
   - Giữ nguyên liên kết trong Prefab/Scene

**CHUYEN `Http.ts` -> `core/network/`:**
1. Kéo-thả `assets/scripts/common/Http.ts` vào `core/network/`

**CHUYEN `PopupManager.ts` -> `core/utils/` (tùy chọn):**
1. Kéo-thả `assets/scripts/common/PopupManager.ts` vào `core/utils/`

### 2C. Tổ chức Lobby

1. Trong `assets/games/Lobby/src/`, tạo thư mục:
   - `ui/`
   - `controller/`
   - `service/`
2. Kéo-thả các file popup vào `ui/`:
   - `Lobby.PopUplogin.ts` -> `ui/`
   - `Lobby.PopUploginV2.ts` -> `ui/`
   - `PopupRegister.ts` -> `ui/`
   - `PopupUpdateNicknameSunwin.ts` -> `ui/`
   - `PopupUpdatePhone.ts` -> `ui/`
3. Kéo `Lobby.LobbyController.ts` vào `controller/`

**SAU KHI KÉO-THẢ:** Cocos sẽ tự fix imports. Nhưng nếu dùng relative import path trong TypeScript (VD: `import X from "../../../scripts/common/Y"`), bạn cần update lại đường dẫn relative import trong từng file.

---

## Bước 3: Verify sau migration

1. **Build & Preview:** Click Play (Ctrl+P) trong Cocos Creator
2. **Check console:** Không có lỗi `Script Missing` hoặc `Failed to load prefab`
3. **Test từng popup:**
   - Click Shop -> PopupShop hiện đúng animation
   - Click Profile -> PopupProfile hiện
   - Click Cashout -> PopupCashout hiện
   - Click Setting -> PopupSetting hiện
4. **Check Tier 1 (preload):** Login popup hiện ngay, không delay
5. **Check Tier 2 (lazy+cache):** Shop lần đầu có delay nhẹ (~0.5s), lần 2 instant
6. **Check Tier 3 (lazy+release):** Gift Code mỗi lần mở đều tải lại

---

## Checklist

- [ ] Mở Lobby scene trong Cocos Editor, save lại (xóa stale property refs)
- [ ] Verify popupLogin, popupRegister, loadingSun vẫn kéo đúng prefab
- [ ] Build Preview thành công, không lỗi console
- [ ] Test ít nhất 5 popup (Login, Shop, Profile, Cashout, Setting)
- [ ] Test vào game -> quay Lobby -> verify game bundle released
