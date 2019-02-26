<?php
    header('Content-Type:application/json');
    // header('COntent-Type:text/plain');
    // $sid = $_REQUEST['sid'];
    $stuId = $_REQUEST['stuId'];
    $stuName = $_REQUEST['stuName'];
    $stuSex = $_REQUEST['stuSex'];
    $stuEmail = $_REQUEST['stuEmail'];
    $stuBirthday = $_REQUEST['stuBirthday'];
    $stuPhone = $_REQUEST['stuPhone'];
    $stuAddr = $_REQUEST['stuAddr'];
    $conn = mysqli_connect('127.0.0.1','root','','stu',3306);
    $sql = "SET NAMES UTF8";
    mysqli_query($conn,$sql);
    $sql ="INSERT INTO stu_message VALUES(null,'$stuId','$stuName','$stuSex','$stuEmail','$stuBirthday','$stuPhone','$stuAddr')";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo json_encode(["ok"]);
    }
?>