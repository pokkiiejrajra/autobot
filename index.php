<?php 
require_once('./vendor/autoload.php'); 
    
// Namespace y
use \LINE\LINEBot\HTTPClient\CurlHTTPClient; 
use \LINE\LINEBot; 
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder; 
 
$channel_token = 'ngDb2umdW1ESIU+SOXFqckwRw65bRUHQIQkRd2avxC7nhhAUraKhpGUdv0eJTZWz2bBA60WMwuou5TyNouRxEPA4jvNPynjFPCjaVMkGf0DAXg/k9uA+0forD7rk93VW54nvmXwu8lcY2edoLB+z7wdB04t89/1O/w1cDnyilFU='; 
$channel_secret = '9831a9fea4c7d46fb2ef5852ed5dea24'; 
 
// Get message from Line API 
$content = file_get_contents('php://input'); 
$events = json_decode($content, true); 
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