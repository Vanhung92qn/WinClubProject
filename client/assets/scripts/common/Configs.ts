import SPUtils from "./SPUtils";
import Http from "../../core/network/Http";
import VersionConfig from "./VersionConfig";

namespace Configs {
    export class Login {
        static UserId: number = 0;
        static Username: string = "";
        static Password: string = "";
        static Nickname: string = "";
        static Avatar: string = "";
        static Coin: number = 0;
        static IsLogin: boolean = false;
        static AccessToken: string = "";
        static SessionKey: string = "";
        static LuckyWheel: number = 0;
        static CreateTime: string = "";
        static Birthday: string = "";
        static IpAddress: string = "";
        static VipPoint: number = 0;
        static VipPointSave: number = 0;
        static MobileSecured: boolean = false;
        static AppSecured: boolean = false;
        static BanTransfer: boolean = false;

        static CoinFish: number = 0;
        static UserIdFish: number = 0;
        static UsernameFish: string = "";
        static PasswordFish: string = "";
        static FishConfigs: any = null;
        static BitcoinToken: string = "";

        static clear() {
            this.UserId = 0;
            this.Nickname = "";
            this.Avatar = "";
            this.Coin = 0;
            this.IsLogin = false;
            this.AccessToken = "";
            this.SessionKey = "";
            this.CreateTime = "";
            this.Birthday = "";
            this.IpAddress = "";
            this.VipPoint = 0;
            this.VipPointSave = 0;
            this.CoinFish = 0;
            this.UserIdFish = 0;
            this.UsernameFish = "";
            this.PasswordFish = "";
            this.BitcoinToken = "";
        }

        static readonly VipPoints = [80, 800, 4500, 8600, 12000, 50000, 1000000, 2000000];
        static readonly VipPointsName = ["Đá", "Đồng", "Bạc", "Vàng", "BK1", "BK2", "KC1", "KC2", "KC3"];
        static getVipPointName(): string {
            for (let i = this.VipPoints.length - 1; i >= 0; i--) {
                if (Configs.Login.VipPoint > this.VipPoints[i]) {
                    return this.VipPointsName[i + 1];
                }
            }
            return this.VipPointsName[0];
        }
        static getVipPointNextLevel(): number {
            for (let i = this.VipPoints.length - 1; i >= 0; i--) {
                if (Configs.Login.VipPoint > this.VipPoints[i]) {
                    if (i == this.VipPoints.length - 1) {
                        return this.VipPoints[i];
                    }
                    return this.VipPoints[i + 1];
                }
            }
            return this.VipPoints[0];
        }
        static getVipPointIndex(): number {
            for (let i = this.VipPoints.length - 1; i >= 0; i--) {
                if (Configs.Login.VipPoint > this.VipPoints[i]) {
                    return i;
                }
            }
            return 0;
        }
    }

    export class App {
        static CONFIG_URL = `https://raw.githubusercontent.com/chaunhuanphat/dev-tito/master/production.json?v=${Date.now()}`;
        static HOT_UPDATE_URL = "https://raw.githubusercontent.com/chaunhuanphat/dev-tito/master/";
        static BUNDLE_URL = "sieuno.online/remote-assets";

        // ══════════════════════════════════════════════════════════════
        //  DOMAIN & PROTOCOL — Tất cả kết nối đi qua domain duy nhất
        //  Đổi domain? Sửa VersionConfig.DOMAIN_LOCAL / DOMAIN_PRO
        // ══════════════════════════════════════════════════════════════
        static DOMAIN: string = VersionConfig.DOMAIN_LOCAL;
        static USE_WSS: boolean = true;
        static API: string = `https://${VersionConfig.DOMAIN_LOCAL}/api`;

