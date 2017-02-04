<?php
/**
 * Created by PhpStorm.
 * User: tamaskovacs
 * Date: 2017. 02. 04.
 * Time: 16:48
 */


/**
 * @param \PhpAmqpLib\Message\AMQPMessage $message
 */
function process_message($message)
{
	echo "\n--------\n";
	echo $message->body;
	echo "\n--------\n";
	$message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
	// Send a message with the string "quit" to cancel the consumer.
	if ($message->body === 'quit') {
		$message->delivery_info['channel']->basic_cancel($message->delivery_info['consumer_tag']);
	}
}

$consumerTag = 'consumer';
$channel->basic_consume($queue, $consumerTag, false, false, false, false, 'process_message');

// Loop as long as the channel has callbacks registered
while (count($channel->callbacks)) {
	$channel->wait();
}
