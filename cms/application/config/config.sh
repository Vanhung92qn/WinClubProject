#!/bin/bash

if [ -z "$1" ]
 then
    echo "please input old domain"
    exit 0
fi

if [ -z "$2" ]
 then
    echo "please input new domain"
    exit 0
fi

if [ -z "$3" ]
 then
    echo "please input old ip"
    exit 0
fi

if [ -z "$4" ]
 then
    echo "please input new ip"
    exit 0
fi

sed -i "s|$1|$2|g" "config.php"
sed -i "s/$3/$4/g" "database.php"