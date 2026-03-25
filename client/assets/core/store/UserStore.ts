import Configs from "../../scripts/common/Configs";

/**
 * UserStore — Typed, reactive facade over Configs.Login.
 *
 * WHY: Configs.Login is a mutable static namespace used in 100+ files.
 *      Components that only need to READ user state should import UserStore
 *      instead of the entire Configs namespace, and subscribe to changes
 *      via UserStore.on() instead of directly wiring BroadcastReceiver.
 *
 * COMPATIBILITY: Configs.Login remains the backing store.
 *      UserStore reads from it; AuthService writes to it.
 *      Existing code importing Configs.Login continues to work unchanged.
 */
export default class UserStore {

    // ── Read-only accessors ──

    static get isLoggedIn(): boolean { return Configs.Login.IsLogin; }
    static get userId(): number      { return Configs.Login.UserId; }
    static get username(): string    { return Configs.Login.Username; }
    static get nickname(): string    { return Configs.Login.Nickname; }
    static get avatar(): string      { return Configs.Login.Avatar; }
    static get coin(): number        { return Configs.Login.Coin; }
    static get vipPoint(): number    { return Configs.Login.VipPoint; }
    static get sessionKey(): string  { return Configs.Login.SessionKey; }
    static get accessToken(): string { return Configs.Login.AccessToken; }
    static get mobileSecured(): boolean { return Configs.Login.MobileSecured; }
    static get appSecured(): boolean    { return Configs.Login.AppSecured; }
    static get banTransfer(): boolean   { return Configs.Login.BanTransfer; }

    /** Fish/Banca sub-account */
    static get coinFish(): number      { return Configs.Login.CoinFish; }
    static get userIdFish(): number    { return Configs.Login.UserIdFish; }
    static get usernameFish(): string  { return Configs.Login.UsernameFish; }
    static get passwordFish(): string  { return Configs.Login.PasswordFish; }
    static get fishConfigs(): any      { return Configs.Login.FishConfigs; }
    static get bitcoinToken(): string  { return Configs.Login.BitcoinToken; }

    static getVipPointName(): string { return Configs.Login.getVipPointName(); }

    // ── Subscription ──

    private static _listeners: Array<(event: UserStoreEvent) => void> = [];

    /**
     * Subscribe to user state changes.
     * Returns an unsubscribe function:
     *   const unsub = UserStore.on(e => { ... });
     *   // later: unsub();
     */
    static on(listener: (event: UserStoreEvent) => void): () => void {
        UserStore._listeners.push(listener);
        return () => {
            const idx = UserStore._listeners.indexOf(listener);
            if (idx >= 0) UserStore._listeners.splice(idx, 1);
        };
    }

    /** Called by BroadcastReceiver wiring (done once in App.ts or AuthService). */
    static _notifyChange(event: UserStoreEvent): void {
        for (const fn of UserStore._listeners) {
            try { fn(event); } catch (e) { console.error("[UserStore] listener error:", e); }
        }
    }
}

export type UserStoreEvent = "login" | "logout" | "coin_updated" | "profile_updated";

// ── AuthService calls UserStore._notifyChange() directly after login/logout ──
// BroadcastReceiver requires a cc.Component target so cannot be wired here.
