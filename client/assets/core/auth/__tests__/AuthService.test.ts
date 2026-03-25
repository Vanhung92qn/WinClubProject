/**
 * AuthService unit tests — kiểm tra phân nhánh login logic.
 *
 * Mọi external dependency (Http, App, NetworkClients) đều được mock
 * để test chỉ tập trung vào logic phân nhánh trong AuthService.
 */

// ── Mocks (phải khai báo trước import AuthService) ──

const mockHttpGet = jest.fn();
jest.mock("../../../scripts/common/Configs", () => ({
    default: {
        App: { API: "https://test.local/api/v1" },
        Login: {
            IsLogin: false,
            UserId: 0, Username: "", Password: "", Nickname: "", Avatar: "",
            Coin: 0, AccessToken: "", SessionKey: "", LuckyWheel: 0,
            IpAddress: "", CreateTime: "", Birthday: "",
            VipPoint: 0, VipPointSave: 0,
            MobileSecured: false, AppSecured: false, BanTransfer: false,
            CoinFish: 0, UserIdFish: 0, UsernameFish: "", PasswordFish: "",
            FishConfigs: null, BitcoinToken: "",
            clear: jest.fn(),
        },
    },
}));
jest.mock("../../../core/network/Http", () => ({ default: { get: mockHttpGet } }));
jest.mock("../../../scripts/common/SPUtils", () => ({
    default: {
        getUserName: () => "testuser",
        getUserPass: () => "testpass",
        setUserName: jest.fn(),
        setUserPass: jest.fn(),
        setNickName: jest.fn(),
        clearCredentials: jest.fn(),
    },
}));
jest.mock("../../../scripts/common/App", () => ({
    default: {
        instance: {
            showLoading2: jest.fn(),
            buttonMiniGame: { show: jest.fn(), hidden: jest.fn() },
        },
    },
}));
jest.mock("../../../scripts/common/BroadcastReceiver", () => ({
    default: { send: jest.fn(), USER_INFO_UPDATED: "USER_INFO_UPDATED", USER_LOGOUT: "USER_LOGOUT" },
}));
jest.mock("../../../scripts/common/Utils", () => ({ default: { getPlatform: () => "web" } }));
jest.mock("../../../scripts/networks/MiniGameNetworkClient", () => ({
    default: { getInstance: () => ({ sendCheck: jest.fn(), close: jest.fn() }) },
}));
jest.mock("../../../scripts/networks/SlotNetworkClient", () => ({
    default: { getInstance: () => ({ sendCheck: jest.fn(), close: jest.fn() }) },
}));
jest.mock("../../../scripts/networks/TaiXiuNetWorkClient", () => ({
    default: { getInstance: () => ({ checkConnect: jest.fn(), close: jest.fn() }) },
}));
jest.mock("../../../scripts/networks/TaiXiuMD5NetWorkClient", () => ({
    default: { getInstance: () => ({ close: jest.fn() }) },
}));
jest.mock("../../../scripts/networks/TienLenNetworkClient", () => ({
    default: { getInstance: () => ({ close: jest.fn() }) },
}));
jest.mock("../../../scripts/networks/BauCuaTo2NetworkClient", () => ({
    default: { getInstance: () => ({ close: jest.fn() }) },
}));
jest.mock("../../../scripts/networks/ShootFishNetworkClient", () => ({
    default: { getInstance: () => ({ close: jest.fn() }) },
}));
jest.mock("../../../scripts/common/Lobby.Cmd", () => ({
    default: {
        ReqSubcribeJackpots: jest.fn(),
        ReqGetSecurityInfo: jest.fn(),
        ReqSubcribeHallSlot: jest.fn(),
    },
}));
jest.mock("../../store/UserStore", () => ({
    default: { _notifyChange: jest.fn() },
}));

// ── Import sau khi mock ──
import AuthService from "../AuthService";

// ── Base64 mock response payload ──
const makeSessionKey = (data: object) =>
    Buffer.from(JSON.stringify(data)).toString("base64");

