package com.vinplay.api.utils;

import com.vinplay.vbee.common.utils.VinPlayUtils;

import javax.crypto.BadPaddingException;
import javax.crypto.Cipher;
import javax.crypto.IllegalBlockSizeException;
import javax.crypto.NoSuchPaddingException;
import javax.crypto.spec.IvParameterSpec;
import javax.crypto.spec.SecretKeySpec;
import java.io.UnsupportedEncodingException;
import java.nio.charset.StandardCharsets;
import java.security.DigestException;
import java.security.InvalidAlgorithmParameterException;
import java.security.InvalidKeyException;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.Arrays;
import java.util.Base64;

/**
 * Web/mobile clients send {@code pw} as either a 32-char MD5 hex string or a Base64 payload
 * decrypted with OpenSSL EVP_BytesToKey + AES/CBC (same as {@code LoginProcessor}).
 * Registration must store the same MD5 hash as login compares against.
 */
public final class WebPasswordNormalizer {

    private static final String AES_SECRET = "12345";

    private WebPasswordNormalizer() {
    }

    public static String toStoredPasswordHash(String password) throws UnsupportedEncodingException, NoSuchAlgorithmException {
        if (password == null) {
            return null;
        }
        if (password.length() == 32) {
            return password;
        }
        try {
            String decoded = new String(Base64.getDecoder().decode(password), StandardCharsets.UTF_8);
            // CryptoJS / EditBox có thể thêm khoảng trắng; MD5("123456 ") ≠ MD5("123456") → 1007
            String realPass = decryptOpenSslStyle(decoded, AES_SECRET).trim();
            return VinPlayUtils.getMD5Hash(realPass);
        } catch (Exception ignored) {
            return password;
        }
    }

    private static String decryptOpenSslStyle(String strToDecrypt, String secret)
            throws NoSuchAlgorithmException, NoSuchPaddingException, InvalidAlgorithmParameterException,
            InvalidKeyException, IllegalBlockSizeException, BadPaddingException {

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

    private static byte[][] generateKeyAndIv(int keyLength, int ivLength, int iterations, byte[] salt, byte[] password,
            MessageDigest md) {

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

        } catch (DigestException e) {
            throw new RuntimeException(e);

        } finally {
            Arrays.fill(generatedData, (byte) 0);
        }
    }
}
