import App from "../../../../scripts/common/App";
import SPUtils from "../../../../scripts/common/SPUtils";
import LobbyLobbyController from "../controller/Lobby.LobbyController";
import Popup from "../../../../scripts/common/Popup";
import AuthService from "../../../../core/auth/AuthService";

const {ccclass, property} = cc._decorator;
namespace Lobby {

@ccclass
export  class PopupLogin extends Popup {

    @property(cc.EditBox)
    edbUsername: cc.EditBox = null;
    @property(cc.EditBox)
    edbPassword: cc.EditBox = null;
    @property(cc.Prefab)
    prefabPopupUpdateNickName = null;

    actLogin(): void {
        let username = this.edbUsername.string.trim();
        let password = this.edbPassword.string.trim();

        AuthService.login(username, password, (result) => {
            if (result.success) {
                this.onClose();
                LobbyLobbyController._instance.loadListMail();
                LobbyLobbyController._instance.actOpenBigBanner();
                return;
            }

            if (result.needNickname) {
                this.onClose();
                LobbyLobbyController._instance.actOpenPopup(this.prefabPopupUpdateNickName);
                return;
            }

            App.instance.alertDialog.showMsg(result.message);
        });
    }


    // LIFE-CYCLE CALLBACKS:

    onLoad () {
         if(SPUtils.getUserName().length > 0) {
             this.edbUsername.string = SPUtils.getUserName();
         }

         if(SPUtils.getUserPass().length > 0) {
             this.edbPassword.string = SPUtils.getUserPass();
         }
        if(cc.sys.platform == cc.sys.MOBILE_BROWSER) {
            this.node.getChildByName('Container').rotation = -90;
            this.node.getChildByName('Container').scale = 0.9;
        }
    }

    openCSKHTele() {
        LobbyLobbyController._instance.actOpenPopupForgetPassword();
    }
}
}
export default Lobby.PopupLogin;
