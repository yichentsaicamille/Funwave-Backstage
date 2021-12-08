<?php
if (!isset($_SESSION["member"])) { //判斷使用者沒登入成功導回log-in.php畫面
    header("location: ./log-in.php");
}
?>