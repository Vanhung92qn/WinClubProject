import Configs from "./Configs";
import VersionConfig from "./VersionConfig";
import App from "./App";

const { ccclass, property } = cc._decorator;

@ccclass
export default class Http {
    static post(url: string, params: any, onFinished: (err: any, json: any) => void) {
        var xhr = new XMLHttpRequest();
        xhr.timeout = 45000;

        xhr.onerror = function() {
            console.error("[Http.post] network error", url);
            App.instance.alertDialog.showMsg("Connection Error");
        }

        xhr.ontimeout = function() {
            App.instance.alertDialog.showMsg("Connection timeout");
        }
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var data = null;
                    var e = null;
                    try {
                        data = JSON.parse(xhr.responseText);
                    } catch (ex) {
                        e = ex;
                    }
                    onFinished(e, data);
                } else {
                    onFinished(xhr.status, null);
                }
            }
        };
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
        // @ts-ignore
        xhr.send(params);
    }

    /**
     * @param opts.timeoutMs  override default 45000 (đặt nick / loginSuccess có thể >10s)
     * @param opts.quiet      không bật alert "Connection Error" / timeout (caller tự xử lý / recover)
     */
    static get(url: string, params: object, onFinished: (err: any, json: any) => void, opts?: { timeoutMs?: number; quiet?: boolean }) {
        var xhr = new XMLHttpRequest();
        var _params = "";
        params = params || {};
        switch (VersionConfig.CPName) {
            default:
                if (!params.hasOwnProperty("cp")) {
                    params["cp"] = "R";
                }
                params["cl"] = "R";
                break;
        }
        if (cc.sys.isNative && cc.sys.os == cc.sys.OS_ANDROID) {
            params["pf"] = "ad";
        } else if (cc.sys.isNative && cc.sys.os == cc.sys.OS_IOS) {
            params["pf"] = "ios";
        } else if (!cc.sys.isNative) {
            params["pf"] = "web";
        } else {
            params["pf"] = "other";
        }
        params["at"] = Configs.Login.AccessToken;
        if (params !== null) {
            var count = 0;
            var paramsLength = Object.keys(params).length;
            for (var key in params) {
                if (params.hasOwnProperty(key)) {
                    var v = params[key];
                    _params += encodeURIComponent(key) + "=" + encodeURIComponent(v === null || v === undefined ? "" : String(v));
                    if (count++ < paramsLength - 1) {
                        _params += "&";
                    }
                }
            }
        }

        var completed = false;
        function done(e: any, d: any) {
            if (completed) return;
            completed = true;
            onFinished(e, d);
        }

        var quiet = opts && opts.quiet === true;
        xhr.timeout = opts && opts.timeoutMs != null ? opts.timeoutMs : 45000;
        xhr.onerror = function() {
            console.error("[Http.get] network error", url + "?" + _params.substring(0, 200));
            if (!quiet) {
                App.instance.alertDialog.showMsg("Connection Error");
            }
            done("network_error", null);
        };
        xhr.ontimeout = function() {
            if (!quiet) {
                App.instance.alertDialog.showMsg("Connection timeout");
            }
            done("timeout", null);
        };

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var data = null;
                    var e = null;
                    try {
                        data = JSON.parse(xhr.responseText);
                    } catch (ex) {
                        console.error("[Http.get] JSON parse error", url, ex, xhr.responseText && xhr.responseText.substring(0, 500));
                        e = ex;
                    }
                    done(e, data);
                } else {
                    console.warn("[Http.get] HTTP", xhr.status, url);
                    done(xhr.status, null);
                }
            }
        };
        xhr.open("GET", url + "?" + _params, true);
        xhr.send();
    }

    static getHeath(url: string, onFinished: (err: any, json: any) => void) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var data = null;
                    var e = null;
                    try {
                        data = JSON.parse(xhr.responseText);
                    } catch (ex) {
                        e = ex;
                    }
                    onFinished(e, data);
                } else {
                    onFinished(xhr.status, null);
                }
            }
        };
        xhr.onerror = function(){
            onFinished("error" , null);
        }
        xhr.open("GET", url, true);
        xhr.send();
    }

}
