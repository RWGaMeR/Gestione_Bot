<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(!$update)
{
  exit;
}

$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

$response = "";

date_default_timezone_set('Europe/Rome');

$time = (string)date('H:i');
$date = (string)date("d/m/y");

if(strpos($text, "/orario") === 0)
{
	$response = " Sono le ore $time" ;
}
elseif(strpos($text, "/data") === 0)
{
	$response = " Sono le ore $date" ;
}
