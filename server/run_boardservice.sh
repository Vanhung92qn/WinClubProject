#!/bin/bash

# pull new source, build and run
#git restore .
#git clean -df
#git pull
#chmod -R 700 *
#./gradlew build

# setting for elasticsearch in case of running in docker
# sysctl -w vm.max_map_count=262144 (Disable to prevent permission denied)

# global environment
export TZ="Asia/Ho_Chi_Minh"

# make log server
mkdir -p ./logs/
# Absolute path this script is in, thus /home/user/bin
SCRIPT_PATH=$(pwd)

# kill java process
killProcess() {
  echo "Working path: " . $SCRIPT_PATH
  pkill -f "BoardService" || true
}

runBoardService() {
  cd ${SCRIPT_PATH}
  currentDir="api/BoardService"
  cd $currentDir
  echo "Starting BoardService..."
  nohup java -jar build/libs/BoardService-1.0-SNAPSHOT.jar > ../../logs/boardService.log 2>&1 &
}

main() {
  killProcess
  runBoardService
}

main