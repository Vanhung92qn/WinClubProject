/*
 * Decompiled with CFR 0.144.
 *
 * Could not load the following classes:
 *  com.vinplay.usercore.service.impl.GiftCodeServiceImpl
 *  com.vinplay.vbee.common.cp.BaseProcessor
 *  com.vinplay.vbee.common.cp.Param
 *  com.vinplay.vbee.common.response.GiftCodeSearchResponse
 *  javax.servlet.http.HttpServletRequest
 *  org.apache.log4j.Logger
 */
package com.vinplay.api.backend.processors;

import com.vinplay.usercore.service.impl.GiftCodeServiceImpl;
import com.vinplay.vbee.common.cp.BaseProcessor;
import com.vinplay.vbee.common.cp.Param;
import com.vinplay.vbee.common.dto.FindGiftCodeUsedByUserDto;
import com.vinplay.vbee.common.response.GiftCodeSearchResponse;
import org.apache.log4j.Logger;

import javax.servlet.http.HttpServletRequest;

public class GiftCodeByNickNameProcessor
        implements BaseProcessor<HttpServletRequest, String> {
    private static final Logger logger = Logger.getLogger("backend");

    public String execute(Param<HttpServletRequest> param) {
        GiftCodeSearchResponse response = new GiftCodeSearchResponse(false, "1001");

        FindGiftCodeUsedByUserDto giftCodeResponses = new FindGiftCodeUsedByUserDto(false, "1001");

        HttpServletRequest request = param.get();
        String nickName = request.getParameter("nickName");
        int pageIndex = Integer.parseInt(request.getParameter("pageIndex"));
        int pageSize = Integer.parseInt(request.getParameter("pageSize"));

        if (pageIndex < 0 || pageSize <= 0) {
            return response.toJson();
        }
        if (nickName == null || nickName.equals("")) {
            return "MISSING PARAMETTER";
        }
        try {
            GiftCodeServiceImpl service = new GiftCodeServiceImpl();
            giftCodeResponses = service.findGiftCodeByNickName(nickName, pageIndex, pageSize);

        } catch (Exception e) {
            logger.debug((Object) e);
        }
        return giftCodeResponses.toJson();

    }
}

