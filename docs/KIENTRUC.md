# Kiến Trúc Tổng Thể WinClub — Phân Tích & Lộ Trình Nâng Cấp

## Context

**Dự án:** WinClub — nền tảng game casino trực tuyến đa trò chơi (25+ games)
**Vấn đề:** Hệ thống đang vận hành tốt nhưng tích lũy nhiều Technical Debt từ code decompile (CFR), thiếu observability, thiếu test, bảo mật yếu (MD5), port sprawl 50+ container, và không có CI/CD tự động.
**Mục tiêu:** Phân tích kiến trúc hiện tại → đề xuất Target Architecture → lộ trình di chuyển an toàn không downtime.

---

## PHẦN 1: PHÂN TÍCH HIỆN TRẠNG (Current State Analysis)

### Sơ đồ tư duy — Kiến trúc hiện tại

```
WinClub Hiện Tại
├── Client (Cocos Creator 2.x / TypeScript)
│   ├── 25+ AssetBundle (mỗi game 1 bundle)
│   ├── 83+ file trong Lobby
│   ├── Logic bảo mật nhúng thẳng vào UI component
│   └── Không có tầng Service/Repository riêng
│
├── Server (Java 1.8 / BitZero Engine)
│   ├── API Layer (5 cổng riêng biệt: 8081,8082,8087,18081,8089)
│   │   ├── VinPlayPortal — Command pattern qua c= integer
│   │   ├── VinPlayBackend — Admin API
│   │   ├── BoardService — Leaderboard
│   │   ├── WSPay — Payment
│   │   └── WSReport — WebSocket broadcast
│   ├── Game Servers (21 game × 3 port = 60+ port)
│   │   └── Mỗi game 1 JAR độc lập + config riêng (50+ bộ config)
│   └── Shared Libs (VinPlayDAL, VBeeSecurity, BitzeroAll...)
│
├── CMS (PHP CodeIgniter 3 — EOL framework)
│
├── Infra (Docker Compose)
│   ├── MySQL 5.7 (user, transaction, admin)
│   ├── MongoDB 4.x (game session, history)
│   ├── Redis (session, cache)
│   ├── RabbitMQ (queue_taixiu, queue_payment...)
│   └── Hazelcast 3.9 (distributed map, IMDG)
│
└── Nginx (reverse proxy, TLS via Cloudflare)
```

---

### Nút thắt cổ chai & Technical Debt

| # | Vấn đề | Mức độ | Loại |
|---|--------|--------|------|
| 1 | **Code decompile (CFR)** — mất intent, thiếu import, try-catch-ignore | 🔴 Cao | Technical Debt |
| 2 | **Java 1.8** — không dùng được Virtual Threads, Records, Stream API hiện đại | 🟡 Trung | Tech Debt |
| 3 | **MD5 password hash** — không salt, dễ rainbow-table attack | 🔴 Cao | Security |
| 4 | **Không có unit/integration test** | 🔴 Cao | Quality |
| 5 | **Config duplication** — 50+ bộ `db_pool.properties`, `mongo.properties` riêng biệt | 🟡 Trung | Maintainability |
| 6 | **Port sprawl** — 60+ port game server expose trực tiếp | 🟡 Trung | Operations |
| 7 | **Không có API Gateway** — client phải biết từng port game | 🔴 Cao | Architecture |
| 8 | **CMS CodeIgniter 3** — EOL từ 2022, lỗ hổng bảo mật chưa vá | 🔴 Cao | Security |
| 9 | **Không có centralized logging/metrics** — debug bằng log file rải rác | 🟡 Trung | Observability |
| 10 | **CI/CD thủ công** — shell script run_*.sh, deploy bằng tay | 🟡 Trung | DevOps |
| 11 | **Client coupling** — logic mã hóa nhúng trong UI components | 🟡 Trung | Architecture |
| 12 | **Không có API versioning** — c=3 không có version, breaking change = toàn bộ client phải update | 🟡 Trung | API Design |
| 13 | **RabbitMQ credentials mặc định** — guest/guest trong rmq.properties | 🔴 Cao | Security |
| 14 | **Single point of failure** — game server down = toàn bộ người chơi game đó mất kết nối | 🟡 Trung | Resilience |
| 15 | **Lobby 83+ file không phân tầng** — God module, khó onboard dev mới | 🟡 Trung | Maintainability |

