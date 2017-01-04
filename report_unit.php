<?php
    include "config.php";
    echo "
        <table>
            <tr>
                <th>Input</th>
                <th>Message</th>
                <th></th>
            </tr>
    ";
    if($_GET['act']=='add'){
        $sql = "INSERT INTO ".$t_report." (input,message) VALUES ('".$_POST['input']."','".$_POST['message']."')";
        mysqli_query($conn,$sql);
    }else if($_GET['act']=='edit'){
        $sql = "SELECT * FROM ".$t_report;
        $result=mysqli_query($conn,$sql);
        echo "<form action='report_unit.php?act=add2' method='post'>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>
                    <th><input type='text' name='input".$row['id']."' value='".$row['input']."'></th>
                    <th><input type='text' name='message".$row['id']."' value='".$row['message']."'></th>
                    <th></th>
                </tr>
            ";
        }
        echo "
                <tr>
                    <th colspan='3'><input type='submit' value='บันทึก'></th>
                </tr>
            </form>
        ";
    }else if($_GET['act']=="add2"){
        for($i=1;$_POST['input'.$i]!=NULL;$i++){
            $sql = "UPDATE ".$t_report." SET input='".$_POST['input'.$i]."',message='".$_POST['message'.$i]."' WHERE id='".$i."'";
            mysqli_query($conn,$sql);
        }
    }else if($_GET['act']=="del"){
        $id = $_GET['id'];
        $sql="DELETE FROM ".$t_report." WHERE id='".$id."'";
        mysqli_query($conn,$sql);
    }
    if($_GET['act'] != "edit"){
        $sql = "SELECT * FROM ".$t_report;
        $result=mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
            echo "<tr>
                    <th>".$row['input']."</th>
                    <th>".$row['message']."</th>
                    <th><button type='button' onclick='window.location=\"report_unit.php?act=del&id=".$row['id']."\"'>ลบ</button></th>
                </tr>";
        }
        echo "
            <form action='report_unit.php?act=add' method='post'>
                <tr>
                    <th><input type='text' name='input'></th>
                    <th><input type='text' name='message'></th>
                    <th></th>
                </tr>
                <tr>
                    <th><input type='submit' value='เพิ่ม'></th>
                    <th><button type='button' onclick='window.location=\"report_unit.php?act=edit\"'>แก้ไข</button></th>
                </tr>
                <th></th>
            </form>
        ";
    }
    echo"        
        </table>
    ";
    mysqli_close($conn);
?>