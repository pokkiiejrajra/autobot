<?php 
require_once('./vendor/autoload.php'); 
    
// Namespace y
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
 
$channel_token = 'CRzQgIiN8vaAyB3HqUqg9Zt5h6r5kyPjUyAbri9sZVhTYtpSdIryoutQ74v3aubtYfSOe5OmDyd6zbI9T1bIpcTAbwHHK+2T1O93tVQowCYFfgT5AyO+o66nG2izp2dCyq76X+j0G+TVR6bPzzLygAdB04t89/1O/w1cDnyilFU='; 
$channel_secret = 'a812f47e56a519ed75ee4f47cb924f19'; 
 
$logger = new Logger('LineBot');
$logger->pushHandler(new StreamHandler('php://stderr', Logger::DEBUG));
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($_ENV["LINEBOT_ACCESS_TOKEN"]);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $_ENV["LINEBOT_CHANNEL_SECRET"]]);
$signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
try {
  $events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
} catch(\LINE\LINEBot\Exception\InvalidSignatureException $e) {
  error_log('parseEventRequest failed. InvalidSignatureException => '.var_export($e, true));
} catch(\LINE\LINEBot\Exception\UnknownEventTypeException $e) {
  error_log('parseEventRequest failed. UnknownEventTypeException => '.var_export($e, true));
} catch(\LINE\LINEBot\Exception\UnknownMessageTypeException $e) {
  error_log('parseEventRequest failed. UnknownMessageTypeException => '.var_export($e, true));
} catch(\LINE\LINEBot\Exception\InvalidEventRequestException $e) {
  error_log('parseEventRequest failed. InvalidEventRequestException => '.var_export($e, true));
}

foreach ($events as $event) {
  // Postback Event
  if (($event instanceof \LINE\LINEBot\Event\PostbackEvent)) {
    $logger->info('Postback message has come');
    continue;
  }
  // Location Event
  if  ($event instanceof LINE\LINEBot\Event\MessageEvent\LocationMessage) {
    $logger->info("location -> ".$event->getLatitude().",".$event->getLongitude());
    continue;
  }
  
  // Message Event = TextMessage
  if (($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage)) {
    // get message text
    $messageText=strtolower(trim($event->getText()));
    
  }
} 
$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("text message");
$bot->replyMessage($event->getReplyToken(), $outputText);