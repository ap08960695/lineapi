<?php
    include "config.php";
    // Get POST body content
    $content = file_get_contents('php://input');
    // Parse JSON
    $events = json_decode($content, true);
    // Validate parsed JSON data
   // $myfile = fopen("Log.txt", "w") or die("Unable to open file!");
    //fwrite($myfile, "Start\n");
    if (!is_null($events['events'])) {
        //echo "header Ok\n";
        // Loop through each event
        foreach ($events['events'] as $event) {
            // Reply only when message sent is in 'text' format
            if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
                // Get text sent
                fwrite($myfile, "message Ok\n");
                $text = $event['message']['text'];
                if(preg_match('/0[0-9]{9}/',$text,$match)){
                    //connect database
                    $sql = 'SELECT * FROM '.$t_person.' WHERE phone="'.$text.'"';
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                        $row = mysqli_fetch_assoc($result);
                        if($row['Token']!=""){
                            $mes='มีการทำการแล้ว สามารถใช้งานได้ตามปกติ  หากต้องการแก้ไขกรุณาติดต่อเจ้าหน้าที';
                        }else{
                            $mes='มีข้อมูลในระบบ ทำการบันทึก';
                            $sql = 'UPDATE '.$t_person.' SET token="'.$event['source']['userId'].'" WHERE phone="'.$text.'"';
                            mysqli_query($conn,$sql);
                            mysqli_close($conn);
                        }
                        // Get replyToken
                        $replyToken = $event['replyToken'];
                        // Build message to reply back
                        $messages = [
                            'type' => 'text',
                            'text' => $mes
                        ];                        
                        // Make a POST Request to Messaging API to reply to sender
                        $url = $reply_url;
                        $data = [
                            'replyToken' => $replyToken,
                            'messages' => [$messages],
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
                        fwrite($myfile, $result . "\r\n");
                    }
                }
                
            }
        }
    }
    mysqli_close($conn);
?>
