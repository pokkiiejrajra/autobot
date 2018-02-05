<?php
require_once('./vendor/autoload.php'); 
    
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('<CRzQgIiN8vaAyB3HqUqg9Zt5h6r5kyPjUyAbri9sZVhTYtpSdIryoutQ74v3aubtYfSOe5OmDyd6zbI9T1bIpcTAbwHHK+2T1O93tVQowCYFfgT5AyO+o66nG2izp2dCyq76X+j0G+TVR6bPzzLygAdB04t89/1O/w1cDnyilFU=>');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '<a812f47e56a519ed75ee4f47cb924f19>']);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
$response = $bot->pushMessage('<to>', $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
?>