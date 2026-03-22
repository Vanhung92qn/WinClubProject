#!/bin/bash

# pull new source, build and run
#git restore .
#git clean -df
#git pull
#chmod -R 700 *
#./gradlew build

# setting for elasticsearch in case of running in docker
sudo sysctl -w vm.max_map_count=262144 2>/dev/null || sysctl -w vm.max_map_count=262144 2>/dev/null || true

# global environment
export TZ="Asia/Ho_Chi_Minh"

# Logs: prefer project tree (works on VPS /var/WinClubProject)
LOG_DIR="${LOG_DIR:-/var/WinClubProject/server/logs}"
mkdir -p "$LOG_DIR" /home/server/logs 2>/dev/null || true
# Absolute path this script is in
SCRIPT_PATH=$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)

# kill java process
killProcess() {
  echo "Working path: " . $SCRIPT_PATH
  kill -9 $(ps aux | grep "taixiuMini.jar" | grep -v 'grep' | awk '{print $2}')
}

runTaiXiuMini() {
  cd ${SCRIPT_PATH}
  currentDir="game/taixiuMini"
  cd $currentDir
  echo "Starting TaiXiu..."
  nohup java -cp "libs/*:build/libs/taixiuMini.jar" game.TaiXiuMiniGameMain >"${LOG_DIR}/taixiu.log" 2>&1 &
}

main() {
  killProcess
  runTaiXiuMini
}

main