#!/bin/bash

sleep 30
mysql -h twitterwordcountapp_mysql_1 -u root -p123456 mydb < ../database/dump.sql