        static MONEY_TYPE = 1;
        static LINK_DOWNLOAD = `https://${VersionConfig.DOMAIN_LOCAL}/download`;
        static LINK_EVENT = `https://${VersionConfig.DOMAIN_LOCAL}/event`;
        static LINK_SUPPORT = `https://${VersionConfig.DOMAIN_LOCAL}`;
        static LINK_GROUP = "";
        static BANCA = `https://${VersionConfig.DOMAIN_LOCAL}/banca`;
        static SICBO = `https://${VersionConfig.DOMAIN_LOCAL}/sicbo`;
        static XENG777 = `https://${VersionConfig.DOMAIN_LOCAL}/xeng777`;
        static LINK_BOT_OTP = "https://t.me/sunsunotp_bot";
        static MAP_DAILY = [];
        static BUNDLE_CONFIG = {
            bundleVers: '',
            jsList: []
        }

        // ══════════════════════════════════════════════════════════════
        //  GAME SERVER PATHS — Nginx route: /socket-client/{path}
        //  URL = wss://DOMAIN/socket-client/{host}
        //  "host" here = Nginx location name, NOT an actual hostname
        // ══════════════════════════════════════════════════════════════
        static  HOST_MINIGAME    = { host: "minigame",          port: 1644 };
        static  HOST_SLOT        = { host: "slotmachine",       port: 1844 };
        static  HOST_TAIXIU      = { host: "taixiu",            port: 2044 };
        static  HOST_TAI_XIU_MINI2 = { host: "overunder",       port: 2044 };
        static  HOST_TAIXIU_MD5  = { host: "taixiumd5",         port: 12044 };
        static  HOST_TAIXIU_LIVE_KUBET = { host: "taixiu-kubet", port: 22044 };
        static  HOST_XOCDIA      = { host: "xocdia",            port: 2344 };
        static  HOST_XOCDIA_LIVE_KUBET = { host: "xocdiakubet", port: 22344 };
        static  HOST_BACAY       = { host: "bacay",             port: 1044 };
        static  HOST_BAICAO      = { host: "baicao",            port: 1144 };
        static  HOST_BINH        = { host: "binh",              port: 1244 };
        static  HOST_POKER       = { host: "poker",             port: 1744 };
        static  HOST_XIDACH      = { host: "poker",             port: 1744 };
        static  HOST_LIENG       = { host: "lieng",             port: 2244 };
        static  HOST_SAM         = { host: "sam",               port: 1944 };
        static  HOST_TLMN        = { host: "tienlenmiennam",    port: 2144 };
        static  HOST_SHOOT_FISH  = { host: "banca",             port: 2083 };
        static  HOST_BAU_CUA_TO2 = { host: "baucua",            port: 3644 };

        static readonly SERVER_CONFIG = {
            ratioNapTheVTT: 1,
            ratioNapTheVNP: 1,
            ratioNapTheVMS: 1,
            ratioNapMomo: 1.2,
            ratioTransfer: 0.98,
            ratioTransferDL: 1,
            listTenNhaMang: ["Viettel", "Vinaphone", "Mobifone", "Vietnamobile"],
            listIdNhaMang: [0, 1, 2, 3],
            listMenhGiaNapThe: [10000, 20000, 30000, 50000, 100000, 200000, 300000, 500000],
            ratioRutThe: 1.2
        };
        static readonly CASHOUT_CARD_CONFIG = {
            listTenNhaMang: ["Viettel", "Vinaphone", "Mobifone"],
            listIdNhaMang: ["VT", "VN", "MB"],
            listMenhGiaNapThe: [10000, 20000, 30000, 50000, 100000, 200000, 500000],
            listQuantity: ["1", "2","3"]
        }
        static  BILLING_CONF : any;
        //static HOST_MAUBINH: any;

        static  listmember=[];

        static getRoomMember(){
            // Http.get(Configs.App.API, { "c": 4006 }, (err, res) => {
            //     // console.log(res);
            //     Configs.App.listmember=[];
            //         for (let i = 0; i < res["listTable"].length; i++) {
            //             let itemData = res["listTable"][i]["num"];
            //             Configs.App.listmember.push(itemData);
            //         }
            // });
        }
        static getServerConfig() {
            Http.get(Configs.App.API, { "c": 130 }, (err, res) => {
                if (err == null) {
                    // console.log(res);
                    App.SERVER_CONFIG.ratioNapTheVTT = res.ratio_nap_the_vt;
                    App.SERVER_CONFIG.ratioNapTheVNP = res.ratio_nap_the_vn;
                    App.SERVER_CONFIG.ratioNapTheVMS = res.ratio_nap_the_mb;
                    App.SERVER_CONFIG.ratioTransfer = res.ratio_chuyen;
                    App.SERVER_CONFIG.ratioTransferDL = res.ratio_transfer_dl_1;
                    App.SERVER_CONFIG.ratioRutThe = res.ratio_mua_the;
                    App.BILLING_CONF = res;
                }
            });
        }

