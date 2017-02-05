<?php

define('CONSUMER_KEY', getenv('TWITTER_CONSUMER_KEY'));
define('CONSUMER_SECRET', getenv('TWITTER_CONSUMER_SECRET'));
define('ACCESS_TOKEN', getenv('TWITTER_ACCESS_TOKEN'));
define('ACCESS_TOKEN_SECRET', getenv('TWITTER_ACCESS_TOKEN_SECRET'));

define('HOST', getenv('RABBIT_HOST'));
define('PORT', getenv('RABBIT_PORT'));
define('USER', getenv('RABBIT_USER'));
define('PASS', getenv('RABBIT_PASS'));
define('VHOST', getenv('RABBIT_VHOST'));
define('AMQP_DEBUG', getenv('RABBIT_AMQP_DEBUG'));

define('MYSQL_HOST', getenv('MYSQL_HOST'));
define('MYSQL_ROOT_PASSWORD', getenv('MYSQL_ROOT_PASSWORD'));
define('MYSQL_DATABASE', getenv('MYSQL_DATABASE'));
define('MYSQL_USER', getenv('MYSQL_USER'));
define('MYSQL_PASSWORD', getenv('MYSQL_PASSWORD'));
