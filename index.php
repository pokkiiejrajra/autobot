<?php 
require_once('./vendor/autoload.php'); 
 	
// Namespace y
use \LINE\LINEBot\HTTPClient\CurlHTTPClient; 
use \LINE\LINEBot; 
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder; 
 
public function getChannelAccessToken(){
	$channelAccessToken = "CRzQgIiN8vaAyB3HqUqg9Zt5h6r5kyPjUyAbri9sZVhTYtpSdIryoutQ74v3aubtYfSOe5OmDyd6zbI9T1bIpcTAbwHHK+2T1O93tVQowCYFfgT5AyO+o66nG2izp2dCyq76X+j0G+TVR6bPzzLygAdB04t89/1O/w1cDnyilFU=";
	return $channelAccessToken;
}
        
public function getChannelSecret(){
	$channelSecret = "a812f47e56a519ed75ee4f47cb924f19";
	return $channelSecret;
}
// Get message from Line API 
require_once __DIR__ . '/lineBot.php';
$bot = new Linebot();

$text = $bot->getMessageText(); //when user send text to bot	
$bot->reply($text); // bot reply to user