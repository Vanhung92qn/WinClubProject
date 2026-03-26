# Shared proxy routes (API, WebSocket game paths, relay, CMS WS).
# Install: sudo cp nginx/snippets/winclub-game-routes.inc /etc/nginx/snippets/
# Tune paths: /livestream/, h5live Origin/Referer if your product differs.
# Source lineage: sites-available/vic68.win (trimmed; no server/ssl wrapper).

    # ── Rate limiting zones (must be in http{} block, NOT here) ──────────────
    # Add the following lines to /etc/nginx/nginx.conf inside the http{} block:
    #
    #   limit_req_zone $binary_remote_addr zone=api_limit:10m rate=30r/s;
    #   limit_req_zone $binary_remote_addr zone=login_limit:10m rate=5r/m;
    #
    # Then the location blocks below use limit_req to enforce limits.

    # ── API v1 Gateway (versioned, new clients) ──────────────────────────────
    # Client: https://${DOMAIN}/api/v1  → VinPlayPortal (port 8081)
    location /api/v1 {
        limit_req zone=api_limit burst=50 nodelay;
        limit_req_status 429;
        proxy_pass http://127.0.0.1:8081/api;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_hide_header Access-Control-Allow-Origin;
        add_header Access-Control-Allow-Origin "*" always;
        add_header Access-Control-Allow-Methods "GET, POST, OPTIONS" always;
        add_header Access-Control-Allow-Headers "Content-Type, Authorization, AccessToken" always;
        add_header Access-Control-Allow-Credentials "true" always;
        if ($request_method = OPTIONS) { return 204; }
    }

    # Admin API (VinPlayBackend, port 8082)
    location /api/v1/admin {
        proxy_pass http://127.0.0.1:8082/api_backend;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_hide_header Access-Control-Allow-Origin;
        add_header Access-Control-Allow-Origin "*" always;
        add_header Access-Control-Allow-Methods "GET, POST, OPTIONS" always;
        add_header Access-Control-Allow-Headers "Content-Type, Authorization, AccessToken" always;
        if ($request_method = OPTIONS) { return 204; }
    }

    # Board / Leaderboard (BoardService, port 8087)
    location /api/v1/board {
        proxy_pass http://127.0.0.1:8087;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        add_header Access-Control-Allow-Origin "*" always;
        if ($request_method = OPTIONS) { return 204; }
    }

    # Payment (WSPay, port 18081)
    location /api/v1/pay {
        proxy_pass http://127.0.0.1:18081;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        add_header Access-Control-Allow-Origin "*" always;
        if ($request_method = OPTIONS) { return 204; }
    }

    # ── Legacy route (giữ backward-compat cho client cũ) ─────────────────────
    location /api-portal {
        proxy_pass http://127.0.0.1:8081/api;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_hide_header Access-Control-Allow-Origin;
        add_header Access-Control-Allow-Origin "*" always;
        add_header Access-Control-Allow-Methods "GET, POST, OPTIONS" always;
        add_header Access-Control-Allow-Headers "Content-Type, Authorization, AccessToken" always;
        add_header Access-Control-Allow-Credentials "true" always;
        if ($request_method = OPTIONS) {
            return 204;
        }
    }

    # QiPay callback route
    location /qipay-callback {
        proxy_pass http://127.0.0.1:8081/api?c=4202&$args;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }

    # General API endpoint with CORS + rate limiting
    location /api {
        limit_req zone=api_limit burst=50 nodelay;
        limit_req_status 429;
        proxy_pass http://127.0.0.1:8081/api;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_hide_header Access-Control-Allow-Origin;
        add_header Access-Control-Allow-Origin "*" always;
        add_header Access-Control-Allow-Methods "GET, POST, OPTIONS" always;
        add_header Access-Control-Allow-Headers "Content-Type, Authorization, AccessToken" always;
        add_header Access-Control-Allow-Credentials "true" always;
        if ($request_method = OPTIONS) {
            return 204;
        }
    }

    # Aviator BotChat proxy (fix CORS for play.vic68.win)
    location /api/Aviator/BotChat {
        proxy_pass https://aviator.ma88.club/BotChatService.aspx;
        proxy_set_header Host aviator.ma88.club;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_ssl_server_name on;
        add_header Access-Control-Allow-Origin "*" always;
        add_header Access-Control-Allow-Methods "GET, POST, OPTIONS" always;
        add_header Access-Control-Allow-Headers "*" always;
        if ($request_method = OPTIONS) {
            return 204;
        }
    }

    # Aviator REST API endpoints (for game client)
    location /api/Aviator/GetHistory {
        proxy_pass http://127.0.0.1:8082/api_backend?c=9901&$args;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_hide_header Access-Control-Allow-Origin;
        add_header Access-Control-Allow-Origin "*" always;
    }
    location /api/Aviator/GetBigWinner {
        proxy_pass http://127.0.0.1:8082/api_backend?c=9902&$args;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_hide_header Access-Control-Allow-Origin;
        add_header Access-Control-Allow-Origin "*" always;
    }
    location /api/Aviator/GetJackpotsHis {
        default_type application/json;
        add_header Access-Control-Allow-Origin "*" always;
        return 200 '[]';
    }

    location /hotupdate/config.plist {
        proxy_pass http://127.0.0.1:8087/hotupdate/config.plist;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }

    location /md5 {
        proxy_pass http://127.0.0.1:3001;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }

    # WebSocket - Game sockets
    location /socket-client/taixiu {
        proxy_pass http://127.0.0.1:2044/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/taixiumd5 {
        proxy_pass http://127.0.0.1:12044/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/taixiu-kubet {
        proxy_pass http://127.0.0.1:22044/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/bacay {
        proxy_pass http://127.0.0.1:1044/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/baicao {
        proxy_pass http://127.0.0.1:1144/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/binh {
        proxy_pass http://127.0.0.1:1244/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/minigame {
        proxy_pass http://127.0.0.1:1644/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/poker {
        proxy_pass http://127.0.0.1:1744/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/sam {
        proxy_pass http://127.0.0.1:1944/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/slotmachine {
        proxy_pass http://127.0.0.1:1844/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/tienlenmiennam {
        proxy_pass http://127.0.0.1:2144/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/xocdia {
        proxy_pass http://127.0.0.1:2344/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/xocdiakubet {
        proxy_pass http://127.0.0.1:22344/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/baucua {
        proxy_pass http://127.0.0.1:3644/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/banca {
        proxy_pass http://127.0.0.1:2083;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/wlode {
        proxy_pass http://127.0.0.1:2544/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/lode {
        proxy_pass http://127.0.0.1:2544/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/wdragontiger {
        proxy_pass http://127.0.0.1:2654/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/dragontiger {
        proxy_pass http://127.0.0.1:2644/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/wbaccarat {
        proxy_pass http://127.0.0.1:2744/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/baccarat {
        proxy_pass http://127.0.0.1:2744/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/wsicbo {
        proxy_pass http://127.0.0.1:2844/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/sicbo {
        proxy_pass http://127.0.0.1:2844/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    location /socket-client/wxpoker { proxy_pass http://127.0.0.1:2944/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/xpoker { proxy_pass http://127.0.0.1:2944/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/wmini777 { proxy_pass http://127.0.0.1:3044/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/mini777 { proxy_pass http://127.0.0.1:3044/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/wegypt { proxy_pass http://127.0.0.1:3144/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/egypt { proxy_pass http://127.0.0.1:3144/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/wtayduky { proxy_pass http://127.0.0.1:3244/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/tayduky { proxy_pass http://127.0.0.1:3244/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/wsongoku { proxy_pass http://127.0.0.1:3344/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/songoku { proxy_pass http://127.0.0.1:3344/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/wthuycung { proxy_pass http://127.0.0.1:3444/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/thuycung { proxy_pass http://127.0.0.1:3444/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/wcowboys { proxy_pass http://127.0.0.1:3544/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/cowboys { proxy_pass http://127.0.0.1:3544/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/wdemthuonghai { proxy_pass http://127.0.0.1:4044/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/demthuonghai { proxy_pass http://127.0.0.1:4044/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/wgirljump { proxy_pass http://127.0.0.1:4144/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/girljump { proxy_pass http://127.0.0.1:4144/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/waviator { proxy_pass http://127.0.0.1:4244/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /socket-client/aviator { proxy_pass http://127.0.0.1:4244/websocket; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }

    # Livestream static files (override path if your deploy dir differs)
    location /livestream/ {
        alias /var/www/winclub/livestream/;
        add_header Access-Control-Allow-Origin *;
    }

    # SUNWIN relay proxy (HTTPS -> HTTP to avoid mixed content)
    location /relay {
        proxy_pass http://127.0.0.1:19999/relay;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        add_header Access-Control-Allow-Origin "*" always;
        add_header Cache-Control "no-cache" always;
    }

    # Nanocosmos h5live WSS proxy (for livestream video)
    location /h5live/ {
        proxy_pass https://bintu-h5live-secure.nanocosmos.de/h5live/;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header Host bintu-h5live-secure.nanocosmos.de;
        proxy_set_header Origin https://web.sunwin.sx;
        proxy_set_header Referer https://web.sunwin.sx/;
        proxy_ssl_server_name on;
        proxy_read_timeout 86400;
        proxy_send_timeout 86400;
    }

    # WS Report - prefix path from admin CMS
    location /ws-report/ {
        proxy_pass http://127.0.0.1:7777/;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
    }

    # WS Report callbacks
    location /taixiukubet { proxy_pass http://127.0.0.1:7777/taixiukubet; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /taixiu { proxy_pass http://127.0.0.1:7777/taixiu; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /taixiumd5 { proxy_pass http://127.0.0.1:7777/taixiumd5; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /ws { proxy_pass http://127.0.0.1:7777/ws; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /xoc-dia-kubet { proxy_pass http://127.0.0.1:7777/xoc-dia-kubet; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /baucua { proxy_pass http://127.0.0.1:7777/baucua; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /rechargebyonepayotp { proxy_pass http://127.0.0.1:7777/rechargebyonepayotp; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /cashoutbybank { proxy_pass http://127.0.0.1:7777/cashoutbybank; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /rechargebyonepay { proxy_pass http://127.0.0.1:7777/rechargebyonepay; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /cashoutbymomosunvin { proxy_pass http://127.0.0.1:7777/cashoutbymomosunvin; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /rechargebymomosunvin { proxy_pass http://127.0.0.1:7777/rechargebymomosunvin; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
    location /rechargebybank { proxy_pass http://127.0.0.1:7777/rechargebybank; proxy_http_version 1.1; proxy_set_header Upgrade $http_upgrade; proxy_set_header Connection "upgrade"; }
