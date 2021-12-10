<?php
require_once("pdo-connect.php");

$schedule_id=$_GET["schedule_id"];
$sql_query="DELETE FROM course_schedule WHERE schedule_id=?";
$stmt=$db_host -> prepare($sql_query);
$stmt->execute([$schedule_id]);

header('location: ../Course-Schedule-list.php');

?>