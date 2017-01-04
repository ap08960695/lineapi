<?php
            include "config.php";
            $url = $push_url;
            $UID = $_POST['token'];
            $text = html_entity_decode($_POST['message']);
            if($UID != "" && $text != ""){
                // Build message to reply back
                $messages = [
                    'type' => 'text',
                    'text' => $text
                ];
                $data = [
                    'to' => $UID,
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

                echo $result;
            }
            //U6ad599cf40005784875d3eaee6f6c9b0
?>
