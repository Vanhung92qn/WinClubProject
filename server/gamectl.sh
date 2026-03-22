#!/bin/bash
# ══════════════════════════════════════════════════════════════
# gamectl.sh — Unified game server management
# Usage: ./gamectl.sh [start|stop|status|restart|sync-config] [game|all]
# Examples:
#   ./gamectl.sh status              # Show all game server status
#   ./gamectl.sh start all           # Start all game servers
#   ./gamectl.sh start taixiu        # Start only TaiXiu
#   ./gamectl.sh stop all            # Stop all game servers
#   ./gamectl.sh sync-config         # Symlink shared config to all games
# ══════════════════════════════════════════════════════════════

BASE_DIR="$(cd "$(dirname "$0")" && pwd)"
LOG_DIR="$BASE_DIR/logs"
CONFIG_SHARED="$BASE_DIR/config-shared"
mkdir -p "$LOG_DIR"

# Game registry: name → dir:jar_name:main_class:port
declare -A GAMES=(
    [minigame]="game/Minigame:Minigame:game.MiniGameMain:1644"
    [slot]="game/slot:SlotMachine:game.SlotMain:1844"
    [taixiu]="game/taixiuMini:taixiuMini:game.TaiXiuMiniGameMain:2044"
    [taixiumd5]="game/taixiuMd5:taixiuMd5:game.TaiXiuMiniGameMain:12044"
    [taixiukubet]="game/taixiuKubet:taixiuKubet:game.TaiXiuMiniGameMain:22044"
    [xocdia]="game/xocdia:xocdia:game.xocdia.server.XocDiaMain:2344"
    [xocdiakubet]="game/xocdiaKubet:xocdiaKubet:game.xocdia.server.XocDiaMain:22344"
    [bacay]="game/bacayServer:bacayServer:game.bacay.server.BacayMain:1044"
    [baicao]="game/baicao:baicao:game.baicao.server.BaiCaoMain:1144"
    [binh]="game/binh:binh:game.binh.server.BinhMain:1244"
    [poker]="game/poker:poker:game.poker.server.PokerMain:1744"
    [sam]="game/sam:sam:game.sam.server.SamMain:1944"
    [tlmn]="game/tlmn:tlmn:game.tienlen.server.TlmnMain:2144"
    [baucua]="game/baucuato2:baucuato2:game.BauCuaTo2Main:3644"
    [lieng]="game/lieng:lieng:game.lieng.server.LiengMain:1543"
)

# ── Colors ──
RED='\033[0;31m'; GREEN='\033[0;32m'; YELLOW='\033[1;33m'; NC='\033[0m'

get_game_info() {
    local info="${GAMES[$1]}"
    IFS=':' read -r DIR JAR MAIN PORT <<< "$info"
    GAME_DIR="$BASE_DIR/$DIR"
    GAME_JAR="$JAR"
    GAME_MAIN="$MAIN"
    GAME_PORT="$PORT"
}

is_running() {
    ss -tlnp 2>/dev/null | grep -q ":$1 " && return 0 || return 1
}

get_pid() {
    local pid=$(ss -tlnp 2>/dev/null | grep ":$1 " | grep -oP 'pid=\K[0-9]+' | head -1)
    echo "$pid"
}

start_game() {
    local name="$1"
    get_game_info "$name"
    if [ -z "$GAME_DIR" ]; then echo -e "${RED}Unknown game: $name${NC}"; return 1; fi
    if is_running "$GAME_PORT"; then
        echo -e "${YELLOW}[$name]${NC} Already running on port $GAME_PORT"
        return 0
    fi
    echo -ne "${YELLOW}[$name]${NC} Starting on port $GAME_PORT..."
    cd "$GAME_DIR" || { echo -e "${RED} Directory not found: $GAME_DIR${NC}"; return 1; }

    # Build if needed
    if [ ! -f "build/libs/${GAME_JAR}.jar" ]; then
        echo -ne " building..."
        cd "$BASE_DIR" && ./gradlew ":${DIR//\//:}:build" -q 2>/dev/null
        cd "$GAME_DIR" || return 1
    fi

    nohup java -cp "libs/*:build/libs/${GAME_JAR}.jar" $GAME_MAIN \
        >> "$LOG_DIR/${name}.log" 2>&1 &

    # Wait for port
    for i in $(seq 1 10); do
        sleep 1
        if is_running "$GAME_PORT"; then
            echo -e " ${GREEN}OK${NC} (pid=$(get_pid $GAME_PORT))"
            return 0
        fi
    done
    echo -e " ${RED}FAILED${NC} (check $LOG_DIR/${name}.log)"
    return 1
}

