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
    <title>Member Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>
    <style>
        .password-ipt {
            position: relative;
        }
        .password-img img {
            height: 20px;
            position: absolute;
            top: 42px !important;
            right: 15px !important;
        }
    </style>
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
        <div class="col-lg-9 button-group shadow-sm">
            <div class="d-flex justify-content-between align-items-center mt-3">
                <a role="button" href="member-list.php" class="btn btn-primary">返回</a>
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
                                    <img id="preview-photo" class="show-photo cover-fit d-none" src="">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="photo" class="form-label">照片</label>
                                <input type="file" class="form-control" id="inputGroupFile02" name="member_photo">
                            </div>
                            <div class="col-md-5">
                                <label for="name" class="form-label">姓名</label>
                                <input type="text" class="form-control" id="name" name="member_name"
                                       placeholder="<?= $value["member_name"] ?>">
                            </div>
                            <div class="col-md-5">
                                <label for="gender" class="form-label">性別</label>
                                <select id="gender" name="member_gender" class="form-select"
                                        aria-label="Default select example">
                                    <option selected>請選擇性別</option>
                                    <option value="男">男生</option>
                                    <option value="女">女生</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="phone" class="form-label">電話</label>
                                <input type="text" class="form-control" id="phone" name="member_phone"
                                       placeholder="0<?= $value["member_phone"] ?>">
                            </div>
                            <div class="col-md-5">
                                <label for="email" class="form-label">信箱</label>
                                <input type="email" class="form-control" id="email" name="member_email"
                                       placeholder="<?= $value["member_email"] ?>">
                            </div>
                            <div class="col-md-5">
                                <label for="account" class="form-label">帳號</label>
                                <input type="text" class="form-control-plaintext" id="account" name="member_account"
                                       placeholder="<?= $value["member_account"] ?>" readonly>
                            </div>
                            <div class="col-md-5 password-ipt">
                                <label for="password" class="form-label">密碼</label>
                                <input type="password" class="form-control" id="password" name="member_password"
                                       placeholder="請輸入密碼"><label class="password-img"><img src="./images/eyes-open.png"
                                                                       alt="JS實現表單中點選小眼睛顯示隱藏密碼框中的密碼" id="eyes"></label>
                            </div>
                            <div class="col-10">
                                <label for="address" class="form-label">地址</label>
                                <input type="text" class="form-control" id="address" name="member_address"
                                       placeholder="<?= $value["member_address"] ?>">
                            </div>
                            <div class="col-10 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">儲存</button>
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

<script>
    var avatar = document.getElementsByName("member_photo")[0]
    var previewAvatar = document.getElementById("preview-photo")
    avatar.onchange = () => {
        var file = avatar.files[0]
        if (file) {
            previewAvatar.src = URL.createObjectURL(file)
            previewAvatar.classList.remove('d-none')
        }
    }
    //獲取元素（兩種方式都可以）
    var watch = document.querySelector('#password')
    var imgs = document.getElementById('eyes');
    //下面是一個判斷每次點選的效果
    var flag = 0;
    imgs.onclick = function () {
        if (flag == 0) {
            watch.type = 'password';
            eyes.src = './images/eyes-close.png';
            flag = 1;
        } else {
            watch.type = 'text';
            eyes.src = './images/eyes-open.png';
            flag = 0;
        }
    }
</script>

</html>