---

## PHẦN 2: TRIẾT LÝ KIẾN TRÚC MỚI (Target Architecture)

### Mô hình đề xuất: **Layered Microservices + Domain-Driven Design (DDD)**

**Tại sao không phải kiến trúc khác?**

- **Full Microservices thuần túy** → quá phức tạp cho team hiện tại, overhead vận hành lớn. Hệ thống đã có micro-service tự nhiên (mỗi game 1 server), chỉ cần tổ chức lại.
- **Monolith** → không phù hợp vì game server cần scale độc lập (TaiXiu tải cao ≠ CoTuong tải thấp).
- **DDD + Layered Microservices** → phù hợp vì:
  - Domain rõ ràng: User, Game, Payment, Report
  - Mỗi domain có bounded context độc lập
  - Giữ nguyên ngôn ngữ/framework hiện có, chỉ tổ chức lại
  - Có thể di chuyển từng bước (strangler fig pattern)

### Nguyên tắc thiết kế (Design Principles)

1. **Single Responsibility** — mỗi module/service làm đúng 1 việc
2. **Dependency Inversion** — các tầng cao không phụ thuộc tầng thấp cụ thể
3. **Strangler Fig Pattern** — di chuyển dần, không rewrite toàn bộ
4. **Config as Code** — tập trung config, không duplicate
5. **Security by Default** — bcrypt, secret manager, TLS nội bộ
6. **Observability First** — log có structure, metrics, health check

---

## PHẦN 3: CẤU TRÚC THƯ MỤC ĐỀ XUẤT

