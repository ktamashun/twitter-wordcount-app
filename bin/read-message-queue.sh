#!/bin/bash

sleep 30

mysql -h twitterwordcountapp_mysql_1 -u root -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE < ./database/dump.sql
php ./bin/cli.php /read-message-queue
