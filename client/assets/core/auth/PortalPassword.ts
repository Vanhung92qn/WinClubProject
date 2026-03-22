/**
 * Password on wire must match {@link Lobby.PopUplogin} / LobbyController.actLogin (c=3):
 * CryptoJS.AES.encrypt(plain, "12345") then base64, so VinPlayPortal {@code WebPasswordNormalizer} matches.
 * Register / update-nickname previously used md5() only — same final hash in DB, but this keeps one path with login.
 */
export default class PortalPassword {
    private static md52(message: string, key: string): string {
        let m = CryptoJS.AES.encrypt(message, key);
        return base64.encode(m.toString());
    }

    static forApi(plainPassword: string): string {
        if (plainPassword == null || plainPassword === "") {
            return plainPassword;
        }
        return PortalPassword.md52(plainPassword.trim(), "12345");
    }
}
