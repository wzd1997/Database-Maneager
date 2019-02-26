<?php
    header('Content-Type:application/json');
    $sid = $_REQUEST['sid'];
    $conn = mysqli_connect('127.0.0.1','root','','stu',3306);
    $sql = "SET NAMES UTF8";
    mysqli_query($conn,$sql);
    $sql = "DELETE FROM stu_message WHERE sid=$sid";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo json_encode(["deleteOk"]);
        // echo "deleteOk";
    }
?>