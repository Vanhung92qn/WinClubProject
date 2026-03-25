import Configs from "../../scripts/common/Configs";
import UserStore from "../store/UserStore";
import Http from "../network/Http";
import PortalPassword from "./PortalPassword";
import SPUtils from "../../scripts/common/SPUtils";
import BroadcastReceiver from "../../scripts/common/BroadcastReceiver";
import Utils from "../../scripts/common/Utils";
import App from "../../scripts/common/App";
import MiniGameNetworkClient from "../../scripts/networks/MiniGameNetworkClient";
import SlotNetworkClient from "../../scripts/networks/SlotNetworkClient";
import ShootFishNetworkClient from "../../scripts/networks/ShootFishNetworkClient";
import TaiXiuNetWorkClient from "../../scripts/networks/TaiXiuNetWorkClient";
import TaiXiuMD5NetWorkClient from "../../scripts/networks/TaiXiuMD5NetWorkClient";
import TienLenNetworkClient from "../../scripts/networks/TienLenNetworkClient";
import BauCuaTo2NetworkClient from "../../scripts/networks/BauCuaTo2NetworkClient";
import cmd from "../../scripts/common/Lobby.Cmd";

/**
 * AuthService — Single source of truth for login/logout.
 *
 * BEFORE: Login logic duplicated in PopUplogin.ts AND LobbyController.ts
 *   - Both parse sessionKey, set Configs.Login, connect WebSocket
 *   - Bug-prone: fix in one place, forget the other
 *
 * AFTER: Both call AuthService.login() → single path, consistent behavior.
 */
export default class AuthService {

    private static _loginCounter: number = 0;

    /**
     * Login via Portal API (c=3).
     * Returns { success, errorCode, needNickname } for UI to handle display logic.
     */
    static login(username: string, password: string, callback: (result: LoginResult) => void): void {
        if (!username || username.length === 0) {
            callback({ success: false, errorCode: -1, message: "Tên đăng nhập không được để trống." });
            return;
        }
        if (!password || password.length === 0) {
            callback({ success: false, errorCode: -1, message: "Mật khẩu không được để trống." });
            return;
        }

        App.instance.showLoading2(true);
        Http.get(Configs.App.API, {
            c: 3,
            un: username,
            pw: PortalPassword.forApi(password),
            pf: Utils.getPlatform(),
            countIdx: AuthService._loginCounter++
        }, (err, res) => {
            App.instance.showLoading2(false);

            if (err != null) {
                callback({ success: false, errorCode: -2, message: "Đăng nhập không thành công, vui lòng kiểm tra lại kết nối." });
                return;
            }

            let errorCode = parseInt(res["errorCode"]);

            switch (errorCode) {
                case 0:
                    // Success — populate user state + connect game servers
                    AuthService._handleLoginSuccess(username, password, res);
                    callback({ success: true, errorCode: 0 });
                    break;

                case 2001:
                    // Account exists but no nickname yet
                    callback({ success: false, errorCode: 2001, needNickname: true });
                    break;

                case 1007:
                    callback({ success: false, errorCode: 1007, message: "Thông tin đăng nhập không hợp lệ." });
                    break;

                case 1005:
                    callback({ success: false, errorCode: 1005, message: "Tài khoản không tồn tại." });
                    break;

                case 1109:
                    callback({ success: false, errorCode: 1109, message: "Tài khoản đã bị khóa." });
                    break;

                case 1114:
                    callback({ success: false, errorCode: 1114, message: "Hệ thống đang bảo trì. Vui lòng quay trở lại sau!" });
                    break;

                default:
                    callback({ success: false, errorCode: errorCode, message: "Đăng nhập thất bại. Mã lỗi: " + errorCode });
                    break;
            }
        });
    }

    /**
     * Logout — clear state + disconnect all game servers.
     */
    static logout(): void {
        console.log("[AuthService] logout()");
        Configs.Login.clear();
        Configs.Login.IsLogin = false;

        // Remove credentials from localStorage (not just set empty — removeItem guarantees deletion)
        SPUtils.clearCredentials();
        console.log("[AuthService] credentials cleared. getUserName:", JSON.stringify(SPUtils.getUserName()), "getUserPass:", JSON.stringify(SPUtils.getUserPass()));

        // Disconnect all game WebSocket connections
        MiniGameNetworkClient.getInstance().close();
        TaiXiuNetWorkClient.getInstance().close();
        TaiXiuMD5NetWorkClient.getInstance().close();
        SlotNetworkClient.getInstance().close();
        TienLenNetworkClient.getInstance().close();
        ShootFishNetworkClient.getInstance().close();
        BauCuaTo2NetworkClient.getInstance().close();

        App.instance.buttonMiniGame.hidden();
        BroadcastReceiver.send(BroadcastReceiver.USER_LOGOUT);
        UserStore._notifyChange("logout");
    }

    // ── Internal ──

    private static _handleLoginSuccess(username: string, password: string, res: any): void {
        // 1. Populate user state from session key
        Configs.Login.AccessToken = res["accessToken"];
        Configs.Login.SessionKey = res["sessionKey"];
        Configs.Login.Username = username;
        Configs.Login.Password = password;
        Configs.Login.IsLogin = true;

        let userInfo = JSON.parse(base64.decode(Configs.Login.SessionKey));
        Configs.Login.UserId = userInfo["id"];
        Configs.Login.Nickname = userInfo["nickname"];
        Configs.Login.Avatar = userInfo["avatar"];
        Configs.Login.Coin = userInfo["vinTotal"];
        Configs.Login.LuckyWheel = userInfo["luckyRotate"];
        Configs.Login.IpAddress = userInfo["ipAddress"];
        Configs.Login.CreateTime = userInfo["createTime"];
        Configs.Login.Birthday = userInfo["birthday"];
        Configs.Login.VipPoint = userInfo["vippoint"];
        Configs.Login.VipPointSave = userInfo["vippointSave"];
        Configs.Login.MobileSecured = userInfo["mobileSecure"] !== 0;
        Configs.Login.AppSecured = userInfo["appSecure"] !== 0;
        Configs.Login.BanTransfer = userInfo["banTransfer"];

        // 2. Persist credentials
        SPUtils.setUserName(username);
        SPUtils.setUserPass(password);
        SPUtils.setNickName(Configs.Login.Nickname);

        // 3. Connect game server WebSockets (essential ones only)
        MiniGameNetworkClient.getInstance().sendCheck(new cmd.ReqSubcribeJackpots());
        MiniGameNetworkClient.getInstance().sendCheck(new cmd.ReqGetSecurityInfo());
        SlotNetworkClient.getInstance().sendCheck(new cmd.ReqSubcribeHallSlot());
        TaiXiuNetWorkClient.getInstance().checkConnect(() => {});
        // ShootFish (banca) connects lazily when user enters the game — not on login
        // This avoids infinite retry spam when banca .NET server is not running

        // 4. Show mini game button + notify UI
        App.instance.buttonMiniGame.show();
        BroadcastReceiver.send(BroadcastReceiver.USER_INFO_UPDATED);
        UserStore._notifyChange("login");
    }
}

export interface LoginResult {
    success: boolean;
    errorCode: number;
    message?: string;
    needNickname?: boolean;
}
