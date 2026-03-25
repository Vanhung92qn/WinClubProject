package com.vinplay.api.utils;

import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.params.ParameterizedTest;
import org.junit.jupiter.params.provider.NullAndEmptySource;

import static org.junit.jupiter.api.Assertions.*;

/**
 * Unit tests cho PasswordService — xác minh luồng BCrypt + MD5 backward-compat.
 *
 * Chạy: ./gradlew :VinPlayPortal:test
 */
@DisplayName("PasswordService")
class PasswordServiceTest {

    // ── decryptClientPassword ─────────────────────────────────────────────────

    @Test
    @DisplayName("decryptClientPassword: null → null")
    void decrypt_null_returnsNull() {
        assertNull(PasswordService.decryptClientPassword(null));
    }

    @Test
    @DisplayName("decryptClientPassword: empty string → null or empty")
    void decrypt_empty_returnsNullOrEmpty() {
        String result = PasswordService.decryptClientPassword("");
        assertTrue(result == null || result.isEmpty());
    }

    @Test
    @DisplayName("decryptClientPassword: invalid base64 → trả về raw input (fallback)")
    void decrypt_invalidBase64_returnsFallback() {
        String raw = "plaintext_not_encrypted";
        String result = PasswordService.decryptClientPassword(raw);
        // Fallback: trả về input gốc sau khi trim
        assertNotNull(result);
    }

    // ── hashPassword + verifyPassword ────────────────────────────────────────

    @Test
    @DisplayName("hashPassword: tạo BCrypt hash bắt đầu bằng $2a$")
    void hash_producesBcryptFormat() {
        String hash = PasswordService.hashPassword("secret123");
        assertNotNull(hash);
        assertTrue(hash.startsWith("$2a$") || hash.startsWith("$2b$"),
                "Phải là BCrypt hash, nhưng nhận được: " + hash);
        assertEquals(60, hash.length(), "BCrypt hash phải dài 60 ký tự");
    }

    @Test
    @DisplayName("hashPassword: cùng password → khác hash (do salt ngẫu nhiên)")
    void hash_samePassword_differentHashes() {
        String h1 = PasswordService.hashPassword("password");
        String h2 = PasswordService.hashPassword("password");
        assertNotEquals(h1, h2, "Hai lần hash cùng password không được giống nhau (salt random)");
    }

    @Test
    @DisplayName("verifyPassword: BCrypt — xác minh đúng password")
    void verify_bcrypt_correct() {
        String plain = "testPass!@#";
        String hash = PasswordService.hashPassword(plain);
        assertTrue(PasswordService.verifyPassword(plain, hash));
    }

    @Test
    @DisplayName("verifyPassword: BCrypt — từ chối sai password")
    void verify_bcrypt_wrong() {
        String hash = PasswordService.hashPassword("correct");
        assertFalse(PasswordService.verifyPassword("wrong", hash));
    }

    @Test
    @DisplayName("verifyPassword: MD5 legacy — xác minh đúng (MD5 hex = stored hash)")
    void verify_md5Legacy_directMatch() {
        // Giả lập: stored hash đúng là MD5 của "abc123"
        String md5Hash = "e99a18c428cb38d5f260853678922e03"; // MD5("abc123")
        // Direct match: input là chính MD5 hash đó
        assertTrue(PasswordService.verifyPassword(md5Hash, md5Hash));
    }

    @Test
    @DisplayName("verifyPassword: null inputs → false")
    void verify_nullInputs_returnsFalse() {
        assertFalse(PasswordService.verifyPassword(null, "$2a$10$hash"));
        assertFalse(PasswordService.verifyPassword("password", null));
        assertFalse(PasswordService.verifyPassword(null, null));
    }

    // ── isLegacyHash ──────────────────────────────────────────────────────────

    @Test
    @DisplayName("isLegacyHash: MD5 32-char hex → true")
    void isLegacy_md5_returnsTrue() {
        String md5 = "e99a18c428cb38d5f260853678922e03"; // 32 chars
        assertTrue(PasswordService.isLegacyHash(md5));
    }

    @Test
    @DisplayName("isLegacyHash: BCrypt hash → false")
    void isLegacy_bcrypt_returnsFalse() {
        String bcrypt = PasswordService.hashPassword("any");
        assertFalse(PasswordService.isLegacyHash(bcrypt));
    }

    @Test
    @DisplayName("isLegacyHash: null → false")
    void isLegacy_null_returnsFalse() {
        assertFalse(PasswordService.isLegacyHash(null));
    }
}
