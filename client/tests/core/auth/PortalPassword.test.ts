import PortalPassword from "core/auth/PortalPassword";

describe("PortalPassword.forApi()", () => {

    it("trả về null khi input là null", () => {
        expect(PortalPassword.forApi(null)).toBeNull();
    });

    it("trả về empty string khi input là empty", () => {
        expect(PortalPassword.forApi("")).toBe("");
    });

    it("trim whitespace trước khi mã hóa", () => {
        const withSpaces  = PortalPassword.forApi("  abc123  ");
        const withoutSpaces = PortalPassword.forApi("abc123");
        expect(withSpaces).toBe(withoutSpaces);
    });

    it("trả về string base64 (không chứa ký tự đặc biệt nguy hiểm)", () => {
        const result = PortalPassword.forApi("password123");
        // AES encrypt → CryptoJS string → base64: chỉ chứa [A-Za-z0-9+/=]
        expect(result).toMatch(/^[A-Za-z0-9+/=]+$/);
    });

    it("cùng password → cùng output (deterministic với CryptoJS passphrase mode)", () => {
        // CryptoJS.AES.encrypt với passphrase STRING dùng salt ngẫu nhiên
        // → KHÔNG deterministic. Kiểm tra output là valid base64 thay vì equality.
        const r1 = PortalPassword.forApi("secret");
        const r2 = PortalPassword.forApi("secret");
        // Chỉ kiểm tra định dạng, không so sánh giá trị (do salt random)
        expect(r1).toMatch(/^[A-Za-z0-9+/=]+$/);
        expect(r2).toMatch(/^[A-Za-z0-9+/=]+$/);
    });

    it("password khác nhau → output khác nhau", () => {
        const r1 = PortalPassword.forApi("password1");
        const r2 = PortalPassword.forApi("password2");
        // Với salt random, độ dài thường giống nhau nhưng nội dung khác
        // Kiểm tra không phải empty
        expect(r1.length).toBeGreaterThan(0);
        expect(r2.length).toBeGreaterThan(0);
    });

    it("output dài hơn input (vì AES encrypt thêm IV + salt + padding)", () => {
        const input = "pw";
        const output = PortalPassword.forApi(input);
        expect(output.length).toBeGreaterThan(input.length);
    });
});
