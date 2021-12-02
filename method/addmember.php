<?php
require_once ("db-connect.php");
$name=$_POST["name"];
$account=$_POST["account"];
$password=$_POST["password"];
$gender=$_POST["gender"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$address=$_POST["address"];
$photo=$_POST["photo"];
$created_at=$_POST["created_at"];
$valid=1;

//$repassword=$_POST["repassword"];
//if($password!==$repassword){
//    echo "密碼不一致";
//    exit();
//}
$crPassword=md5($password); //存至資料庫時密碼顯示變亂碼
//echo "$crPassword<br>";
$sqlCheck="SELECT * FROM member WHERE account='$account'";
$checkResult=$conn->query($sqlCheck);
$userExist=$checkResult->num_rows;
//echo $userExist;
if($userExist>0){
    echo "帳號已存在";
    exit();
}
$now=date("Y-m-d H:i:s");
$sql="INSERT INTO member(name, account, password, gender, phone, email, address, photo, created_at, valid) VALUES('$name', '$account', '$password', '$gender', '$phone', '$email', '$address', '$photo', '$now', '$valid')";


if ($conn->query($sql) === TRUE) {
    echo "新增資料完成<br>";
    $id=$conn->insert_id;
//    header("location: user-list.php");
} else {
    echo "新增資料錯誤: " . $conn->error;
}

?>