```
WinClubProject/
│
├── 📁 client/                          # Cocos Creator 2.x (TypeScript)
│   └── assets/
│       ├── core/                       # [MỚI] Tầng core dùng chung
│       │   ├── network/
│       │   │   ├── HttpClient.ts       # Wrapper HTTP (timeout, retry, log)
│       │   │   ├── WsClient.ts         # WebSocket manager
│       │   │   └── ApiGateway.ts       # [MỚI] 1 điểm gọi API (không hard-code port)
│       │   ├── auth/
│       │   │   ├── AuthService.ts      # [MỚI] Tách login/logout ra khỏi UI
│       │   │   └── PasswordEncoder.ts  # [REFACTOR từ PortalPassword.ts]
│       │   ├── store/
│       │   │   ├── UserStore.ts        # [MỚI] Global state (user, balance, token)
│       │   │   └── GameStore.ts        # [MỚI] Game state per-session
│       │   └── utils/
│       │       └── EventBus.ts         # [MỚI] Decouple UI ↔ Logic
│       │
│       ├── games/
│       │   ├── Lobby/
│       │   │   └── src/
│       │   │       ├── ui/             # [TÁCH] Chỉ chứa UI components
│       │   │       │   ├── LoginPopup.ts
│       │   │       │   ├── RegisterPopup.ts
│       │   │       │   └── NicknamePopup.ts
│       │   │       ├── controller/     # [TÁCH] Logic điều hướng
│       │   │       │   └── LobbyController.ts
│       │   │       └── service/        # [TÁCH] Gọi API
│       │   │           └── LobbyService.ts
│       │   │
│       │   └── [GameName]/            # Cấu trúc tương tự cho mỗi game
│       │       └── src/
│       │           ├── ui/
│       │           ├── controller/
│       │           └── service/
│       │
│       └── Script/                    # Shared utilities (giữ nguyên, refactor dần)
│
├── 📁 server/                          # Java Backend
│   │
│   ├── 📁 gateway/                     # [MỚI] API Gateway (Nginx hoặc Java)
│   │   └── nginx-gateway/             # Nginx config tập trung routing
│   │       └── routes/                # 1 file per domain
│   │
│   ├── 📁 shared/                      # Shared Libraries (tổ chức lại)
│   │   ├── VinPlayDAL/               # Data access layer (giữ nguyên)
│   │   ├── VinPlayUserCore/          # User core (giữ nguyên)
│   │   ├── VBeeSecurity/             # Auth + encryption (giữ nguyên)
│   │   ├── VbeeCommon/               # Common utils (giữ nguyên)
│   │   ├── CardCoreLib/              # Card mechanics (giữ nguyên)
│   │   └── config-shared/            # [MỚI] Config tập trung
│   │       ├── db.properties         # 1 file duy nhất cho MySQL
│   │       ├── mongo.properties      # 1 file cho MongoDB
│   │       ├── redis.properties      # 1 file cho Redis
│   │       └── rmq.properties        # 1 file cho RabbitMQ
│   │
│   ├── 📁 domain/                      # [MỚI] Tổ chức theo Domain
│   │   │
│   │   ├── user-domain/               # Domain: Người dùng
│   │   │   ├── api/VinPlayPortal/    # Login, Register, Profile, OTP
│   │   │   └── api/VinPlayBackend/   # Admin, Agent management
│   │   │
│   │   ├── payment-domain/            # Domain: Thanh toán
│   │   │   ├── wspay/                # Payment processor (giữ nguyên)
│   │   │   └── wsreport/             # Reporting (giữ nguyên)
│   │   │
│   │   ├── game-domain/               # Domain: Game
│   │   │   ├── framework/
│   │   │   │   ├── BitzeroAll/       # BitZero engine (giữ nguyên)
│   │   │   │   └── BitZeroMinigame/  # Mini game framework (giữ nguyên)
│   │   │   │
│   │   │   ├── dice-games/           # [NHÓM] Các game xúc xắc
│   │   │   │   ├── taixiuMini/
│   │   │   │   ├── taixiuMd5/
│   │   │   │   ├── taixiuKubet/
│   │   │   │   ├── xocdia/
│   │   │   │   └── xocdiaKubet/
│   │   │   │
│   │   │   ├── card-games/           # [NHÓM] Các game bài
│   │   │   │   ├── bacay/
│   │   │   │   ├── baicao/
│   │   │   │   ├── binh/
│   │   │   │   ├── poker/
│   │   │   │   ├── sam/
│   │   │   │   ├── lieng/
│   │   │   │   └── tlmn/
│   │   │   │
│   │   │   └── slot-games/           # [NHÓM] Slot machines
│   │   │       └── slot/
│   │   │
│   │   └── analytics-domain/          # Domain: Phân tích, báo cáo
│   │       └── BoardService/         # Leaderboard, stats (giữ nguyên)
│   │
│   ├── build.gradle                   # Root Gradle
│   └── settings.gradle               # Module declarations
│
├── 📁 cms/                            # PHP Admin Panel
│   └── application/                  # CodeIgniter 3 (giữ nguyên, plan migrate)
│
├── 📁 infra/                          # [ĐỔI TÊN từ docker/]
│   ├── docker/
│   │   ├── compose/
│   │   │   ├── core.yml              # MySQL, Mongo, Redis, RMQ, Hazelcast
│   │   │   ├── api.yml               # Portal, Backend, Board, WSPay, WSReport
│   │   │   ├── games-dice.yml        # TaiXiu, XocDia variants
│   │   │   ├── games-card.yml        # Bài: Poker, Sam, BaiCao...
│   │   │   └── games-slot.yml        # Slot games
│   │   └── Dockerfile.*              # Mỗi service type 1 Dockerfile
│   │
│   ├── config/                       # Centralized config (symlink vào shared/)
│   │   ├── mysql/
│   │   ├── mongod/
│   │   ├── redis/
│   │   ├── hazelcast/
│   │   └── rabbitmq/
│   │
│   └── nginx/                        # [DI CHUYỂN từ nginx/]
│       ├── nginx.conf
│       ├── sites-available/
│       └── snippets/
│
├── 📁 monitoring/                     # [MỚI] Observability stack
│   ├── docker-compose.yml            # Prometheus + Grafana + Loki
│   ├── prometheus/
│   │   └── prometheus.yml            # Scrape configs
│   ├── grafana/
│   │   └── dashboards/               # Pre-built dashboards
│   └── loki/
│       └── loki-config.yml           # Log aggregation
│
├── 📁 docs/                          # Documentation (giữ nguyên, mở rộng)
│   ├── ARCHITECTURE.md
│   ├── API.md                        # [MỚI] API reference (thay c= integer)
│   ├── RUNBOOK.md                    # [MỚI] Ops runbook
│   ├── SECURITY.md                   # [MỚI] Security policies
│   └── ADR/                          # [MỚI] Architecture Decision Records
│       └── 001-password-hashing.md
│
└── 📁 scripts/                       # [DI CHUYỂN] Shell scripts
    ├── start-game.sh
    ├── health-check.sh
    └── deploy.sh
```

