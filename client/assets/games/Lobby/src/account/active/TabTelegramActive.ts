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

    private _currentStep: "phone" | "otp" | "activated" = "phone";
    private _phoneSubmitted: boolean = false;

    protected onLoad() {
        this.showStep("phone");
        MiniGameNetworkClient.getInstance().addListener((data) => {
            let inPacket = new InPacket(data);
            switch (inPacket.getCmdId()) {
                case cmd.Code.GET_SECURITY_INFO: {
                    let res = new cmd.ResGetSecurityInfo(data);
                    if (res.appSecure == 1) {
                        this._phoneSubmitted = false;
                        this.showStep("activated");
                    } else if (!this._phoneSubmitted) {
                        this.showStep("phone");
                    }
                    break;
                }
            }
        }, this);
    }

    protected onEnable() {
        if (this._phoneSubmitted) {
            this.showStep(this._currentStep);
        } else {
            this.showStep("phone");
            this.clearInputs();
        }
        MiniGameNetworkClient.getInstance().send(new cmd.ReqGetSecurityInfo());
    }

    private showStep(step: "phone" | "otp" | "activated") {
        this._currentStep = step;
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

    /**
     * stepPhone → btnXacNhan:
     * Validate + normalize SĐT → gọi c=4123 lưu lên server → chuyển stepOTP
     */
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

        App.instance.showLoading2(true);
        let params = {
            "c": ApiIDEnum.GET_PHONE_OTP,
            "phoneNumber": phone,
            "at": Configs.Login.AccessToken
        };
        Http.get(Configs.App.API, params, (err, res) => {
            App.instance.showLoading2(false);
            if (err) {
                App.instance.actShowThongBao("Lỗi kết nối, vui lòng thử lại.");
                return;
            }
            if (!res.success) {
                App.instance.actShowThongBao(res.errorCode || "Lỗi lưu SĐT.");
                return;
            }
            this._phoneSubmitted = true;
            this.showStep("otp");
        });
    }

    /** stepOTP → btn "Lấy OTP": mở bot Telegram để lấy OTP */
    onChatBotTelegram() {
        cc.sys.openURL(`${GameURL.BOT_TELEGRAM}?start=${Configs.Login.Nickname}`);
    }

    /**
     * stepOTP → BtnXacNhan:
     * CHỈ gọi c=4124 verify OTP (SĐT đã được lưu ở onSubmitPhone)
     */
    onActiveTelegram() {
        let otp = this.edbOTP.string.trim();
        if (otp.length === 0) {
            App.instance.actShowThongBao("Vui lòng nhập mã OTP.");
            return;
        }

        App.instance.showLoading2(true);
        let params = {
            "c": ApiIDEnum.VERIFY_PHONE_OTP,
            "nickname": Configs.Login.Nickname,
            "otp": otp,
        };
        Http.get(Configs.App.API, params, (err, res) => {
            App.instance.showLoading2(false);
            if (err) {
                App.instance.actShowThongBao("Lỗi kết nối, vui lòng thử lại.");
                return;
            }
            if (!res.success) {
                App.instance.actShowThongBao(res.errorCode || "Mã OTP không đúng.");
                return;
            }
            if (res.errorCode === "OK") {
                this._phoneSubmitted = false;
                App.instance.actShowThongBao("Kích hoạt bảo mật Telegram thành công!");
                BroadcastReceiver.send(BroadcastReceiver.USER_INFO_UPDATED);
                this.showStep("activated");
            }
        });
    }

    /** stepOTP → quay lại sửa SĐT */
    onBackToPhone() {
        this._phoneSubmitted = false;
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
