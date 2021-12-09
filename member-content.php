<?php
require_once("./method/pdo-connect.php");
require_once("./public/if-login.php");
$member_id = $_GET["member_id"];
$sqlMember = "SELECT * FROM member WHERE member_id=?";
$stmtMember = $db_host->prepare($sqlMember);

try {
    $stmtMember->execute([$member_id]);
    $rowMember = $stmtMember->fetchAll(PDO::FETCH_ASSOC);
    $memberExist = $stmtMember->rowCount();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Member Content</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php require_once("./public/header-logined.php"); ?>
            <!--menu-->
            <aside class="col-lg-2 navbar-side shadow-sm">
                <?php require_once("./public/nav.php") ?>
            </aside>
            <!--/menu-->
            <div class="col-lg-9 button-group">
                <div class="d-flex justify-content-end align-items-center mt-3">
                    <a role="button" href="./member-list.php" class="btn btn-primary">返回</a>
                </div>
                <article class="article col-lg-9 mt-5">
                    <?php if ($memberExist > 0) : ?>
                        <table class="table table-bordered table-sm">
                            <?php foreach ($rowMember as $value) : ?>
                                <tr>
                                    <th>頭像</th>
                                    <td><img class="content-img" src="./images/member/<?= $value["member_photo"] ?>"></td>
                                </tr>
                                <tr>
                                    <th>姓名</th>
                                    <td><?= $value["member_name"] ?></td>
                                </tr>
                                <tr>
                                    <th>性別</th>
                                    <td><?= $value["member_gender"] ?></td>
                                </tr>
                                <tr>
                                    <th>電話</th>
                                    <td><?= $value["member_phone"] ?></td>
                                </tr>
                                <tr>
                                    <th>信箱</th>
                                    <td><?= $value["member_email"] ?></td>
                                </tr>
                                <tr>
                                    <th>地址</th>
                                    <td><?= $value["member_address"] ?></td>
                                </tr>
                        </table>
                    <?php endforeach; ?>
                <?php else : ?>
                    使用者不存在
                <?php endif ?>
                </article>
            </div>
        </div>
    </div>
</body>

</html>