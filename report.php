<?php
    include "config.php";
    //$date = date("Y-m-d");
    $sql = "SELECT * FROM last";
    $result_last = mysqli_query($conn,$sql);
    $row_last = mysqli_fetch_assoc($result_last);
    $last = $row_last['last'];
    /*if(!file_exists("Log//".$date.".txt")){
        $write=fopen("Log//".$date.".txt","w");
    }else{
        $write=fopen("Log//".$date.".txt","a");
    }*/
    $url = $push_url;
    //$sql = "SELECT d.id , d.alarm , p.Token FROM ".$t_data1." d INNER JOIN ".$t_car." c ON c.carid = d.carid INNER JOIN ".$t_person." p ON p.mail = c.mail WHERE d.alarm <> '' ";
    $sql = "SELECT * FROM ".$t_data1." WHERE id > ".$last."";
    $result_alarm = mysqli_query($conn,$sql);
    $count=$read_per_round;
    while($row_alarm = mysqli_fetch_assoc($result_alarm)){
        $last=$row_alarm['id'];
        if($row_alarm['alarm']!=''){
            $sql = "SELECT p.Token,p.phone FROM ".$t_person." p INNER JOIN ".$t_car." c ON c.carid = '".$row_alarm['carid']."' WHERE p.mail=c.mail";
            $result = mysqli_query($conn,$sql);
            $text = html_entity_decode($row_alarm['alarm']);
            $sql = "SELECT * FROM ".$t_report." WHERE input='".$text."'";
            $result_string = mysqli_query($conn,$sql);
            if($row_string = mysqli_fetch_assoc($result_string)){
                $text=$row_string['message'];    
            }
            while($row = mysqli_fetch_assoc($result)){
                // Build message to reply back
                $UID = $row['Token'];    
                $mh = curl_multi_init();
                $handles = array();
                if($UID!=''){    
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
                    $handles[] = $ch;
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_multi_add_handle($mh,$ch);
                }
                $running = null;
                do {
                    curl_multi_exec($mh, $running);
                } while ($running);
                foreach($handles as $ch){
                    curl_multi_remove_handle($mh, $ch);
                    curl_close($ch);
                }
                //fwrite($write,date("[H:i:s]")." Sent message '".$text."' to '".$row['phone']."'\r\n");
            }
        }
        $count--;
        if($count==0)break;
    }
    $sql = "UPDATE last SET last='".$last."'";
    mysqli_query($conn,$sql);
    //fclose($write);
    mysqli_close($conn);
?>