<?php
    header('Content-Type:application/json');
    $sid = $_REQUEST['sid'];
    $conn = mysqli_connect('127.0.0.1','root','','stu',3306);
    $sql = "SET NAMES UTF8";
    mysqli_query($conn,$sql);
    $sql = "SELECT * FROM stu_message WHERE sid=$sid";
    $result = mysqli_query($conn,$sql);
    if($result){
        $row =  mysqli_fetch_assoc($result);

        echo json_encode([$row['stu_id'],$row['stu_name'],$row['stu_sex'],$row['stu_email'],$row['stu_year'],$row['stu_phone'],$row['stu_addr'],$row['sid']]);

    }
?>