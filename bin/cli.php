<?php
/**
 * Created by PhpStorm.
 * User: ktamashun <kovacs.tamas.hun@gmail.com>
 * Date: 2017. 02. 04.
 * Time: 1:18
 */

sleep(30);

require_once __DIR__.'/../vendor/autoload.php';
require_once 'config.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;


$exchange = 'twitter_stream_exchange';
$queue = 'twitter_stream_queue';
$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS, VHOST);
$channel = $connection->channel();
$channel->queue_declare($queue, false, false, false, false);
$channel->exchange_declare($exchange, 'direct', false, false, false);
$channel->queue_bind($queue, $exchange);


$app = new Silex\Application();

$app->get('/read-stream', function() use($app, $channel, $exchange) {
	require 'read-stream.php';
});
$app->get('/read-message-queue', function() use($app, $channel, $exchange) {
	require 'read-message-queue.php';
});

$request = \Symfony\Component\HttpFoundation\Request::create($argv[1], 'GET');
$app->run($request);
