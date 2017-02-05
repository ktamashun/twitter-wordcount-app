<?php
/**
 * Created by PhpStorm.
 * User: tamaskovacs
 * Date: 2017. 02. 04.
 * Time: 16:48
 */

global $db33;
$db33 = new PDO("mysql:dbname=".MYSQL_DATABASE.";host=".MYSQL_HOST, 'root', MYSQL_PASSWORD);

/**
 * @param \PhpAmqpLib\Message\AMQPMessage $message
 */
function process_message($message)
{
	global $db33;
	$status = json_decode($message->body);

	$words = array_filter(explode(' ', $status->text), function($value) {
		if (empty($value)) {
			return false;
		}
		if (in_array($value, ['RT'])) {
			return false;
		}
		if ('@' == $value{0}) {
			return false;
		}
		if ('http' == substr($value, 0, 4)) {
			return false;
		}

		return true;
	});

	//var_dump(count($words));
	foreach ($words as $word) {
		$db33->exec('INSERT INTO word_count (word, word_count) VALUES ("'.$word.'", 1); ');
	}

	$message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
}

$consumerTag = 'consumer';
$channel->basic_consume($queue, $consumerTag, false, false, false, false, 'process_message');

// Loop as long as the channel has callbacks registered
while (count($channel->callbacks)) {
	$channel->wait();
}
