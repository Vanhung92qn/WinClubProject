package com.vinplay.api.utils;

import org.mindrot.jbcrypt.BCrypt;
import org.apache.log4j.Logger;

import javax.crypto.Cipher;
import javax.crypto.spec.IvParameterSpec;
import javax.crypto.spec.SecretKeySpec;
import java.nio.charset.StandardCharsets;
import java.security.MessageDigest;
import java.util.Arrays;
import java.util.Base64;

/**
 * Centralized password service: decrypt client payload → BCrypt hash/verify.
 *
 * Client sends: Base64( AES-CBC-encrypt( plainPassword, "12345" ) )
 * Server: decrypt → plaintext → BCrypt.hashpw / BCrypt.checkpw
 *
 * Migration note: old passwords are stored as 32-char MD5 hex.
 * BCrypt hashes are 60-char starting with "$2a$".
 * verifyPassword() handles both formats for backward compatibility.
 */
public final class PasswordService {

    private static final Logger logger = Logger.getLogger("api");
    private static final String AES_SECRET = "12345";
    private static final int BCRYPT_ROUNDS = 10;

    private PasswordService() {}

    /**
     * Decrypt the AES-encrypted password from client → plaintext.
     * If the input is already plaintext (< 32 chars, no base64), returns as-is.
     */
    public static String decryptClientPassword(String encryptedPw) {
        if (encryptedPw == null || encryptedPw.isEmpty()) {
            return null;
        }
        try {
            String decoded = new String(Base64.getDecoder().decode(encryptedPw), StandardCharsets.UTF_8);
            return decryptOpenSslStyle(decoded, AES_SECRET).trim();
        } catch (Exception e) {
            logger.debug("Password decrypt failed, using raw value: " + e.getMessage());
            return encryptedPw.trim();
        }
    }

    /**
     * Hash a plaintext password with BCrypt for storage.
     */
    public static String hashPassword(String plainPassword) {
        return BCrypt.hashpw(plainPassword, BCrypt.gensalt(BCRYPT_ROUNDS));
    }

    /**
     * Verify plaintext against stored hash.
     * Supports both BCrypt ($2a$...) and legacy MD5 (32-char hex) formats.
     */
    public static boolean verifyPassword(String plainPassword, String storedHash) {
        if (plainPassword == null || storedHash == null) {
            return false;
        }
        if (storedHash.startsWith("$2a$") || storedHash.startsWith("$2b$") || storedHash.startsWith("$2y$")) {
            return BCrypt.checkpw(plainPassword, storedHash);
        }
        // Legacy MD5 fallback (32-char hex)
        if (storedHash.length() == 32) {
            // Direct match: input is already MD5 hash (e.g. from old banca client)
            if (plainPassword.equals(storedHash)) return true;
            // Input is plaintext → hash and compare
            try {
                return storedHash.equals(getMD5Hash(plainPassword));
            } catch (Exception e) {
                return false;
            }
        }
        return false;
    }

    /**
     * Check if a stored hash is legacy MD5 (needs migration to BCrypt).
     */
    public static boolean isLegacyHash(String storedHash) {
        return storedHash != null && storedHash.length() == 32
                && !storedHash.startsWith("$2a$");
    }

    // ── Internal helpers ──

    private static String getMD5Hash(String input) throws Exception {
        MessageDigest md = MessageDigest.getInstance("MD5");
        byte[] digest = md.digest(input.getBytes(StandardCharsets.UTF_8));
        StringBuilder sb = new StringBuilder();
        for (byte b : digest) {
            sb.append(String.format("%02x", b));
        }
        return sb.toString();
    }

    private static String decryptOpenSslStyle(String strToDecrypt, String secret) throws Exception {
        byte[] cipherData = Base64.getDecoder().decode(strToDecrypt);
        byte[] saltData = Arrays.copyOfRange(cipherData, 8, 16);

        MessageDigest md5 = MessageDigest.getInstance("MD5");
        final byte[][] keyAndIV = generateKeyAndIv(32, 16, 1, saltData, secret.getBytes(StandardCharsets.UTF_8), md5);
        SecretKeySpec key = new SecretKeySpec(keyAndIV[0], "AES");
        IvParameterSpec iv = new IvParameterSpec(keyAndIV[1]);

        byte[] encrypted = Arrays.copyOfRange(cipherData, 16, cipherData.length);
        Cipher aesCBC = Cipher.getInstance("AES/CBC/PKCS5Padding");
        aesCBC.init(Cipher.DECRYPT_MODE, key, iv);
        byte[] decryptedData = aesCBC.doFinal(encrypted);
        return new String(decryptedData, StandardCharsets.UTF_8);
    }

    private static byte[][] generateKeyAndIv(int keyLength, int ivLength, int iterations,
                                              byte[] salt, byte[] password, MessageDigest md) throws Exception {
        int digestLength = md.getDigestLength();
        int requiredLength = (keyLength + ivLength + digestLength - 1) / digestLength * digestLength;
        byte[] generatedData = new byte[requiredLength];
        int generatedLength = 0;
        try {
            md.reset();
            while (generatedLength < keyLength + ivLength) {
                if (generatedLength > 0) {
                    md.update(generatedData, generatedLength - digestLength, digestLength);
                }
                md.update(password);
                if (salt != null) {
                    md.update(salt, 0, 8);
                }
                md.digest(generatedData, generatedLength, digestLength);
                for (int i = 1; i < iterations; i++) {
                    md.update(generatedData, generatedLength, digestLength);
                    md.digest(generatedData, generatedLength, digestLength);
                }
                generatedLength += digestLength;
            }
            byte[][] result = new byte[2][];
            result[0] = Arrays.copyOfRange(generatedData, 0, keyLength);
            if (ivLength > 0) {
                result[1] = Arrays.copyOfRange(generatedData, keyLength, keyLength + ivLength);
            }
            return result;
        } finally {
            Arrays.fill(generatedData, (byte) 0);
        }
    }
}
