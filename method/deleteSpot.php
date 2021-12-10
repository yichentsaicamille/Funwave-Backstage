<?php
require_once("pdo-connect.php");

$spot_code=$_GET["spot_code"];

$sql_query="DELETE FROM spot_list WHERE spot_code=?";
$stmt=$db_host -> prepare($sql_query);
$stmt->execute([$spot_code]);

header('location: ../spot-list.php');

?>