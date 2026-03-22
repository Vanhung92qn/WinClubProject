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
import com.vinplay.api.utils.PortalUtils;
import com.vinplay.api.utils.WebPasswordNormalizer;
import com.vinplay.marketing.entity.MarketingUser;
import com.vinplay.marketing.service.MarketingService;
import com.vinplay.usercore.service.CacheService;
import com.vinplay.usercore.service.OtpService;
import com.vinplay.usercore.service.impl.CacheServiceImpl;
import com.vinplay.usercore.service.impl.OtpServiceImpl;
import com.vinplay.usercore.service.impl.UserServiceImpl;
import com.vinplay.usercore.utils.GameCommon;
import com.vinplay.vbee.common.cp.BaseProcessor;
import com.vinplay.vbee.common.cp.Param;
import com.vinplay.vbee.common.enums.StatusGames;
import com.vinplay.vbee.common.messages.marketing.UserAccessLogMessage;
import com.vinplay.vbee.common.models.UserModel;
import com.vinplay.vbee.common.response.LoginResponse;
import com.vinplay.vbee.common.rmq.RMQApi;
import org.apache.log4j.Logger;

import javax.servlet.http.HttpServletRequest;

public class LoginProcessor
        implements BaseProcessor<HttpServletRequest, String> {
    private static final Logger logger = Logger.getLogger((String) "api");

    public String execute(Param<HttpServletRequest> param) {
        HttpServletRequest request = (HttpServletRequest) param.get();
        String username = request.getParameter("un");
        String password = request.getParameter("pw");
        String platform = request.getParameter("pf");
        try {
            password = WebPasswordNormalizer.toStoredPasswordHash(password);
        } catch (Exception e) {
            logger.debug((Object) ("login password normalize: " + e.getMessage()));
        }
        String social = request.getParameter("s");
        String accessToken = request.getParameter("at");
        String cp = request.getParameter("cp");
        request.getHeader("user-agent");
        logger.debug((Object) ("Request login: username: " + username + ", password: " + password + ", social: " + social + ", accessToken: " + accessToken));
        if (username != null && password != null || social != null && (social.equals("fb") || social.equals("gg")) && accessToken != null) {
            LoginResponse res = new LoginResponse(false, "1009");
            if (username == null || username.length() > 20 || username.length() < 6) {
                return res.toJson();
            }
            try {
                int statusGame = GameCommon.getValueInt((String) "STATUS_GAME");
                if (statusGame == StatusGames.MAINTAIN.getId()) {
                    res.setErrorCode("1114");
                    logger.debug((Object) ("Response login: " + res.toJson()));
                    return res.toJson();
                }
                CacheService cacheService = new CacheServiceImpl();
                cacheService.setValue("login_noti", "true");
                UserServiceImpl userService = new UserServiceImpl();

                UserModel userModel2 = userService.getUserByUserName(username);
                if (userModel2 != null) {
                    if (userModel2.isBot()) {
                        res.setErrorCode("1114");
                        return res.toJson();
                    }

                    if (!userModel2.isBanLogin()) {
                        if (userModel2.getPassword().equals(password)) {
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
                                    // marketing
                                    marketing(res, userModel2.getUsername());
                                }
                            } else {
                                res.setErrorCode("2001");
                            }
                        } else {
                            res.setErrorCode("1007");
                        }
                    } else {
                        res.setErrorCode("Tài khoản đã bị khóa.");
                    }
                } else {
                    res.setErrorCode("1007");
                }
//                }
            } catch (Exception e1) {
                logger.info((Object) e1);
            }
            logger.debug((Object) ("Response login: " + res.toJson()));
            return res.toJson();
        }
        return "MISSING PARAMETTER";
    }

    private static void marketing(LoginResponse res, String nickname) {
        if (res.isSuccess()) {
            try {
                MarketingService marketingService = new MarketingService();
                MarketingUser marketingUser = marketingService.getUsersByName(nickname);
                if (marketingUser != null) {
                    UserAccessLogMessage userAccessLogMessage = new UserAccessLogMessage();
                    userAccessLogMessage.setUserId(marketingUser.getId());
                    userAccessLogMessage.setAccessTime(System.currentTimeMillis());
                    userAccessLogMessage.setUtmId(marketingUser.getUtmId());
                    RMQApi.publishMessage("queue_marketing", userAccessLogMessage, 100);
                }
            } catch (Exception ignored) {
            }
        }
    }
}

