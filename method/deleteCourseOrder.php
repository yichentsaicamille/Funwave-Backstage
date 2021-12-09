<?php
require_once("pdo-connect.php");

$course_order_id=$_GET["course_order_id"];

    $sql_query="DELETE FROM course_order_list WHERE course_order_id=?";
    $stmt=$db_host -> prepare($sql_query);
    $stmt->execute([$course_order_id]);

    //重新導向回到主畫面
    header('location: ../service.php');

?>