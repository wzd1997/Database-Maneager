<?php
    header('Content-Type:application/json');
    $sid = $_REQUEST['sid'];
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
    $sql ="UPDATE stu_message SET stu_id='$stuId', stu_name='$stuName',stu_sex='$stuSex',stu_email='$stuEmail',stu_year='$stuBirthday',stu_phone='$stuPhone',stu_addr='$stuAddr' WHERE sid=$sid";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo json_encode(["ok"]);
    }
?>