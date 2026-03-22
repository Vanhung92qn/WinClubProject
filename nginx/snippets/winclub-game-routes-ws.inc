# WebSocket reverse proxy routes for game servers.
# All game traffic goes through Nginx — client never sees internal IP:port.
# Pattern: /socket-client/{gamename} → ws://127.0.0.1:{port}/websocket

    # ── Card Games ──
    location /socket-client/bacay {
        proxy_pass http://127.0.0.1:1044/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }
    location /socket-client/baicao {
        proxy_pass http://127.0.0.1:1144/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }
    location /socket-client/binh {
        proxy_pass http://127.0.0.1:1244/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }
    location /socket-client/poker {
        proxy_pass http://127.0.0.1:1744/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }
    location /socket-client/sam {
        proxy_pass http://127.0.0.1:1944/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }
    location /socket-client/tienlenmiennam {
        proxy_pass http://127.0.0.1:2144/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }
    location /socket-client/lieng {
        proxy_pass http://127.0.0.1:1543/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }

    # ── Dice/Bet Games ──
    location /socket-client/taixiu {
        proxy_pass http://127.0.0.1:2044/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }
    location /socket-client/taixiumd5 {
        proxy_pass http://127.0.0.1:12044/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }
    location /socket-client/taixiu-kubet {
        proxy_pass http://127.0.0.1:22044/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }
    location /socket-client/xocdia {
        proxy_pass http://127.0.0.1:2344/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }
    location /socket-client/xocdiakubet {
        proxy_pass http://127.0.0.1:22344/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }

    # ── Mini/Slot Games ──
    location /socket-client/minigame {
        proxy_pass http://127.0.0.1:1644/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }
    location /socket-client/slotmachine {
        proxy_pass http://127.0.0.1:1844/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }

    # ── Special Games ──
    location /socket-client/banca {
        proxy_pass http://127.0.0.1:2083;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }
    location /socket-client/baucua {
        proxy_pass http://127.0.0.1:3644/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }
    location /socket-client/overunder {
        proxy_pass http://127.0.0.1:2044/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }
    location /socket-client/lode {
        proxy_pass http://127.0.0.1:2544/websocket;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Real-IP $remote_addr;
        proxy_read_timeout 86400s;
    }
