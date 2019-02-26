<?php
    header('COntent-Type:application/json');
    $stuId = $_REQUEST['stuId'];
    $conn = mysqli_connect('127.0.0.1','root','','stu',3306);
    $sql = "SET NAMES UTF8";
    mysqli_query($conn,$sql);
    $sql ="SELECT * FROM stu_message WHERE stu_id=$stuId";
    $result = mysqli_query($conn,$sql);
    if($result){
        $row =  mysqli_fetch_assoc($result);
        if($row){
            echo json_encode(["yes"]);
        }else{
            echo json_encode(["no"]);
        }
    }
?>