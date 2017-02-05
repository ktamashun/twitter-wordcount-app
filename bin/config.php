<?php

define('CONSUMER_KEY', getenv('TWITTER_CONSUMER_KEY'));
define('CONSUMER_SECRET', getenv('TWITTER_CONSUMER_SECRET'));
define('ACCESS_TOKEN', getenv('TWITTER_ACCESS_TOKEN'));
define('ACCESS_TOKEN_SECRET', getenv('TWITTER_ACCESS_TOKEN_SECRET'));

var_dump(getenv('RABBIT_HOST'));
var_dump(getenv('RABBIT_PORT'));
var_dump(getenv('RABBIT_USER'));
var_dump(getenv('RABBIT_AMQP_DEBUG'));

define('HOST', getenv('RABBIT_HOST'));
define('PORT', getenv('RABBIT_PORT'));
define('USER', getenv('RABBIT_USER'));
define('PASS', getenv('RABBIT_PASS'));
define('VHOST', getenv('RABBIT_VHOST'));
define('AMQP_DEBUG', getenv('RABBIT_AMQP_DEBUG'));

define('MYSQL_HOST', 'twitterwordcountapp_mysql_1');
define('MYSQL_ROOT_PASSWORD', getenv('MYSQL_ROOT_PASSWORD'));
define('MYSQL_DATABASE', getenv('MYSQL_DATABASE'));
define('MYSQL_USER', getenv('MYSQL_USER'));
define('MYSQL_PASSWORD', getenv('MYSQL_PASSWORD'));
