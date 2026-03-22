export default class VersionConfig {
    static readonly CP_NAME_F69 = "F69";
    static readonly ENV_DEV = "dev";
    static readonly ENV_PROD = "prod";
    static readonly ENV_LOCAL = "local";

    // ══════════════════════════════════════════════════
    //  DOMAIN CONFIG — Đổi domain? SỬA Ở ĐÂY DUY NHẤT
    // ══════════════════════════════════════════════════
    static readonly DOMAIN_LOCAL = "sieuno.online";
    static DOMAIN_DEV = "sieuno.online";
    static DOMAIN_PRO = "sieuno.online";

    static DOMAINHOTUPDATE() {
        if (cc.sys.localStorage.getItem("url_update")) {
            return cc.sys.localStorage.getItem("url_update");
        }
        return "sieuno.online";
    }
    static VersionName = "";
    static CPName = "";
    static ENV = VersionConfig.ENV_LOCAL;
}
 
if (cc.sys.isNative) {
    let versionConfig = cc.sys.localStorage.getItem("VersionConfig");
    if (versionConfig != null) {
        versionConfig = JSON.parse(versionConfig);
        VersionConfig.VersionName = versionConfig["VersionName"];
        VersionConfig.CPName = versionConfig["CPName"];
    }else{
        VersionConfig.VersionName = "1.0.0";
        VersionConfig.CPName = VersionConfig.CP_NAME_F69;
    }
} else {
    VersionConfig.VersionName = "1.0.0";
    VersionConfig.CPName = VersionConfig.CP_NAME_F69;
}