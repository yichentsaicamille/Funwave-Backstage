<?php
require_once("./method/pdo-connect.php");
require_once("./public/admin-if-login.php");
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
            <?php require_once("./public/admin-header-logined.php"); ?>
            <!--menu-->
            <aside class="col-lg-2 navbar-side shadow-sm">
                <?php require_once("./public/nav.php") ?>
            </aside>
            <!--/menu-->
            <div class="col-lg-9 button-group shadow-sm">
                <div class="d-flex align-items-center mt-3">
                    <a role="button" href="./member-list.php" class="btn btn-primary">返回</a>
                </div>
            </div>
            <article class="article col-9 shadow-sm">
            <?php if ($memberExist > 0) : ?>
                <!--content-->
                <div>
                    <?php foreach ($rowMember as $value) : ?>
                        <form class="row g-3 mt-5 pb-5 d-flex justify-content-center"
                              action="./method/doUpdateMember.php" method="post">
                            <input type="hidden" name="member_id" value="<?= $value["member_id"] ?>">
                            <div class="col-md-5 d-flex justify-content-center align-items-center">
                                <div>
                                    <img id="preview-photo" class="show-photo cover-fit" src="./images/member/<?= $value["member_photo"] ?>">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="photo" class="form-label d-none">照片</label>
                                <input type="file" class="form-control d-none" id="inputGroupFile02" name="member_photo">
                            </div>
                            <div class="col-md-5">
                                <label for="name" class="form-label">姓名</label>
                                <input type="text" class="form-control" id="name" name="member_name"
                                       placeholder="<?= $value["member_name"] ?>" readonly>
                            </div>
                            <div class="col-md-5">
                                <label for="gender" class="form-label">性別</label>
                                <select id="gender" name="member_gender" class="form-select"
                                        aria-label="Default select example" disabled>
                                    <option selected><?=$value["member_gender"] ?></option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="phone" class="form-label">電話</label>
                                <input type="text" class="form-control" id="phone" name="member_phone"
                                       placeholder="<?= $value["member_phone"] ?>" readonly>
                            </div>
                            <div class="col-md-5">
                                <label for="email" class="form-label">信箱</label>
                                <input type="email" class="form-control" id="email" name="member_email"
                                       placeholder="<?= $value["member_email"] ?>" readonly>
                            </div>
                            <div class="col-md-5">
                                <label for="account" class="form-label">帳號</label>
                                <input type="text" class="form-control" id="account" name="member_account"
                                       placeholder="<?= $value["member_account"] ?>" readonly>
                            </div>
                            <div class="col-md-5 password-ipt">
                                <label for="password" class="form-label">密碼</label>
                                <input type="password" class="form-control" id="password" name="member_password"
                                       placeholder="請輸入密碼" value="<?= $value["member_password"] ?>" readonly>
                            </div>
                            <div class="col-10">
                                <label for="address" class="form-label">地址</label>
                                <input type="text" class="form-control" id="address" name="member_address"
                                       placeholder="<?= $value["member_address"] ?>" readonly>
                            </div>
                        </form>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                使用者不存在
            <?php endif ?>
        </article>
        </div>
    </div>
</body>

</html>