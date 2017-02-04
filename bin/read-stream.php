<?php
/**
 * Created by PhpStorm.
 * User: tamaskovacs
 * Date: 2017. 02. 04.
 * Time: 16:39
 */

use PhpAmqpLib\Message\AMQPMessage;

$logger = new \Callisto\Logger(fopen('/www/tmp/stream.log', 'w'));
$oauth = new \Callisto\Oauth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
$stream = new \Callisto\Stream\Filter($oauth);

$stream->setLogger($logger);
$stream->setRequestParameters(
	[
		new Callisto\RequestParameter\Track(['twitter']),
		new Callisto\RequestParameter\Language(['en']),
	]
);

foreach ($stream->readStream() as $jsonStatus) {
	$status = json_decode($jsonStatus);
	if (!isset($status->id)) {
		$logger->info('Message', [$status]);
	}

	$msgText = json_encode(['id' => $status->id, 'text' => $status->text]);
	$msg = new AMQPMessage($jsonStatus);
	$channel->basic_publish($msg, $exchange);
}