---

## PHẦN 4: LUỒNG DỮ LIỆU & QUẢN LÝ DEPENDENCY

### Sơ đồ giao tiếp (Data Flow)

```
┌─────────────────────────────────────────────────────────────────┐
│                        CLIENT (Cocos Creator)                    │
│                                                                   │
│  UI Layer          Service Layer       Core Layer                │
│  [LoginPopup]  →  [AuthService]   →  [ApiGateway]               │
│  [GameScene]   →  [GameService]   →  [WsClient]                 │
│                                         │                        │
└─────────────────────────────────────────┼────────────────────────┘
                                          │ HTTPS / WSS
                                          ▼
┌─────────────────────────────────────────────────────────────────┐
│                      NGINX API GATEWAY                           │
│                                                                   │
│  /api/v1/user/*    →  VinPlayPortal  (8081)                     │
│  /api/v1/admin/*   →  VinPlayBackend (8082)                     │
│  /api/v1/board/*   →  BoardService   (8087)                     │
│  /api/v1/pay/*     →  WSPay          (18081)                    │
│  /ws/report        →  WSReport       (7777)                     │
│  /ws/game/{id}     →  GameServer     (internal)                 │
└─────────────────────────────────────────────────────────────────┘
                    │                           │
          ┌─────────▼───────────┐   ┌──────────▼──────────┐
          │   API Services      │   │   Game Servers       │
          │                     │   │                      │
          │  VinPlayPortal      │   │  TaiXiu (2043-45)    │
          │  ├─ UserProcessor   │   │  XocDia (2343-45)    │
          │  ├─ PayProcessor    │   │  Poker  (1743-45)    │
          │  └─ OtpProcessor    │   │  ...                 │
          │                     │   │                      │
          └────────┬────────────┘   └──────────┬──────────┘
                   │                            │
        ┌──────────▼────────────────────────────▼──────────┐
        │              Shared Infrastructure                  │
        │                                                      │
        │  ┌──────────┐  ┌────────────┐  ┌──────────────┐  │
        │  │  MySQL   │  │  MongoDB   │  │    Redis     │  │
        │  │ (users,  │  │ (sessions, │  │  (sessions,  │  │
        │  │  txns)   │  │  history)  │  │   cache)     │  │
        │  └──────────┘  └────────────┘  └──────────────┘  │
        │                                                      │
        │  ┌──────────────┐  ┌─────────────────────────┐    │
        │  │  RabbitMQ    │  │    Hazelcast IMDG       │    │
        │  │ (async jobs: │  │  (distributed map,      │    │
        │  │  game/pay)   │  │   session state)        │    │
        │  └──────────────┘  └─────────────────────────┘    │
        └───────────────────────────────────────────────────┘
```

### Dependency Rules (Loose Coupling)

```
Quy tắc: dependency chỉ đi theo 1 chiều

[UI Component]  →  [Service]  →  [Core/Network]  →  [API]
     ↑                ↑               ↑
     │ (events)       │ (interface)   │ (abstract)
     │                │               │
     └── KHÔNG phụ thuộc ngược lại ──┘

Trên Server:
[API Processor]  →  [Service Layer]  →  [DAO/Repository]  →  [DB]
                          ↓
                    [RabbitMQ Publisher]  →  [Consumer]  →  [DB]

Shared libs chỉ đi 1 chiều:
VinPlayDAL (DAO) ← VinPlayUserCore ← VinPlayPortal
                                    ← VinPlayBackend
                                    ← GameServers
```

