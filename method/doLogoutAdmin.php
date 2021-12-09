<?php
session_start();
unset($_SESSION["admin"]);
header("location: ../log-in-admin.php");
?>