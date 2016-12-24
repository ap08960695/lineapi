<?php
$access_token = '8Xgy2cPFKsNPIIFdP9KpS6gVyz5XIcUbreQM2BhEjE5qz3dg6EmXOSScxyMAsAOCC2KNGe3tptY7vzosT0oONJ/CCqEYBnrmo7ljUMbqzRRlQzB8oZGQYsQLlLaXDFgcv0Z3/9Yuoy+gxyYwXbAmTgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v2/bot/message/push';
            $UID = 'U6ad599cf40005784875d3eaee6f6c9b0';
            $text = "สวัดดีเราเป็นบอท"ว
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'to' => $UID,
				'messages' => [$messages],
			];
$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>