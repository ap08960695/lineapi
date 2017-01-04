<?php
    include "config.php";
    echo "
        <form action='addLine.php' method='post'>
            ชื่อ   <input type='text' name='name'><br>
                        ที่อยู่  <input type='text' name='ad1'><br>
        <input type='text' name='ad2'><br>
        <input type='text' name='ad3'><br>
        <input type='text' name='ad4'><br>
        <input type='text' name='ad5'><br>
                        เบอร์โทรศัพท์  <input type='text' name='phone'><br>
                        E-mail  <input type='text' name='mail'><br>
                        LineID  <input type='text' name='line'><br>
                        <input type='submit' name='submit' value='ส่ง'>
        </form>
    ";
    if($_POST['submit']!=""){
        if($_POST['name']!=""){
            if($_POST['ad1']!="" || $_POST['ad2']!="" || $_POST['ad3']!="" || $_POST['ad4']!="" || $_POST['ad5']!=""){
                if($_POST['phone']!=""){
                    if($_POST['mail']!=""){
                        if($_POST['line']!=""){
                            $sql = 'INSERT INTO '.html_entity_decode($t_person).' (name,ad1,ad2,ad3,ad4,ad5,phone,mail,lineID)
VALUES ("'.html_entity_decode($_POST['name']).'","'.html_entity_decode($_POST['ad1']).'","'.html_entity_decode($_POST['ad2']).'","'.html_entity_decode($_POST['ad3']).'","'.html_entity_decode($_POST['ad4']).'","'.html_entity_decode($_POST['ad5']).'","'.html_entity_decode($_POST['phone']).'","'.html_entity_decode($_POST['mail']).'","'.html_entity_decode($_POST['line']).'");';
                            mysqli_query($conn,$sql);
                            echo "Success Add<br>";
                            echo $box_line;
                        }else echo "กรุณากรอกLineID<br>";
                    }else echo "กรุณากรอกE-mail<br>";
                }else echo "กรุณากรอกเบอร์โทรศัพท์<br>";
            }else echo "กรุณากรอกที่อยู่<br>";
        }else echo "กรุณากรอกชื่อ<br>";
    }
    mysqli_close($conn);
?>