<?php 
require_once('./vendor/autoload.php'); 
    
// Namespace y
use \LINE\LINEBot\HTTPClient\CurlHTTPClient; 
use \LINE\LINEBot; 
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder; 
 
$channel_token = 'CRzQgIiN8vaAyB3HqUqg9Zt5h6r5kyPjUyAbri9sZVhTYtpSdIryoutQ74v3aubtYfSOe5OmDyd6zbI9T1bIpcTAbwHHK+2T1O93tVQowCYFfgT5AyO+o66nG2izp2dCyq76X+j0G+TVR6bPzzLygAdB04t89/1O/w1cDnyilFU='; 
$channel_secret = 'a812f47e56a519ed75ee4f47cb924f19'; 
 
// Get message from Line API 
$content = file_get_contents('php://input'); 
$events = json_decode($content, true); 
 error_log($events);
if (!is_null($events['events'])) {     // Loop through each event     
foreach ($events['events'] as $event) {         //  Line API send a lot of event type, we interested in message only.         
if ($event['type'] == 'message') {                
switch($event['message']['type']) {                  
case 'text':                       // Get replyToken                      
 $replyToken = $event['replyToken']; 
 
                      // Reply message                       
 $respMessage = 'Hello, your message is '. $event['message']['text']; 
 
                      $httpClient = new CurlHTTPClient($channel_token);                       
                      $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));                       
                      $textMessageBuilder = new TextMessageBuilder($respMessage);                       
                      $response = $bot->replyMessage($replyToken, $textMessageBuilder); 
                 break; 
            } 
        } 
    } 
} 

echo 'OK';