stop_game() {
    local name="$1"
    get_game_info "$name"
    if [ -z "$GAME_DIR" ]; then echo -e "${RED}Unknown game: $name${NC}"; return 1; fi
    local pid=$(get_pid "$GAME_PORT")
    if [ -z "$pid" ]; then
        echo -e "${YELLOW}[$name]${NC} Not running"
        return 0
    fi
    echo -ne "${YELLOW}[$name]${NC} Stopping pid=$pid..."
    kill "$pid" 2>/dev/null
    for i in $(seq 1 5); do
        sleep 1
        if ! is_running "$GAME_PORT"; then
            echo -e " ${GREEN}stopped${NC}"
            return 0
        fi
    done
    kill -9 "$pid" 2>/dev/null
    echo -e " ${RED}force killed${NC}"
}

status_game() {
    local name="$1"
    get_game_info "$name"
    if is_running "$GAME_PORT"; then
        local pid=$(get_pid "$GAME_PORT")
        printf "  ${GREEN}●${NC} %-15s port %-6s pid %-8s ${GREEN}RUNNING${NC}\n" "$name" "$GAME_PORT" "$pid"
    else
        printf "  ${RED}○${NC} %-15s port %-6s ${RED}STOPPED${NC}\n" "$name" "$GAME_PORT"
    fi
}

sync_config() {
    echo "Syncing shared config → game servers..."
    if [ ! -d "$CONFIG_SHARED" ]; then
        echo -e "${RED}config-shared/ not found${NC}"
        return 1
    fi
    local count=0
    for name in "${!GAMES[@]}"; do
        get_game_info "$name"
        if [ -d "$GAME_DIR/config" ]; then
            for cfg in db_pool.properties mongo.properties rmq.properties hazelcast.properties; do
                if [ -f "$CONFIG_SHARED/$cfg" ] && [ -f "$GAME_DIR/config/$cfg" ]; then
                    # Backup original, create symlink
                    if [ ! -L "$GAME_DIR/config/$cfg" ]; then
                        mv "$GAME_DIR/config/$cfg" "$GAME_DIR/config/${cfg}.bak" 2>/dev/null
                        ln -sf "$CONFIG_SHARED/$cfg" "$GAME_DIR/config/$cfg"
                        count=$((count+1))
                    fi
                fi
            done
        fi
    done
    echo -e "${GREEN}Synced $count config files → shared symlinks${NC}"
    echo "Edit once: $CONFIG_SHARED/*.properties"
}

# ── Main ──
ACTION="${1:-status}"
TARGET="${2:-all}"

case "$ACTION" in
    status)
        echo "=== WinClub Game Servers ==="
        echo ""
        # Also show API servers
        for svc in "portal:8081" "backend:8082" "board:8087"; do
            IFS=':' read -r sname sport <<< "$svc"
            if is_running "$sport"; then
                printf "  ${GREEN}●${NC} %-15s port %-6s ${GREEN}RUNNING${NC}\n" "api-$sname" "$sport"
            else
                printf "  ${RED}○${NC} %-15s port %-6s ${RED}STOPPED${NC}\n" "api-$sname" "$sport"
            fi
        done
        echo ""
        for name in $(echo "${!GAMES[@]}" | tr ' ' '\n' | sort); do
            status_game "$name"
        done
        echo ""
        running=$(for name in "${!GAMES[@]}"; do get_game_info "$name"; is_running "$GAME_PORT" && echo 1; done | wc -l)
        total=${#GAMES[@]}
        echo "  Total: $running/$total running"
        ;;
    start)
        if [ "$TARGET" = "all" ]; then
            for name in $(echo "${!GAMES[@]}" | tr ' ' '\n' | sort); do
                start_game "$name"
            done
        else
            start_game "$TARGET"
        fi
        ;;
    stop)
        if [ "$TARGET" = "all" ]; then
            for name in $(echo "${!GAMES[@]}" | tr ' ' '\n' | sort); do
                stop_game "$name"
            done
        else
            stop_game "$TARGET"
        fi
        ;;
    restart)
        if [ "$TARGET" = "all" ]; then
            for name in $(echo "${!GAMES[@]}" | tr ' ' '\n' | sort); do
                stop_game "$name"
                start_game "$name"
            done
        else
            stop_game "$TARGET"
            start_game "$TARGET"
        fi
        ;;
    sync-config)
        sync_config
        ;;
    *)
        echo "Usage: $0 {status|start|stop|restart|sync-config} [game_name|all]"
        echo ""
        echo "Games: ${!GAMES[*]}"
        exit 1
        ;;
esac
