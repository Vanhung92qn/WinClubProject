/*
 * Decompiled with CFR 0.144.
 *
 * Could not load the following classes:
 *  com.hazelcast.core.IMap
 *  com.vinplay.usercore.service.impl.MarketingServiceImpl
 *  com.vinplay.usercore.service.impl.UserServiceImpl
 *  com.vinplay.usercore.utils.GameCommon
 *  com.vinplay.usercore.utils.UserMakertingUtil
 *  com.vinplay.vbee.common.cp.BaseProcessor
 *  com.vinplay.vbee.common.cp.Param
 *  com.vinplay.vbee.common.enums.StatusGames
 *  com.vinplay.vbee.common.hazelcast.HazelcastClientFactory
 *  com.vinplay.vbee.common.messages.UserMarketingMessage
 *  com.vinplay.vbee.common.models.SocialModel
 *  com.vinplay.vbee.common.models.UserModel
 *  com.vinplay.vbee.common.response.LoginResponse
 *  com.vinplay.vbee.common.utils.VinPlayUtils
 *  javax.servlet.http.HttpServletRequest
 *  org.apache.log4j.Logger
 */
package com.vinplay.api.processors;

import bitzero.util.common.business.Debug;
import com.hazelcast.core.IMap;
import com.vinplay.api.utils.PasswordService;
import com.vinplay.api.utils.PortalUtils;
import com.vinplay.api.utils.SocialUtils;
import com.vinplay.usercore.dao.impl.SecurityDaoImpl;
import com.vinplay.usercore.service.CacheService;
import com.vinplay.usercore.service.OtpService;
import com.vinplay.usercore.service.impl.CacheServiceImpl;
import com.vinplay.usercore.service.impl.MarketingServiceImpl;
import com.vinplay.usercore.service.impl.OtpServiceImpl;
import com.vinplay.usercore.service.impl.UserServiceImpl;
import com.vinplay.usercore.utils.GameCommon;
import com.vinplay.usercore.utils.UserMakertingUtil;
import com.vinplay.vbee.common.cp.BaseProcessor;
import com.vinplay.vbee.common.cp.Param;
import com.vinplay.vbee.common.enums.StatusGames;
import com.vinplay.vbee.common.hazelcast.HazelcastClientFactory;
import com.vinplay.vbee.common.messages.UserMarketingMessage;
import com.vinplay.vbee.common.models.SocialModel;
import com.vinplay.vbee.common.models.UserModel;
import com.vinplay.vbee.common.response.LoginResponse;
import com.vinplay.vbee.common.utils.VinPlayUtils;
import org.apache.log4j.Logger;

import javax.servlet.http.HttpServletRequest;
import java.util.Date;

