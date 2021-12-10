<?php
require_once("pdo-connect.php");

$student_id=$_GET["student_id"];
$sql_query="DELETE FROM student_list WHERE student_id=?";
$stmt=$db_host -> prepare($sql_query);
$stmt->execute([$student_id]);

header('location: ../student-list.php');

?>