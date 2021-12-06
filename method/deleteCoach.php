<?php
require_once("pdo-connect.php");
$stmt=$db_host->prepare("delete from coach where coach_id=" . $_GET['id']);
$stmt->execute();
header('location: ../coach.php');
//$coach_id=$_GET["id"];
//$coach_valid=$_GET["coach_valid"];
//
////echo $id;
//$sql="UPDATE coach SET coach_valid=0 WHERE coach_id='$coach_id'";
//if ($db_host->prepare($sql) === TRUE) {
//    echo "刪除資料完成<br>";
////    header("location: ./coach.php");
//} else {
//    echo "刪除資料錯誤: " . $db_host->error;
//}
//if(isset($_GET["id"])){
//    $coach_id=$_GET["id"];
//}else{
//    $coach_id=0;
//}
//$sql = "UPDATE coach SET coach_valid=? WHERE coach_id=?";
//$stmt= $db_host->prepare($sql);
//$stmt->execute([0, "id"]);
//echo $coach_id;

//$db->exec("DELETE FROM coach where coach_id='$coach_id'");
//$sql = "DELETE FROM coach WHERE coach_id";
//$stmt = $db_host->prepare($sql);
//$stmt->execute();
//echo $stmt->rowCount();