---

## PHẦN 5: LỘ TRÌNH CHUYỂN ĐỔI (Strangler Fig Pattern)

### Phase 0 — Chuẩn bị
- [x] **Thiết lập monitoring stack** (Prometheus + Grafana + Loki) ✅ `monitoring/`
- [ ] Centralize config vào `infra/config/` + symlink cho các service
- [x] Đổi RabbitMQ credentials ra khỏi guest/guest ✅ (rmq_password=MgqzAtRy... trong rmq.properties)
- [ ] Thêm health check endpoints cho mỗi service
- **Files:** `monitoring/docker-compose.yml`, `monitoring/prometheus/`, `monitoring/loki/`, `monitoring/promtail/`

> **Deploy monitoring:** `cd monitoring && docker compose up -d`
> Grafana: http://server:3000 (admin / $GRAFANA_PASSWORD)
> **Cần thêm vào `/etc/nginx/nginx.conf`:** `include /etc/nginx/snippets/rate-limit.conf;`

### Phase 1 — Security Quick Wins
- [x] **Migrate password hashing MD5 → BCrypt** ✅
  - `LoginProcessor.java` — BCrypt + auto-migration ✅
  - `LoginPostProcessor.java` — fixed (was MD5 raw) ✅
  - `LoginAdminProcessor.java` — fixed (was raw equals) ✅
  - `PasswordService.java` — centralized BCrypt + legacy MD5 fallback ✅
- [ ] Rotate tất cả credentials về biến môi trường (`.env`)
- [x] **Thêm rate limiting Nginx** ✅ `nginx/snippets/rate-limit.conf` + `winclub-game-routes.inc`
  - 30 req/s cho `/api` và `/api/v1` (burst 50)
  - Cần chạy: `sudo cp nginx/snippets/rate-limit.conf /etc/nginx/snippets/ && sudo nginx -s reload`
- [ ] Update CMS từ CodeIgniter 3 → CodeIgniter 4 (drop-in compatible)

### Phase 2 — Client Lazy Loading Architecture (ƯU TIÊN CAO NHẤT)

> **Tham khảo từ ClientGameVerSeverC#**: BundleControl.js + LoadingView.js + LobbyView.js
> **Vấn đề chí mạng**: `loadDir('')` tại LoadingController.ts:359 tải toàn bộ ~40MB Lobby vào RAM

#### 2A. Phân tích vấn đề hiện tại

**Loading flow TRƯỚC (chậm, nặng):**
```
LoadingController.loadBundleLobby()
  → BundleControl.loadBundle('Lobby')           // OK: tải metadata
  → bundle.loadDir('')                           // 🔴 TẢI HẾT ~40MB: texture, spine, audio, 25 prefab
  → cc.director.loadScene("Lobby")
  → LobbyController.onEnable()
    → 25 @property(cc.Prefab) đã nằm sẵn trong RAM  // 🔴 Toàn bộ popup dù user chưa mở
```

**Loading flow SAU (nhẹ, nhanh):**
```
LoadingController.loadBundleLobby()
  → BundleControl.loadBundle('Lobby')           // Giữ nguyên
  → bundle.loadScene('Lobby', progress, done)   // ✅ CHỈ tải scene + direct deps (~5-7MB)
  → cc.director.runScene(sceneAsset)
  → LobbyController.onLoad()
    → 3 Tier-1 @property: popupLogin, popupRegister, loadingSun  // ✅ Chỉ popup thiết yếu
    → PopupManager đăng ký 22 popup config (zero memory)          // ✅ Lazy on-demand
    → User tap "Shop" → PopupManager.openPopup('PopupShop')       // ✅ Tải khi cần (~1-3MB)
```

**Kết quả:** Startup từ ~40MB → ~5-7MB RAM. Giảm 80% bộ nhớ khởi tạo.

#### 2B. Phân loại 25 Popup theo Tier

**Tier 1 — CRITICAL (giữ @property, preload cùng scene)**
| Popup | Lý do |
|-------|-------|
| `popupLogin` (line 148) | Hiện ngay khi chưa login |
| `popupRegister` (line 176) | Mở từ login screen |
| `loadingSun` (line 169) | Loading indicator, cần tức thì |

