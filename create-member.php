<?php
require_once("./method/pdo-connect.php");
require_once("./public/if-login.php");
?>

<!doctype html>
<html lang="en">

<head>
    <title>Create Member</title>
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
        <div class="col-9 d-flex justify-content-between align-items-center button-group shadow-sm">
            <div class="">
                <a role="button" href="./member-list.php" class="btn btn-primary">返回</a>
            </div>
        </div>
        <article class="article col-9 shadow-sm">
            <!--content-->
            <div>
                <form class="row g-3 mt-5 pb-5 d-flex justify-content-center" action="./method/doInsertMember.php"
                      method="post">
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
                        <input type="text" class="form-control" id="name" name="member_name" placeholder="請輸入姓名">
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
                        <input type="text" class="form-control" id="phone" name="member_phone" placeholder="請輸入電話">
                    </div>
                    <div class="col-md-5">
                        <label for="email" class="form-label">信箱</label>
                        <input type="email" class="form-control" id="email" name="member_email" placeholder="請輸入email">
                    </div>
                    <div class="col-md-5">
                        <label for="account" class="form-label">帳號</label>
                        <input type="text" class="form-control" id="account" name="member_account" placeholder="請輸入帳號">
                    </div>
                    <div class="col-md-5 password-ipt">
                        <label for="password" class="form-label">密碼</label>
                        <input type="password" class="form-control" id="password" name="member_password"
                               placeholder="請輸入密碼"><label class="password-img"><img src="./images/eyes-close.png" alt="JS實現表單中點選小眼睛顯示隱藏密碼框中的密碼"
                                                               id="eyes"></label>
                    </div>
                    <div class="col-10">
                        <label for="address" class="form-label">地址</label>
                        <input type="text" class="form-control" id="address" name="member_address" placeholder="請輸入地址">
                    </div>
                    <div class="col-10 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">送出</button>
                    </div>
                </form>
            </div>
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