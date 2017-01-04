<?php
    //time
    date_default_timezone_set("Asia/Bangkok");
    //token line bot
    $access_token = 'X/POSEXOEkBoyct2NuCIgDXsaAXLZ1s9vEPrca2qy+JPjI+1OtDzbtvXTESLKL9sOm4HuisT9BUnNE3w/h0IRdQGuBsH8n0rljvmAcVXKU/A04IDebEYhBKI97SAV7soEW0etCkPYj8KCydtE5joYQdB04t89/1O/w1cDnyilFU=';
    //config server
    $servername = "localhost";
    $username = "gisorg_AdminLine";
    $password = "123456*ar";
    //url
    $reply_url = 'https://api.line.me/v2/bot/message/reply';
    $push_url = 'https://api.line.me/v2/bot/message/push';
    //database name
    $database = "gisorg_Line";
    //table name
    $t_person= 'person';
    $t_data1= 'data1';
    $t_car= 'car';
    $t_report = 'report_string';
    $t_car_doc = 'car_doc';
    //line add box
    $box_line='<a href="https://line.me/R/ti/p/%40wbz1598m"><img height="36" border="0" alt="เพิ่มเพื่อน" src="https://scdn.line-apps.com/n/line_add_friends/btn/en.png"></a>';
    //report
    $read_per_round = 1000;
    //sql
    $conn = mysqli_connect($servername, $username, $password,$database);
    mysqli_query($conn,"SET character_set_results=utf8");
    mysqli_query($conn,"SET character_set_client=utf8");
    mysqli_query($conn,"SET character_set_connection=utf8");
?>