<?php
require_once("pdo-connect.php");

$course_code=$_GET["course_code"];

$sql_query="DELETE FROM course_list WHERE course_code=?";
$stmt=$db_host -> prepare($sql_query);
$stmt->execute([$course_code]);

header('location: ../course-list.php');

?>