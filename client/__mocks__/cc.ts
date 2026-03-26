/**
 * cc.ts — Jest mock cho Cocos Creator cc namespace.
 * Khi test import module dùng `import cc from 'cc'` hoặc `const {ccclass} = cc._decorator`,
 * Jest sẽ dùng file này thay vì Cocos runtime.
 */
const cc: any = {
    _decorator: {
        ccclass: () => (target: any) => target,
        property: () => () => {},
        menu: () => () => {},
        executionOrder: () => () => {},
        disallowMultiple: () => () => {},
    },
    Component: class Component {
        node: any = { active: true, on: () => {}, off: () => {}, emit: () => {} };
        onLoad() {}
        start() {}
        onEnable() {}
        onDisable() {}
        onDestroy() {}
    },
    Node: class Node {
        active: boolean = true;
        on() {}
        off() {}
        emit() {}
    },
    game: { on: () => {}, EVENT_SHOW: 'game_on_show' },
    director: { runScene: () => {}, loadScene: () => {} },
    sys: { platform: 0, MOBILE_BROWSER: 2, isNative: false, openURL: () => {} },
    assetManager: { getBundle: () => null, removeBundle: () => {} },
    resources: { load: () => {} },
    macro: { ENABLE_TILEDMAP_SKEW_ROTATE: false },
};

module.exports = cc;
export default cc;
