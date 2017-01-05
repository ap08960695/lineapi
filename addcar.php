<?php
    include "config.php";
echo '
    <html>
    <body>
        <form action="addcar.php" method="post">
            <label>CARID</label>
            <input type="text" name="carid" onblur="check(\'carid\')"><p id="report_carid"></p><br>

            <label>MODEL</label>
            <input type="text" name="model" onblur="check(\'model\')"><p id="report_model"></p><br>
                
            <label>TYPE</label>
            <input type="text" name="type" onblur="check(\'type\')"><p id="report_type"></p><br>
            <label>Class</label>
            <input type="text" name="class" onblur="check(\'class\')"><p id="report_class"></p><br>

            <label>Province Code</label>
            <input type="text" name="province" onblur="check(\'province\')"><p id="report_province"></p><br>

            <label>Emei</label>
            <input type="text" name="emei" onblur="check(\'emei\')"><p id="report_emei"></p><br>
            <label>Name</label>
            <input type="text" name="name" onblur="check(\'name\')"><p id="report_name"></p><br>
            
            <input type="submit" name="submit" value="บันทึก">
        </form>
';  
    if($_POST['submit']!=""){
        $sql = "INSERT INTO ".$t_car_doc." (carid,model,type,class,province,emei,name) VALUES ('".$_POST['carid']."','".$_POST['model']."','".$_POST['type']."','".$_POST['class']."','".$_POST['province']."','".$_POST['emei']."','".$_POST['name']."')";
        $re=mysqli_query($conn,$sql);
        echo "เพิ่มข้อมูลสำเร็จ";
    }
    echo "</body></html>";
?>
<script>
    function check(name){
        var re = "report_";
        if(document.getElementsByName(name)[0].value.localeCompare("") == 0)
            document.getElementById(re.concat(name)).innerHTML = " กรุณากรอกข้อมูล";
    } 
</script>