**Tier 2 — STANDARD (lazy load, cache prefab sau lần đầu)**
| Popup | Lý do |
|-------|-------|
| `popupShop` (line 182) | Hay dùng nhưng không cần ngay |
| `popupProfile` (line 180) | Mở khi tap avatar |
| `prefabPopupCashOut` (line 186) | Popup rút tiền — 494KB lớn nhất! |
| `popupTransaction` (line 135) | Lịch sử giao dịch |
| `popupSecurity` (line 194) | Bảo mật tài khoản |
| `prefabMailBox` (line 184) | Hộp thư |
| `prefabPopupForgetPassword` (line 196) | Quên mật khẩu |
| `prefabPopupSetting` (line 203) | Cài đặt |
| `prefabPopupUpdateNickName` (line 221) | Đặt nickname |
| `prefabPopupBigBanner` (line 219) | Banner sự kiện |

**Tier 3 — RARE (lazy load, KHÔNG cache — giải phóng sau khi đóng)**
| Popup | Lý do |
|-------|-------|
| `prefabPopupCashOutTransaction` (line 188) | Chi tiết giao dịch rút |
| `prefabPopupCashOutGuide` (line 190) | Hướng dẫn rút |
| `prefabPopupChargeTransaction` (line 209) | Chi tiết nạp |
| `prefabPopupChargeGuide` (line 211) | Hướng dẫn nạp |
| `prefabPopupEvent` (line 192) | Sự kiện — 91KB |
| `prefabPopupGiftCode` (line 205) | Gift code |
| `prefabPopupUpdateCashoutBank` (line 207) | Cập nhật ngân hàng |
| `popupActiveTelegram` (line 213) | Liên kết Telegram |
| `prefabPopupSafe` (line 215) | Két sắt |
| `prefabPopupTelegramGuide` (line 217) | Hướng dẫn Telegram |

#### 2C. File mới: PopupManager.ts

**Path:** `client/assets/scripts/common/PopupManager.ts`

```typescript
// Singleton quản lý lazy-loading popup
enum PopupTier { CRITICAL = 1, STANDARD = 2, RARE = 3 }

interface PopupConfig {
    prefabPath: string;    // VD: "res/prefabs/PopupShop"
    tier: PopupTier;
    isGlobal: boolean;     // true = add to PopupParent, false = nodeLobby
}

class PopupManager {
    private static _inst: PopupManager;
    private _registry: Map<string, PopupConfig>;    // popup configs
    private _prefabCache: Map<string, cc.Prefab>;   // Tier 2 cache
    private _loading: Set<string>;                   // chống double-load

    register(name: string, config: PopupConfig): void;
    async openPopup(name: string, parentNode?: cc.Node): Promise<cc.Node>;
    releaseCached(name?: string): void;              // giải phóng cache khi áp lực RAM
}
```

**API giữ backward-compatible:** `actOpenPopup(prefab)` vẫn hoạt động cho Tier 1.

#### 2D. Thay đổi BundleControl.ts (thêm methods)

**Path:** `client/assets/scripts/common/BundleControl.ts`

```typescript
// MỚI: Load 1 prefab từ Lobby bundle (trả về prefab, KHÔNG instantiate)
static async loadLobbyPrefab(prefabPath: string): Promise<cc.Prefab>;

// MỚI: Giải phóng asset cụ thể từ Lobby bundle
static releaseLobbyAsset(prefabPath: string): void;

// MỚI: Giải phóng toàn bộ game bundle khi quay về Lobby
static releaseGameBundle(bundleName: string): void;
```

Khác với `loadPrefabLobby()` hiện có (line 6): method hiện tại instantiate node ngay. Method mới trả về raw prefab để PopupManager quyết định cache hay không.

#### 2E. Thay đổi LoadingController.ts (critical fix)

**Path:** `client/assets/Loading/src/LoadingController.ts`

**Dòng 352-373 — Thay `bundle.loadDir('')` → `bundle.loadScene('Lobby')`:**

