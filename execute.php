<?php
session_start();
?>

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

$text = trim($text);
$text = strtolower($text);

$response = "";

date_default_timezone_set('Europe/Rome');

$time = date('H:i');
$date = date("d/m/y");

if(strpos($text, "/orario") === 0)
{
	$response = " Sono le ore $time" ;
}
elseif(strpos($text, "/data") === 0)
{
	$response = " Sono le ore $date" ;
}
elseif(strpos($text, "/pianifica") === 0){
	$risposta = ltrim($text, "/pianifica ");
	$_SESSION["orario_impostato"] = substr($risposta, 0, 5);
	$_SESSION["risposta"] = substr($risposta, 6);
//	$orario_impostato = trim($orario_impostato, ":");
	
	
	$response = "Hai impostato l'orario: " . $_SESSION["orario_impostato"] . "\n \n" . $_SESSION["risposta"];
} 
elseif(strpos($text, "/chat_id") === 0){
	$response = $chatId;
}

if($time == $_SESSION["orario_impostato"]){
	$response = $_SESSION["risposta"];
	$chatId = -399849309;
}

if(strpos($text, "/test") === 0){
//	$_SESSION["orario_imposato"];
//	$_SESSION["risposta"];
	$response = "Test: $orario_impostato \n $risposta";
}
/* function post_message($string){
	$response = "ciao";//rtrim('/pianifica', $string);
	return $response;
	//	$risposta = str_replace("/pianifica ", "", $string);
//	return $risposta;
} */




header("Content-Type: application/json");
$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);
?>