const validSession = makeSessionKey({
    id: 42, nickname: "Player1", avatar: "av1", vinTotal: 1000,
    luckyRotate: 3, ipAddress: "1.2.3.4", createTime: "2024-01-01",
    birthday: "1990-01-01", vippoint: 80, vippointSave: 0,
    mobileSecure: 0, appSecure: 0, banTransfer: false,
});

// ── Tests ──

describe("AuthService.login()", () => {

    beforeEach(() => {
        jest.clearAllMocks();
    });

    it("trả về lỗi khi username rỗng", (done) => {
        AuthService.login("", "password", (result) => {
            expect(result.success).toBe(false);
            expect(result.errorCode).toBe(-1);
            expect(result.message).toContain("trống");
            done();
        });
    });

    it("trả về lỗi khi password rỗng", (done) => {
        AuthService.login("user1", "", (result) => {
            expect(result.success).toBe(false);
            expect(result.errorCode).toBe(-1);
            done();
        });
    });

    it("gọi Http.get với tham số đúng (c=3, un, pw, pf)", (done) => {
        mockHttpGet.mockImplementationOnce((_url: any, params: any, cb: any) => {
            expect(params.c).toBe(3);
            expect(params.un).toBe("testuser");
            expect(typeof params.pw).toBe("string");
            expect(params.pw.length).toBeGreaterThan(0);
            cb(null, { errorCode: 0, accessToken: "tok", sessionKey: validSession });
            done();
        });
        AuthService.login("testuser", "testpass", () => {});
    });

    it("trả về success=true khi errorCode=0", (done) => {
        mockHttpGet.mockImplementationOnce((_url: any, _p: any, cb: any) => {
            cb(null, { errorCode: 0, accessToken: "tok", sessionKey: validSession });
        });
        AuthService.login("testuser", "testpass", (result) => {
            expect(result.success).toBe(true);
            expect(result.errorCode).toBe(0);
            done();
        });
    });

    it("trả về needNickname=true khi errorCode=2001", (done) => {
        mockHttpGet.mockImplementationOnce((_url: any, _p: any, cb: any) => {
            cb(null, { errorCode: 2001 });
        });
        AuthService.login("testuser", "testpass", (result) => {
            expect(result.success).toBe(false);
            expect(result.needNickname).toBe(true);
            done();
        });
    });

    it("trả về lỗi kết nối khi Http trả về err", (done) => {
        mockHttpGet.mockImplementationOnce((_url: any, _p: any, cb: any) => {
            cb(new Error("Network error"), null);
        });
        AuthService.login("testuser", "testpass", (result) => {
            expect(result.success).toBe(false);
            expect(result.errorCode).toBe(-2);
            done();
        });
    });

    it("trả về message lỗi cho errorCode=1007 (sai thông tin)", (done) => {
        mockHttpGet.mockImplementationOnce((_url: any, _p: any, cb: any) => {
            cb(null, { errorCode: 1007 });
        });
        AuthService.login("testuser", "testpass", (result) => {
            expect(result.success).toBe(false);
            expect(result.message).toBeTruthy();
            done();
        });
    });

    it("trả về message lỗi cho errorCode=1109 (tài khoản bị khóa)", (done) => {
        mockHttpGet.mockImplementationOnce((_url: any, _p: any, cb: any) => {
            cb(null, { errorCode: 1109 });
        });
        AuthService.login("testuser", "testpass", (result) => {
            expect(result.success).toBe(false);
            expect(result.message).toContain("khóa");
            done();
        });
    });
});

describe("AuthService.logout()", () => {
    it("gọi Configs.Login.clear() và clearCredentials()", () => {
        const Configs = require("../../../scripts/common/Configs").default;
        const SPUtils = require("../../../scripts/common/SPUtils").default;

        AuthService.logout();

        expect(Configs.Login.clear).toHaveBeenCalled();
        expect(SPUtils.clearCredentials).toHaveBeenCalled();
    });
});