```typescript
// TRƯỚC (chậm):
bundle.loadDir('', function(finish, total) { ... }, function(err, assets) { ... });

// SAU (nhanh):
bundle.loadScene('Lobby', function(finish, total) {
    // progress callback giữ nguyên
}, function(err, sceneAsset) {
    if(!err) resolve(sceneAsset);
    else resolve(null);
});
```

**Dòng 382-388 — Cập nhật `hotUpdateLobby()`:**
```typescript
// SAU: nhận sceneAsset thay vì asset array
hotUpdateLobby() {
    this.loadBundleLobby().then((sceneAsset) => {
        if(sceneAsset) cc.director.runScene(sceneAsset);
    });
}
```

#### 2F. Thay đổi LobbyController.ts (incremental migration)

1. **Xóa @property** cho 22 popup Tier 2+3 (giữ 3 Tier 1)
2. **Thêm register** trong `onLoad()`:
   ```typescript
   PopupManager.instance.register('PopupShop', {
       prefabPath: 'res/prefabs/PopupShop', tier: PopupTier.STANDARD, isGlobal: true
   });
   // ... 21 popup khác
   ```
3. **Cập nhật ~20 call sites**: `this.actOpenPopup(this.popupShop)` → `PopupManager.instance.openPopup('PopupShop')`

#### 2G. Bundle Memory Management (App.ts)

Thêm giải phóng game bundle khi quay Lobby:
```typescript
// Trong loadSceneFromBundle (line 342):
if(sceneName === 'Lobby' && this._currentGameBundle) {
    BundleControl.releaseGameBundle(this._currentGameBundle);
}
this._currentGameBundle = (sceneName !== 'Lobby') ? option.src : null;
```

#### 2H. Lộ trình migration Strangler Fig (từng popup một)

**Bước 1:** Tạo `PopupManager.ts` + thêm methods vào `BundleControl.ts`
**Bước 2:** Fix `loadDir('')` → `loadScene('Lobby')` trong LoadingController (impact lớn nhất)
**Bước 3:** Migrate Tier 3 (rare) — ít dùng nhất, rủi ro thấp nhất:
  1. `prefabPopupTelegramGuide` → 2. `prefabPopupSafe` → 3. `popupActiveTelegram`
  → 4. `prefabPopupChargeGuide` → 5. `prefabPopupChargeTransaction`
  → 6. `prefabPopupCashOutGuide` → 7. `prefabPopupCashOutTransaction`
  → 8. `prefabPopupUpdateCashoutBank` → 9. `prefabPopupEvent` → 10. `prefabPopupGiftCode`
**Bước 4:** Migrate Tier 2 (standard) — thường dùng hơn:
  1. `popupTransaction` → 2. `prefabPopupForgetPassword` → 3. `prefabPopupSetting`
  → 4. `prefabPopupBigBanner` → 5. `prefabMailBox` → 6. `popupSecurity`
  → 7. `prefabPopupUpdateNickName` → 8. `prefabPopupCashOut` → 9. `popupProfile`
  → 10. `popupShop` (cuối cùng vì phức tạp + hay dùng nhất)
**Bước 5:** Thêm bundle release cho game bundles (App.ts)

#### 2I. Verification

- [ ] Lobby load < 3s trên mạng 3G (trước: 8-15s)
- [ ] RAM startup < 10MB cho Lobby scene (trước: ~40MB)
- [ ] Mỗi popup mở đúng animation, đóng destroy, không lỗi console
- [ ] Tier 2 popup mở lần 2 = instant (cached)
- [ ] Tier 3 popup giải phóng prefab sau khi đóng
- [ ] Game bundle released khi quay Lobby: `cc.assetManager.getBundle('BaCay')` = null
- [ ] `cc.assetManager.assets.count` không tăng vô hạn qua nhiều session

### Phase 2B — Client Layer Separation (sau lazy loading)
- [ ] Tạo tầng `core/` trong client (ApiGateway, AuthService, UserStore)
- [ ] Tách UI khỏi logic trong Lobby (LoginPopup, RegisterPopup, NicknamePopup)
- [ ] Thêm unit test cho `PasswordEncoder.ts`, `AuthService.ts`
- **Files:** `client/assets/core/`, `client/assets/games/Lobby/src/{ui,controller,service}/`

