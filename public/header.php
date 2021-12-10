<?php
// require_once("../method/pdo-connect.php");
// if (!isset($_SESSION["member"])) { //判斷使用者沒登入成功導回sign-in.php畫面
//     header("location: ../sign-in.php");
// }
require_once("./method/pdo-connect.php");
$sqlMember = "SELECT * FROM member WHERE member_valid=1";
$stmtMember = $db_host->prepare($sqlMember);

try {
    $stmtMember->execute([]);
    $rowMember = $stmtMember->fetchAll(PDO::FETCH_ASSOC);
    $memberExist = $stmtMember->rowCount();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<header class="container-fluid header shadow-sm">
    <div class="">
        <a class="logo-text" href="#"><img class="logo" src="images/logo.png" alt="">Fun浪</a>
        <!--    1208修改後要復原    -->
<!--        <div class="d-flex justify-content-end">-->
<!--            <div>Hi, --><?//= $_SESSION["member"]["member_name"] ?><!--&nbsp;<a href="./method/doLogout.php"-->
<!--                                                                       class="btn btn-info text-white">登出</a></div>-->
<!--        </div>-->
    </div>
</header>