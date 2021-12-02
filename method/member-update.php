<?php
$name=$_POST["name"];
$account=$_POST["account"];
$password=$_POST["password"];
$gender=$_POST["gender"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$address=$_POST["address"];
$photo=$_POST["photo"];
$created_at=$_POST["created_at"];
$id=$_POST["id"];

require_once ("db-connect.php");

$sql="UPDATE member SET name='$name', account='$account', password='$password', gender='$gender', phone='$phone', email='$email', address='$address', photo='$photo', WHERE id='$id'";
//echo $sql;
//
//exit();
if ($conn->query($sql) === TRUE) {
    echo "修改資料完成<br>";
//    header("location: member-management.php");
} else {
    echo "修改資料錯誤: " . $conn->error;
}

?>