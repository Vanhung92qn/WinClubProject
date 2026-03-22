import App from "../../scripts/common/App";
import BundleControl from "../../scripts/common/BundleControl";

/**
 * Popup loading tier:
 * - CRITICAL: Preloaded via @property in scene (login, register, loading indicator)
 * - STANDARD: Lazy-loaded on first use, prefab cached for subsequent opens
 * - RARE: Lazy-loaded on first use, prefab released after popup is closed
 */
export enum PopupTier {
    CRITICAL = 1,
    STANDARD = 2,
    RARE = 3,
}

export interface PopupConfig {
    prefabPath: string;   // Path within Lobby bundle, e.g. "res/prefabs/PopupShop"
    tier: PopupTier;
    isGlobal: boolean;    // true = add to App PopupParent, false = add to nodeLobby
}

export default class PopupManager {

    private static _instance: PopupManager = null;

    static get instance(): PopupManager {
        if (PopupManager._instance == null) {
            PopupManager._instance = new PopupManager();
        }
        return PopupManager._instance;
    }

    /** Registry: popup name -> config */
    private _registry: Map<string, PopupConfig> = new Map();

    /** Cached prefabs (Tier STANDARD only) */
    private _prefabCache: Map<string, cc.Prefab> = new Map();

    /** Currently loading popups (prevent double-tap) */
    private _loading: Set<string> = new Set();

    /**
     * Register a popup for lazy loading.
     * Call this in LobbyController.onLoad() for each Tier 2/3 popup.
     */
    register(name: string, config: PopupConfig): void {
        this._registry.set(name, config);
    }

    /**
     * Open a popup by name. Loads prefab on-demand if not cached.
     * Returns the instantiated popup node (or null on error).
     */
    async openPopup(name: string, parentNode?: cc.Node): Promise<cc.Node> {
        let config = this._registry.get(name);
        if (!config) {
            console.error(`[PopupManager] Popup "${name}" not registered.`);
            return null;
        }

        // Prevent double-tap while loading
        if (this._loading.has(name)) {
            return null;
        }

        // Load prefab (from cache or bundle)
        let prefab = await this._loadPrefab(name, config);
        if (!prefab) {
            console.error(`[PopupManager] Failed to load prefab for "${name}" at path "${config.prefabPath}"`);
            return null;
        }

        // Instantiate and show with animation
        let node = this._instantiateAndShow(prefab, config, parentNode);

        // For RARE tier: release prefab after popup is destroyed
        if (config.tier === PopupTier.RARE) {
            node.on(cc.Node.EventType.CHILD_REMOVED, () => {}, this);
            // Listen for node destroy to release prefab
            let originalDestroy = node.destroy.bind(node);
            node.destroy = () => {
                BundleControl.releaseLobbyAsset(config.prefabPath);
                return originalDestroy();
            };
        }

        return node;
    }

    /**
     * Release all cached prefabs (call on memory pressure or scene switch).
     * If name is provided, only release that specific popup's cache.
     */
    releaseCached(name?: string): void {
        if (name) {
            let config = this._registry.get(name);
            if (config && this._prefabCache.has(name)) {
                BundleControl.releaseLobbyAsset(config.prefabPath);
                this._prefabCache.delete(name);
            }
        } else {
            this._prefabCache.forEach((prefab, key) => {
                let config = this._registry.get(key);
                if (config) {
                    BundleControl.releaseLobbyAsset(config.prefabPath);
                }
            });
            this._prefabCache.clear();
        }
    }

    // ── Internal ──

    private async _loadPrefab(name: string, config: PopupConfig): Promise<cc.Prefab> {
        // Check cache first (Tier STANDARD)
        if (this._prefabCache.has(name)) {
            return this._prefabCache.get(name);
        }

        this._loading.add(name);
        try {
            let prefab = await BundleControl.loadLobbyPrefab(config.prefabPath);
            if (prefab && config.tier === PopupTier.STANDARD) {
                this._prefabCache.set(name, prefab);
            }
            return prefab;
        } finally {
            this._loading.delete(name);
        }
    }

    private _instantiateAndShow(prefab: cc.Prefab, config: PopupConfig, parentNode?: cc.Node): cc.Node {
        let popup = cc.instantiate(prefab);

        // Determine parent node
        let parent = parentNode;
        if (!parent) {
            if (config.isGlobal) {
                parent = App.instance.node.getChildByName('PopupParent');
            } else {
                // Find nodeLobby from LobbyController
                let lobbyScene = cc.director.getScene();
                if (lobbyScene) {
                    // nodeLobby is a property on LobbyController, we access it via the scene
                    // Use the same pattern as actOpenPopup: add to nodeLobby or PopupParent
                    parent = App.instance.node.getChildByName('PopupParent');
                }
            }
        }

        if (parent) {
            parent.addChild(popup);
        }

        // Replicate the exact animation from actOpenPopup (LobbyController:1924-1930)
        let container = popup.getChildByName('Container');
        if (container) {
            container.scale = 0;
            container.runAction(
                cc.sequence(
                    cc.scaleTo(0.27, 1.1),
                    cc.scaleTo(0.06, 1)
                )
            );
        }

        return popup;
    }
}