public class LoginPostProcessor
        implements BaseProcessor<HttpServletRequest, String> {
    private static final Logger logger = Logger.getLogger((String) "api");

    public String execute(Param<HttpServletRequest> param) {
        HttpServletRequest request = param.get();
        String username = param.get().getParameter("un");
        System.out.println("process login with username(method POST) : " + username);
        String encryptedPw = param.get().getParameter("pw");
        // Decrypt AES-encrypted password from client → plaintext
        String plainPassword = PasswordService.decryptClientPassword(encryptedPw);
        String social = param.get().getParameter("s");
        String accessToken = param.get().getParameter("at");
        request.getHeader("user-agent");
        logger.debug((Object) ("Request login: username: " + username + ", social: " + social + ", accessToken: " + accessToken));
        if (username != null && plainPassword != null || social != null && (social.equals("fb") || social.equals("gg")) && accessToken != null) {
            LoginResponse res = new LoginResponse(false, "1009");
            if (username == null || username.length() > 20 || username.length() < 6) {
                return res.toJson();
            }
            try {
                int statusGame = GameCommon.getValueInt((String) "STATUS_GAME");
                if (statusGame == StatusGames.MAINTAIN.getId()) {
                    res.setErrorCode("1114");
                    logger.debug("Response login: " + res.toJson());
                    return res.toJson();
                }
                CacheService cacheService = new CacheServiceImpl();
                cacheService.setValue("login_noti", "true");
                UserServiceImpl userService = new UserServiceImpl();
                if (social != null && (social.equals("fb") || social.equals("gg"))) {
                    String cache = social.equals("fb") ? "cacheFacebook" : "cacheGoogle";
                    IMap socialMap = HazelcastClientFactory.getInstance().getMap(cache);
                    String socialId = SocialUtils.getSocialId((IMap<String, SocialModel>) socialMap, accessToken, social);
                    if (socialId == null) {
                        logger.debug((Object) ("Response login: " + res.toJson()));
                        return res.toJson();
                    }
                    if (socialId.isEmpty()) {
                        res.setErrorCode("1009");
                        logger.debug((Object) ("Response login: " + res.toJson()));
                        return res.toJson();
                    }
                    UserModel userModel = userService.getUserBySocialId(socialId, social);
                    if (userModel == null) {
                        if (statusGame == StatusGames.SANDBOX.getId()) {
                            res.setErrorCode("1114");
                            return res.toJson();
                        }
                        if (userModel.isBot()) {
                            res.setErrorCode("1114");
                            return res.toJson();
                        }
                        if (userService.insertUserBySocial(socialId, social)) {
                            socialMap.put((Object) socialId, (Object) new SocialModel(accessToken, socialId, new Date()));
                            String campaign = param.get().getParameter("utm_campaign");
                            String medium = param.get().getParameter("utm_medium");
                            String source = param.get().getParameter("utm_source");
                            if (campaign != null && medium != null && source != null) {
                                MarketingServiceImpl mktService = new MarketingServiceImpl();
                                UserMarketingMessage message = new UserMarketingMessage(username, "", 0, VinPlayUtils.getCurrentDateMarketing(), campaign, medium, source);
                                mktService.saveUserMarketing(message);
                                UserMakertingUtil.newRegisterUser((String) campaign, (String) medium, (String) source);
                            }
                            res.setErrorCode("2001");
                        }
                    } else {
                        if (statusGame == StatusGames.SANDBOX.getId() && !userModel.isCanLoginSandbox()) {
                            res.setErrorCode("1114");
                            logger.debug((Object) ("Response login: " + res.toJson()));
                            return res.toJson();
                        }
                        if (!userModel.isBanLogin()) {
                            if (userModel.getNickname() != null && !userModel.getNickname().trim().isEmpty()) {
                                if (userModel.isHasLoginSecurity() && userModel.getLoginOtp() >= 0L && userModel.getLoginOtp() <= userModel.getVinTotal()) {
                                    // send otp
                                    OtpService otpService = new OtpServiceImpl();
                                    int ret = otpService.sendVoiceOtp(userModel.getNickname(), "", true);
                                    if (ret != 0) {
                                        Debug.trace("Cannot send OTP message!");
                                        res.setErrorCode("116");
                                        return res.toJson();
                                    }
                                    res.setErrorCode("1012");
                                } else {
                                    SocialUtils.socialSuccess((IMap<String, SocialModel>) socialMap, socialId, accessToken);
                                    res = PortalUtils.loginSuccess(userModel, request);
                                }
                            } else {
                                res.setErrorCode("2001");
                            }
                        } else {
                            res.setErrorCode("1109");
                        }
                    }
                } else {
                    UserModel userModel2 = userService.getUserByUserName(username);
                    if (userModel2 != null) {
                        if (userModel2.isBot()) {
                            res.setErrorCode("1114");
                            return res.toJson();
                        }
                        if (statusGame == StatusGames.SANDBOX.getId() && !userModel2.isCanLoginSandbox()) {
                            res.setErrorCode("1114");
                            logger.debug((Object) ("Response login: " + res.toJson()));
                            return res.toJson();
                        }
                        if (!userModel2.isBanLogin()) {
                            // BCrypt verification (also supports legacy MD5 hashes)
                            if (PasswordService.verifyPassword(plainPassword, userModel2.getPassword())) {
                                // Auto-migrate legacy MD5 → BCrypt on successful login
                                if (PasswordService.isLegacyHash(userModel2.getPassword())) {
                                    try {
                                        String bcryptHash = PasswordService.hashPassword(plainPassword);
                                        SecurityDaoImpl secDao = new SecurityDaoImpl();
                                        secDao.updateUserInfo(userModel2.getId(), bcryptHash, 2);
                                        logger.debug("Migrated password to BCrypt for user: " + username);
                                    } catch (Exception migErr) {
                                        logger.debug("BCrypt migration failed (non-blocking): " + migErr.getMessage());
                                    }
                                }
                                if (userModel2.getNickname() != null && !userModel2.getNickname().trim().isEmpty()) {
                                    if (userModel2.isHasLoginSecurity() && userModel2.getLoginOtp() >= 0L && userModel2.getLoginOtp() <= userModel2.getVinTotal()) {
                                        // send otp
                                        OtpService otpService = new OtpServiceImpl();
                                        int ret = otpService.sendVoiceOtp(userModel2.getNickname(), "", true);
                                        if (ret != 0) {
                                            Debug.trace("Cannot send OTP message!");
                                            res.setErrorCode("116");
                                            return res.toJson();
                                        }
                                        res.setErrorCode("1012");
                                    } else {
                                        res = PortalUtils.loginSuccess(userModel2, request);
                                    }
                                } else {
                                    res.setErrorCode("2001");
                                }
                            } else {
                                res.setErrorCode("1007");
                            }
                        } else {
                            res.setErrorCode("1109");
                        }
                    } else {
                        res.setErrorCode("1007");
                    }
                }
            } catch (Exception e1) {
                logger.info((Object) e1);
            }
            logger.debug((Object) ("Response login: " + res.toJson()));
            return res.toJson();
        }
        return "MISSING PARAMETTER";
    }

}