        static getPlatformName() {
            // if (cc.sys.isNative && cc.sys.os == cc.sys.OS_ANDROID) return "android";
            // if (cc.sys.isNative && cc.sys.os == cc.sys.OS_IOS) return "ios";
            // return "web";
            return "FISH";
        }

        static getLinkFanpage() {
            switch (VersionConfig.CPName) {
                default:
                    return "https://www.facebook.com/sunwinclub";
                    // return "https://www.facebook.com/bao99club";
            }
        }

        static getLinkGrFacebook() {
            switch (VersionConfig.CPName) {
                default:
                    return "https://www.facebook.com/sunwinclub";
                    // return "https://www.facebook.com/bao99club";
            }
        }

        static getLinkTelegram() {
            switch (VersionConfig.CPName) {
                default:
                    return "https://t.me/CSKH_sun9.club";
                    //return "cskhbao99";
            }
        }

        static getLinkTelegramGroup() {
            switch (VersionConfig.CPName) {
                default:
                    return "@cskhyou88";
                    //return "cskhbao99";
            }
        }

        static secretCode="111111";
        static setSecretCode(code){
            Configs.App.secretCode = code;
        }
        static getDomain(name : string){

            return cc.sys.localStorage.getItem(name)
        }

        /**
         * Initialize config based on environment.
         * All envs use the same pattern: wss://DOMAIN/socket-client/{path}
         * Game HOST paths are already set as defaults above — init() only overrides DOMAIN/API.
         *
         * Remote config (LoadingController) can override DOMAIN via localStorage keys
         * (DOMAIN_GAME_PROD, MINIGAME_CONTEXT, etc.) for dynamic server switching.
         */
        static init() {
            // ── Step 1: Set DOMAIN based on environment ──
            switch (VersionConfig.ENV) {
                case VersionConfig.ENV_LOCAL:
                    this.DOMAIN = VersionConfig.DOMAIN_LOCAL;
                    break;
                case VersionConfig.ENV_DEV:
                    this.DOMAIN = this.getDomain("DOMAIN_GAME_DEV") || VersionConfig.DOMAIN_DEV;
                    break;
                case VersionConfig.ENV_PROD:
                    this.DOMAIN = this.getDomain("DOMAIN_GAME_PROD") || VersionConfig.DOMAIN_PRO;
                    break;
                default:
                    this.DOMAIN = VersionConfig.DOMAIN_DEV;
                    break;
            }

            // ── Step 2: Derive all URLs from DOMAIN (single source of truth) ──
            this.USE_WSS = true;
            this.MONEY_TYPE = 1;
            this.API = `https://${this.DOMAIN}/api/v1`;
            this.LINK_DOWNLOAD = `https://${this.DOMAIN}/download`;
            this.LINK_EVENT = `https://${this.DOMAIN}/event`;
            this.LINK_SUPPORT = `https://${this.DOMAIN}`;

            // ── Step 3: Override HOST paths from remote config (if available) ──
            // Remote server can push different path names via localStorage
            // (set by LoadingController.start() from CONFIG_URL response)
            if (VersionConfig.ENV !== VersionConfig.ENV_LOCAL) {
                this.applyRemoteHostConfig();
            }
        }

