import App from "../../../../../scripts/common/App";
import Configs from "../../../../../scripts/common/Configs";
import Http from "../../../../../core/network/Http";
import ApiIDEnum from "../../enum/ApiIDEnum";
import MiniGameNetworkClient from "../../../../../scripts/networks/MiniGameNetworkClient";
import cmd from "../../../../../scripts/common/Lobby.Cmd";
import InPacket from "../../../../../scripts/networks/Network.InPacket";
import BroadcastReceiver from "../../../../../scripts/common/BroadcastReceiver";
import GameURL from "../../../../../scripts/common/game/GameURL";
import LobbyLobbyController from "../../controller/Lobby.LobbyController";

const {ccclass, property} = cc._decorator;

@ccclass
export default class TabTelegramActive extends cc.Component {

    @property(cc.Node)
    stepPhone: cc.Node = null;
    @property(cc.Node)
    stepOTP: cc.Node = null;
    @property(cc.Node)
    stepActivated: cc.Node = null;

    @property(cc.EditBox)
    edbPhoneNumber: cc.EditBox = null;
    @property(cc.EditBox)
    edbOTP: cc.EditBox = null;

    @property(cc.Prefab)
    prefabPopupCancelTelegram: cc.Prefab = null;

    protected onLoad() {
        this.showStep("phone");
        MiniGameNetworkClient.getInstance().addListener((data) => {
            let inPacket = new InPacket(data);
            switch (inPacket.getCmdId()) {
                case cmd.Code.GET_SECURITY_INFO: {
                    let res = new cmd.ResGetSecurityInfo(data);
                    if (res.appSecure == 1) {
                        this.showStep("activated");
                    } else {
                        this.showStep("phone");
                    }
                    break;
                }
            }
        }, this);
    }

    protected onEnable() {
        this.showStep("phone");
        this.clearInputs();
        MiniGameNetworkClient.getInstance().send(new cmd.ReqGetSecurityInfo());
    }

    private showStep(step: "phone" | "otp" | "activated") {
        if (this.stepPhone) this.stepPhone.active = (step === "phone");
        if (this.stepOTP) this.stepOTP.active = (step === "otp");
        if (this.stepActivated) this.stepActivated.active = (step === "activated");
    }

    private clearInputs() {
        if (this.edbPhoneNumber) this.edbPhoneNumber.string = "";
        if (this.edbOTP) this.edbOTP.string = "";
    }

    private static normalizePhone(raw: string): string {
        let phone = raw.replace(/[\s\-().]/g, "");
        if (phone.startsWith("+84")) {
            phone = "0" + phone.substring(3);
        } else if (phone.startsWith("84") && phone.length >= 11) {
            phone = "0" + phone.substring(2);
        }
        return phone;
    }

    /** stepPhone → btnXacNhan click event: chỉ validate + chuyển sang stepOTP, chưa gọi API */
    onSubmitPhone() {
        let raw = this.edbPhoneNumber.string.trim();
        if (raw.length === 0) {
            App.instance.actShowThongBao("Vui lòng nhập số điện thoại.");
            return;
        }
        let phone = TabTelegramActive.normalizePhone(raw);
        if (phone.length < 9 || phone.length > 11 || !/^\d+$/.test(phone)) {
            App.instance.actShowThongBao("Số điện thoại không hợp lệ.");
            return;
        }
        this.edbPhoneNumber.string = phone;
        this.showStep("otp");
    }

    /** stepOTP → btn "Lấy OTP qua Telegram": mở bot link — ĐÃ ĐÚNG, không cần sửa */
    onChatBotTelegram() {
        cc.sys.openURL(`${GameURL.BOT_TELEGRAM}?start=${Configs.Login.Nickname}`);
    }

    /**
     * stepOTP → BtnXacNhan click event:
     * 1. Lưu SĐT lên server (c=4123) — đây mới là lúc SĐT "chính thức"
     * 2. Nếu OK → verify OTP (c=4124)
     * 3. Nếu OK → activate + chuyển stepActivated
     */
    onActiveTelegram() {
        let phone = TabTelegramActive.normalizePhone(this.edbPhoneNumber.string.trim());
        let otp = this.edbOTP.string.trim();

        if (otp.length === 0) {
            App.instance.actShowThongBao("Vui lòng nhập mã OTP.");
            return;
        }
        if (phone.length < 9) {
            App.instance.actShowThongBao("Số điện thoại không hợp lệ, vui lòng quay lại sửa.");
            return;
        }

        App.instance.showLoading2(true);

        let savePhoneParams = {
            "c": ApiIDEnum.GET_PHONE_OTP,
            "phoneNumber": phone,
            "at": Configs.Login.AccessToken
        };
        Http.get(Configs.App.API, savePhoneParams, (err, res) => {
            if (err || !res.success) {
                App.instance.showLoading2(false);
                App.instance.actShowThongBao(res ? res.errorCode : "Lỗi kết nối, vui lòng thử lại.");
                return;
            }

            let verifyParams = {
                "c": ApiIDEnum.VERIFY_PHONE_OTP,
                "nickname": Configs.Login.Nickname,
                "otp": otp,
            };
            Http.get(Configs.App.API, verifyParams, (err2, res2) => {
                App.instance.showLoading2(false);
                if (err2) {
                    App.instance.actShowThongBao("Lỗi kết nối, vui lòng thử lại.");
                    return;
                }
                if (!res2.success) {
                    App.instance.actShowThongBao(res2.errorCode);
                    return;
                }
                if (res2.errorCode === "OK") {
                    App.instance.actShowThongBao("Kích hoạt bảo mật Telegram thành công!");
                    BroadcastReceiver.send(BroadcastReceiver.USER_INFO_UPDATED);
                    this.showStep("activated");
                }
            });
        });
    }

    /** stepOTP → quay lại sửa SĐT */
    onBackToPhone() {
        this.showStep("phone");
        if (this.edbOTP) this.edbOTP.string = "";
    }

    openLinkTelegram() {
        if (cc.sys.os == cc.sys.OS_IOS) {
            cc.sys.openURL("https://apps.apple.com/us/app/telegram-messenger/id686449807");
        } else if (cc.sys.os == cc.sys.OS_ANDROID) {
            cc.sys.openURL("https://play.google.com/store/apps/details?id=org.telegram.messenger&pli=1");
        } else {
            cc.sys.openURL("https://desktop.telegram.org/");
        }
    }

    onOpenCancelTelegram() {
        LobbyLobbyController._instance.actOpenPopup(this.prefabPopupCancelTelegram);
    }
}
