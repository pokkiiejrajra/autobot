<?php
/**
 * Use for return easy answer.
 */
require_once('./vendor/autoload.php'); 
 	
// Namespace y
use \LINE\LINEBot\HTTPClient\CurlHTTPClient; 
use \LINE\LINEBot; 
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder; 
 
$channel_token = 'hTlHa5xYqShfpOrz7E5d6CJFJIzTYMfCyJf144QrX2zXhM/gIYyRpMbEHIVkk8oTYfSOe5OmDyd6zbI9T1bIpcTAbwHHK+2T1O93tVQowCaHf2gQTHRpo7DizvEytAOdWR4DEUkmfkhce5koeec5AwdB04t89/1O/w1cDnyilFU='; 
$channel_secret = '6916236e9febf78a343f708cec23376a'; 
 
// Get message from Line API 
$content = file_get_contents('php://input'); 
$events = json_decode($content, true); 
 
if (!is_null($events['events'])) {     
// Loop through each event     
foreach ($events['events'] as $event) {         
//  Line API send a lot of event type, we interested in message only.         
if ($event['type'] == 'message') {                
switch($event['message']['type']) {                  
case 'text':                       
// Get replyToken                      
 $replyToken = $event['replyToken']; 
 
                      // Reply message                       
 $respMessage = "Hello, your message is ". $event['message']['text']; 
 
                      $httpClient = new CurlHTTPClient($channel_token);                       
                      $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));                       
                      $textMessageBuilder = new TextMessageBuilder($respMessage);                       
                      $response = $bot->replyMessage($replyToken, $textMessageBuilder); 
                 break; 
            } 
        } 
    } 
} 
echo "OK";