/**
 * cocos-globals.ts — Jest setup file.
 * Cung cấp các global biến Cocos Creator inject vào runtime
 * để test các module thuần TypeScript trong core/.
 */
import CryptoJS from "crypto-js";

// Cocos injections used by core/auth/PortalPassword.ts
(global as any).CryptoJS = CryptoJS;
(global as any).base64 = {
    encode: (str: string): string => Buffer.from(str, "binary").toString("base64"),
    decode: (str: string): string => Buffer.from(str, "base64").toString("binary"),
};

// Minimal cc namespace (game components not needed in unit tests)
(global as any).cc = {
    _decorator: {
        ccclass: () => (target: any) => target,
        property: () => () => {},
    },
    Component: class {},
    Node: class {},
};
