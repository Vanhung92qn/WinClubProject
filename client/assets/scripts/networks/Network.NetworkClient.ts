import NetworkListener from "./Network.NetworkListener";
import Configs from "../common/Configs";

export default class NetworkClient {
    ws: WebSocket = null;
    host: string = "";
    port: number = 0;
    isForceClose = false;
    isUseWSS: boolean = false;
    isAutoReconnect: boolean = true;

    _onOpenes: Array<NetworkListener> = [];
    _onCloses: Array<NetworkListener> = [];

    // Reconnect: exponential backoff (2s → 4s → 8s → 16s → 30s cap)
    private _reconnectAttempts: number = 0;
    private _maxReconnectAttempts: number = 10;
    private _baseReconnectDelay: number = 2000;
    private _maxReconnectDelay: number = 30000;
    private _reconnectTimer: any = null;

    /**
     * All WebSocket traffic goes through Nginx reverse proxy:
     *   wss://DOMAIN/socket-client/{gamePath}
     * Client NEVER sees internal IP:port of game servers.
     */
    private buildWsUrl(host: string): string {
        let domain = Configs.App.DOMAIN;
        if (domain.endsWith('/')) domain = domain.slice(0, -1);
        let protocol = Configs.App.USE_WSS ? 'wss' : 'ws';
        return `${protocol}://${domain}/socket-client/${host}`;
    }

    connect(host: string, port: number) {
        this.isForceClose = false;
        this.host = host;
        this.port = port;
        if (this.ws == null) {
            let url = this.buildWsUrl(host);
            console.log(`[WS] Connecting: ${url}`);
            try {
                if (Configs.App.USE_WSS && cc.sys.isNative && cc.sys.os == cc.sys.OS_ANDROID) {
                    let cacert = cc.url.raw('resources/raw/cacert.pem');
                    if (cc.loader.md5Pipe) {
                        cacert = cc.loader.md5Pipe.transformURL(cacert);
                    }
                    // @ts-ignore - Cocos native WebSocket accepts cacert param
                    this.ws = new WebSocket(url, [], cacert);
                } else {
                    this.ws = new WebSocket(url);
                }
            } catch (e) {
                console.error(`[WS] Failed to create WebSocket: ${e}`);
                this.ws = null;
                this.scheduleReconnect();
                return;
            }
            this.ws.binaryType = "arraybuffer";
            this.ws.onopen = this.onOpen.bind(this);
            this.ws.onmessage = this.onMessage.bind(this);
            this.ws.onerror = this.onError.bind(this);
            this.ws.onclose = this.onClose.bind(this);
        } else {
            if (this.ws.readyState !== WebSocket.OPEN) {
                this.ws.close();
                this.ws = null;
                this.connect(host, port);
            }
        }
    }

    protected onOpen(ev: Event) {
        console.log("[WS] Connected: " + this.host);
        this._reconnectAttempts = 0; // Reset backoff on success
        for (var i = 0; i < this._onOpenes.length; i++) {
            var listener = this._onOpenes[i];
            if (listener.target && listener.target instanceof Object && listener.target.node) {
                listener.callback(null);
            } else {
                this._onOpenes.splice(i, 1);
                i--;
            }
        }
    }

    protected onMessage(ev: MessageEvent) {
    }

    protected onError(ev: Event) {
        console.warn("[WS] Error: " + this.host);
    }

    protected onClose(ev: Event) {
        console.log("[WS] Closed: " + this.host);
        for (var i = 0; i < this._onCloses.length; i++) {
            var listener = this._onCloses[i];
            if (listener.target && listener.target instanceof Object && listener.target.node) {
                listener.callback(null);
            } else {
                this._onCloses.splice(i, 1);
                i--;
            }
        }
        this.ws = null;
        this.scheduleReconnect();
    }

    /**
     * Exponential backoff reconnect: 2s → 4s → 8s → 16s → 30s (cap)
     * Prevents flood when game server is down.
     */
    private scheduleReconnect() {
        if (!this.isAutoReconnect || this.isForceClose) return;
        if (this._reconnectAttempts >= this._maxReconnectAttempts) {
            console.warn(`[WS] Max reconnect attempts (${this._maxReconnectAttempts}) reached for ${this.host}`);
            return;
        }
        let delay = Math.min(
            this._baseReconnectDelay * Math.pow(2, this._reconnectAttempts),
            this._maxReconnectDelay
        );
        this._reconnectAttempts++;
        console.log(`[WS] Reconnect #${this._reconnectAttempts} in ${delay}ms: ${this.host}`);
        if (this._reconnectTimer) clearTimeout(this._reconnectTimer);
        this._reconnectTimer = setTimeout(() => {
            this._reconnectTimer = null;
            if (!this.isForceClose) this.connect(this.host, this.port);
        }, delay);
    }

    addOnOpen(callback: () => void, target: cc.Component) {
        this._onOpenes.push(new NetworkListener(target, callback));
    }

    addOnClose(callback: () => void, target: cc.Component) {
        this._onCloses.push(new NetworkListener(target, callback));
    }

    close() {
        this.isForceClose = true;
        this._reconnectAttempts = 0;
        if (this._reconnectTimer) {
            clearTimeout(this._reconnectTimer);
            this._reconnectTimer = null;
        }
        if (this.ws) {
            this.ws.close();
            this.ws = null;
        }
    }

    /** Reset reconnect counter (call when user re-enters a game) */
    resetReconnect() {
        this._reconnectAttempts = 0;
    }

    isConnected() {
        if (this.ws) {
            return this.ws.readyState == WebSocket.OPEN;
        }
        return false;
    }
}