#!/bin/bash

cd ${1}/bin 2>&1;
./dc-client.py --config=../ini/dc-client_web.ini --command=SITE_STATUS --file=${2}${3}_request.json 2>&1