        /** Apply remote host overrides from localStorage (set by LoadingController) */
        private static applyRemoteHostConfig() {
            const override = (key: string, target: { host: string }) => {
                let val = this.getDomain(key);
                if (val) target.host = val;
            };
            override("MINIGAME_CONTEXT", this.HOST_MINIGAME);
            override("SLOT_CONTEXT", this.HOST_SLOT);
            override("TAIXIU_CONTEXT", this.HOST_TAIXIU);
            override("TAIXIUMD5_CONTEXT", this.HOST_TAIXIU_MD5);
            override("TLMN_CONTEXT", this.HOST_TLMN);
            override("SAM_CONTEXT", this.HOST_SAM);
            override("XOCDIA_CONTEXT", this.HOST_XOCDIA);
            override("BACAY_CONTEXT", this.HOST_BACAY);
            override("BAICAO_CONTEXT", this.HOST_BAICAO);
            override("POKER_CONTEXT", this.HOST_POKER);
            override("BINH_CONTEXT", this.HOST_BINH);
            override("SHOOT_FISH_CONTEXT", this.HOST_SHOOT_FISH);
            override("BAUCUA_CONTEXT", this.HOST_BAU_CUA_TO2);
            override("HOST_TAI_XIU_MINI2", this.HOST_TAI_XIU_MINI2);
        }
    }
    export class GameId {
        static readonly MiniPoker = 1;
        static readonly TaiXiu = 2;
        static readonly BauCua = 3;
        static readonly CaoThap = 4;
        static readonly Slot3x3 = 5;
        static readonly VQMM = 7;
        static readonly Sam = 8;
        static readonly BaCay = 9;
        static readonly MauBinh = 10;
        static readonly TLMN = 11;
        static readonly TaLa = 12;
        static readonly Lieng = 13;
        static readonly XiTo = 14;
        static readonly XocXoc = 15;
        static readonly BaiCao = 16;
        static readonly Poker = 17;
        static readonly Bentley = 19;
        static readonly RangeRover = 20;
        static readonly MayBach = 21;
        static readonly RollsRoyce = 22;
        static readonly BauCuaTo2 = 23;
        static readonly TaiXiuMD5 = 2000;
        static readonly CowBoy = 170;
        static readonly FastAndFurious = 180;
        static readonly LadyNight = 120;
        static readonly BongLaiCac = 200;
        static readonly SexyDance = 230;
        static readonly LienMinh = 110;
        static readonly BigCityBoy = 190;
        static readonly Halloween = 210;
        static readonly MACAO = 220;

        static getGameName(gameId: number): string {
            switch (gameId) {
                case this.MiniPoker:
                    return "MiniPoker";
                case this.TaiXiu:
                    return "Tài Xỉu";
                case this.BauCua:
                    return "Bầu Cua";
                case this.CaoThap:
                    return "Trên Dưới";
                case this.Slot3x3:
                    return "Rượu Whisky";
                case this.VQMM:
                    return "VQMM";
                case this.Sam:
                    return "Sâm";
                case this.MauBinh:
                    return "Mậu Binh";
                case this.TLMN:
                    return "TLMN";
                case this.TaLa:
                    return "Tá Lả";
                case this.Lieng:
                    return "Liêng";
                case this.XiTo:
                    return "Xì Tố";
                case this.XocXoc:
                    return "Xóc Đĩa";
                case this.BaiCao:
                    return "Bài Cào";
                case this.Poker:
                    return "Poker";
                case this.Bentley:
                    return "Thần Tài";
                case this.RangeRover:
                    return "Avengers";
                case this.RollsRoyce:
                    return "Rolls Royce";
                case this.BauCuaTo2:
                    return "Bầu Cua";
                case this.TaiXiuMD5:
                    return "Tài Xỉu MD5";
                case this.CowBoy:
                    return "Cao Bồi";
                case this.FastAndFurious:
                    return 'Fast And Furious';
                case this.LadyNight:
                    return 'Lady Night';
                case this.BongLaiCac:
                    return 'Bồng Lai Các';
                case this.SexyDance:
                    return 'Sexy Dance';
                case this.LienMinh:
                    return 'Liên Minh Huyền Thoại';
                case this.BigCityBoy:
                    return 'Big City Boy';
                case this.MACAO:
                    return 'Thần Bài MaCao';
                case this.Halloween:
                    return 'Halloween';
            }
            return "Thần Tài";
        }
    }
}
export default Configs;
