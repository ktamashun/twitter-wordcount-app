#!/bin/bash

sleep 30

mysql -h twitterwordcountapp_mysql_1 -u root -p123456 twc < ./database/dump.sql
php ./bin/cli.php /read-message-queue