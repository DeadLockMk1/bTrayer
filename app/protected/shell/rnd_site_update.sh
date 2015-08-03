#!/bin/bash

cd ${1}/bin 2>&1;
./dc-client.py --config=../ini/dc-client_web.ini --command=SITE_UPDATE --file=${2} 2>&1