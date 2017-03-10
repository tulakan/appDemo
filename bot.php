<?php
$access_token = 'tr8HLJ2dhtefwQfJmfwNRaDmby+sPq+Hig5ut3kN/fehhXey8kttyk/aZCzi1/Xt+9CIYLHaLMUr0ZP58JvdTGHW0Xxqop3vA0CtHJsxkrcvNU20TtFntWrDlo30+QJFGXLW1of5cAfw1IDl0M5UqgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$sensorValue = file_get_contents("https://appdemo-8ae93.firebaseio.com/sensorValue.json");
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
//			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
            $message1 = [
                'type' => 'text',
                'text' => '40 %'
            ];
            $message2 = [
                'type' => 'text',
                'text' => 'ลำปางหนาวมากกก'
            ];
            $message3 = [
                'type' => 'image',
                'originalContentUrl' => 'http://www.thaiarcheep.com/wp-content/uploads/2015/07/%E0%B8%97%E0%B8%B8%E0%B9%80%E0%B8%A3%E0%B8%B5%E0%B8%A2%E0%B8%99-1-%E0%B8%95%E0%B9%89%E0%B8%99-%E0%B8%AA%E0%B8%B2%E0%B8%A1%E0%B8%B2%E0%B8%A3%E0%B8%96%E0%B9%83%E0%B8%AB%E0%B9%89%E0%B8%9C%E0%B8%A5%E0%B9%84%E0%B8%94%E0%B9%89.jpg',
                "previewImageUrl" => 'http://www.thaiarcheep.com/wp-content/uploads/2015/07/%E0%B8%97%E0%B8%B8%E0%B9%80%E0%B8%A3%E0%B8%B5%E0%B8%A2%E0%B8%99-1-%E0%B8%95%E0%B9%89%E0%B8%99-%E0%B8%AA%E0%B8%B2%E0%B8%A1%E0%B8%B2%E0%B8%A3%E0%B8%96%E0%B9%83%E0%B8%AB%E0%B9%89%E0%B8%9C%E0%B8%A5%E0%B9%84%E0%B8%94%E0%B9%89.jpg'
            ];


			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => $message3,
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);


			echo $result . "\r\n";
		}
	}
}
echo "OK";



