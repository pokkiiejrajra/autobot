<?php
require_once '../vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
$logger = new Logger('LineBot');
$logger->pushHandler(new StreamHandler('php://stderr', Logger::DEBUG));
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($_ENV["LINEBOT_ACCESS_TOKEN"]);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $_ENV["LINEBOT_CHANNEL_SECRET"]]);
$signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
try {
<?php

require_once('./vendor/autoload.php');

// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

// Token
$channel_token = 'CRzQgIiN8vaAyB3HqUqg9Zt5h6r5kyPjUyAbri9sZVhTYtpSdIryoutQ74v3aubtYfSOe5OmDyd6zbI9T1bIpcTAbwHHK+2T1O93tVQowCYFfgT5AyO+o66nG2izp2dCyq76X+j0G+TVR6bPzzLygAdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'a812f47e56a519ed75ee4f47cb924f19';

// Get message from Line API
$content = file_get_contents('php://input');
$events = json_decode($content, true);

if (!is_null($events['events'])) {

	// Loop through each event
	foreach ($events['events'] as $event) {
    
        // Get replyToken
        $replyToken = $event['replyToken'];
        $ask = $event['message']['text'];

        switch(strtolower($ask)) {
            case 'm':
                $respMessage = 'What sup man. Go away!';
                break;
            case 'f':
                $respMessage = 'Love you lady.';
                break;
            default:
                $respMessage = 'What is your sex? M or F';
                break;    
        }

        $httpClient = new CurlHTTPClient($channel_token);
        $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));

        $textMessageBuilder = new TextMessageBuilder($respMessage);
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
        
	}
}

echo "OK";