### Phase 3 — Server Organization (4-8 tuần)
- [ ] Nhóm game servers theo domain trong `settings.gradle`
- [ ] Tập trung config: 1 bộ `properties` dùng chung (symlink)
- [ ] Nâng Java 1.8 → Java 17 LTS (backward compatible, chạy song song)
- [ ] Thêm test framework (JUnit 5) + ít nhất test cho LoginProcessor
- **Files:** `server/settings.gradle`, `server/domain/`, `server/shared/config-shared/`

### Phase 4 — API Gateway (2-4 tuần)
- [ ] Tập trung routing vào Nginx gateway (thay vì client phải biết port)
- [ ] Thêm `/api/v1/` prefix để chuẩn bị versioning
- [ ] Document API endpoints ra `docs/API.md` (thay c= integer)
- **Files:** `infra/nginx/`, `docs/API.md`

### Phase 5 — Observability & CI/CD (4-6 tuần)
- [ ] Centralized log aggregation (Loki / ELK)
- [ ] Alerting trên Grafana (game server down, payment failure, login spike)
- [ ] GitHub Actions CI pipeline: build → test → Docker image
- [ ] Canary deploy: deploy game mới song song với game cũ, switch traffic dần
- **Files:** `monitoring/`, `.github/workflows/`

---

## Tóm tắt ưu tiên

| Priority | Action | Impact | Effort |
|----------|--------|--------|--------|
| 🔴 **P0** | **Fix loadDir('') → loadScene()** | Giảm 80% RAM startup | Thấp |
| 🔴 **P0** | **Tạo PopupManager + lazy loading** | Giảm 33MB RAM liên tục | Trung |
| 🔴 P0 | Rotate credentials (RMQ, DB, Redis) | Security critical | Thấp |
| 🔴 P1 | BCrypt migration (password) | Security | Trung |
| 🟡 P1 | Migrate 10 Tier-3 popup → lazy | RAM + UX | Trung |
| 🟡 P1 | Migrate 10 Tier-2 popup → lazy + cache | RAM + UX | Trung |
| 🟡 P2 | Bundle release on game exit | Memory leak fix | Thấp |
| 🟡 P2 | Client layer separation | Maintainability | Trung |
| 🟢 P3 | Server organization + config centralize | Ops | Cao |
| 🟢 P3 | CI/CD pipeline + monitoring | DevOps | Cao |

---

## Files cần thay đổi (Critical Path)

### Client Lazy Loading (P0 — ƯU TIÊN CAO NHẤT)
- `client/assets/Loading/src/LoadingController.ts` — **Thay loadDir('') → loadScene()** (line 352-373)
- `client/assets/scripts/common/PopupManager.ts` — **Tạo mới**: singleton lazy popup loader
- `client/assets/scripts/common/BundleControl.ts` — **Thêm**: loadLobbyPrefab(), releaseGameBundle()
- `client/assets/games/Lobby/src/Lobby.LobbyController.ts` — **Xóa 22 @property, thêm PopupManager calls**
- `client/assets/scripts/common/App.ts` — **Thêm**: _currentGameBundle tracking + release

### Tham khảo từ ClientGameVerSeverC#
- `ClientGameVerSeverC#/assets/Loading/script/loading/BundleControl.js` — Pattern loadPrefabPopup()
- `ClientGameVerSeverC#/assets/Loading/script/loading/LoadingView.js` — Pattern loadLobby() nhẹ
- `ClientGameVerSeverC#/assets/Lobby/scripts/portal/lobby/LobbyView.js` — Pattern lazy game load

### Security (P1)
- `server/api/VinPlayPortal/config/rmq.properties`
- `docker/.env` / `.env.example`
- `server/shared/VBeeSecurity/` (thêm BCrypt)

### Server Organization (P3)
- `server/settings.gradle` (nhóm game domains)
- `infra/docker/compose/*.yml` (tách compose files)
- `monitoring/docker-compose.yml` (tạo mới)
