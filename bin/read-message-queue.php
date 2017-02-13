<?php
/**
 * Created by PhpStorm.
 * User: tamaskovacs
 * Date: 2017. 02. 04.
 * Time: 16:48
 */

global $dbPdo;
$dbPdo = new PDO("mysql:dbname=".MYSQL_DATABASE.";host=".MYSQL_HOST, 'root', MYSQL_PASSWORD);

/**
 * @param \PhpAmqpLib\Message\AMQPMessage $message
 */
function process_message($message)
{
	global $dbPdo;
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

	$stmt = $dbPdo->prepare("SELECT word FROM word_count WHERE word LIKE :word LIMIT 1; ");
	foreach ($words as $word) {
		$stmt->bindParam(':word', $word);
		$stmt->execute();
		$row = $stmt->fetchAll();

		if (empty($row)) {
			$updateWordStmt = $dbPdo->prepare("INSERT INTO word_count (word, word_count) VALUES (:word, :word_count); ");
			$updateWordStmt->execute([
				':word' => $word,
				':word_count' => 1
			]);
		} else {
			$updateWordStmt = $dbPdo->prepare("UPDATE word_count SET word_count = word_count + 1 WHERE word = :word; ");
			$updateWordStmt->execute([
				':word' => $word
			]);
		}
	}

	$message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
}

$consumerTag = 'consumer';
$queue = '';
$channel->basic_consume($queue, $consumerTag, false, false, false, false, 'process_message');

// Loop as long as the channel has callbacks registered
while (count($channel->callbacks)) {
	$channel->wait();
}
