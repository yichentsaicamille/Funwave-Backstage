<?php
session_start();
unset($_SESSION["member"]);
header("location: ../log-in.php");
?>