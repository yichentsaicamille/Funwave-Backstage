<?php
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<!doctype html>
<html lang="en">

<head>
    <title>Sign Up</title>
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
            top: 33px !important;
            right: 10px !important;
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <header class="header shadow-sm">
            <div class="container-fluid d-flex justify-content-between">
                <a class="logo-text" href="./index.php"><img class="logo" src="./images/logo.png" alt="">Fun浪</a>
                <ul class="d-flex list-unstyled home-main">
                    <li><a class="<?php
                        if (($activePage === 'log-in')) {
                            echo "active";
                        } else {
                            echo "";
                        }
                        ?>" href="./log-in.php">登入</a></li>
                    <li><a class="<?php
                        if (($activePage === 'sign-up')) {
                            echo "active";
                        } else {
                            echo "";
                        }
                        ?>" href="./sign-up.php">註冊</a></li>
                </ul>
            </div>
        </header>
        <!--menu-->
        <div class="row d-flex">
            <!-- <aside class="col-lg-2 navbar-side shadow-sm">
                    <?php require_once("./public/nav.php") ?>
                </aside> -->
            <div class="sign-up-content col-lg-4 shadow-sm p-5">
                <form id="form" action="./method/doSignup.php" method="post">
                    <h1 class="text-center">會員註冊</h1>
                    <div class="mb-3">
                        <label for="name">姓名*</label>
                        <input id="name" type="text" name="member_name" class="form-control" required
                               placeholder="請輸入姓名">
                        <div id="nameError" class="text-danger mb-2"></div>
                    </div>
                    <div class="mb-3">
                        <label for="gender">性別*</label>
                        <div class="form-check form-check-inline ms-2">
                            <input class="form-check-input" type="radio" name="member_gender" id="gender" value="男">
                            <label class="form-check-label" for="gender">男生</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="member_gender" id="gender" value="女">
                            <label class="form-check-label" for="gender">女生</label>
                        </div>
                        <div id="genderError" class="text-danger mb-2"></div>
                    </div>
                    <div class="mb-3">
                        <label for="account">帳號*</label>
                        <input id="account" type="text" name="member_account" class="form-control"
                               placeholder="請輸入 3~12 個字元的帳號">
                        <div id="accountError" class="text-danger mb-2"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email">email*</label>
                        <input id="email" type="text" name="member_email" class="form-control" required
                               placeholder="請輸入信箱">
                        <div id="emailError" class="text-danger mb-2"></div>
                    </div>
                    <div class="mb-3 password-ipt">
                        <label for="password">密碼*</label>
                        <input id="password" type="password" name="member_password" class="form-control" required
                               placeholder="請輸入密碼"><label class="password-img"><img src="./images/eyes-close.png" alt="JS實現表單中點選小眼睛顯示隱藏密碼框中的密碼"
                                                               id="eyes"></label>
                        <div id="passwordError" class="text-danger"></div>
                    </div>
                    <div class="mb-3 password-ipt">
                        <label for="repassword">確認密碼*</label>
                        <input id="repassword" type="password" name="repassword" class="form-control" required
                               placeholder="請再次輸入密碼"><label class="password-img"><img src="./images/eyes-close.png" alt="JS實現表單中點選小眼睛顯示隱藏密碼框中的密碼"
                                                                 id="eye"></label>
                        <div id="repasswordError" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="phone">電話*</label>
                        <input id="phone" type="text" name="member_phone" class="form-control" required
                               placeholder="請輸入手機號碼">
                        <div id="phoneError" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="address">住址</label>
                        <input id="address" type="text" name="member_address" class="form-control" placeholder="請輸入住址">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" onclick="javascript:return signup();" id="submitBtn"
                                type="submit">送出
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let form = document.querySelector("#form");
    let submitBtn = document.querySelector("#submitBtn");
    let name = document.querySelector("#name");
    let account = document.querySelector("#account");
    let password = document.querySelector("#password");
    let repassword = document.querySelector("#repassword");
    let email = document.querySelector("#email");
    let phone = document.querySelector("#phone");
    let nameError = document.querySelector("#nameError");
    let accountError = document.querySelector("#accountError");
    let emailError = document.querySelector("#emailError");
    let passwordError = document.querySelector("#passwordError");
    let repasswordError = document.querySelector("#repasswordError");
    let phoneError = document.querySelector("#phoneError");

    const regEmail = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;

    
    submitBtn.addEventListener("click", function (e) {
        e.preventDefault();
        let accountExist = true;
        nameError.innerText = accountError.innerText = emailError.innerText = passwordError.innerText = repasswordError.innerText = phoneError.innerText = " "; //初始值都是空白
        if (name.value === "") {
            nameError.innerText = "姓名不能空白";
        }
        if (account.value === "") {
            accountError.innerText = "帳號不能空白";
        }
        if (account.value.length < 3 || account.value.length > 12) {
            accountError.innerText = "帳號長度不符";
        }
        if (email.value === "") {
            emailError.innerText = "信箱不能空白";
        }
        if (!regEmail.test(email.value)) {
            emailError.innerText = "格式錯誤";
        }
        if (password.value === "") {
            passwordError.innerText = "密碼不能空白";
        }
        if (repassword.value === "") {
            repasswordError.innerText = "密碼不能空白";
        }
        if (phone.value === "") {
            phoneError.innerText = "電話不能空白";
        }

        if (accountExist && nameError.innerText === "" && accountError.innerText === "" && emailError.innerText === "" && passwordError.innerText === "" && repasswordError.innerText === "" && phoneError.innerText === "") {

            form.submit();

        }
    })

    if (form.submit) {
        function signup() {
            var msg = "註冊會員成功！";
            if (alert(msg) == true) {
                window.location.replace("./log-in.php");
                return true;
            } else {
                return false;
            }
        }
    }

    var input = document.querySelector('#password')
    var imgs = document.getElementById('eyes');
    //下面是一個判斷每次點選的效果
    var flag = 0;
    imgs.onclick = function () {
        if (flag == 0) {
            input.type = 'password';
            eyes.src = './images/eyes-close.png';
            flag = 1;
        } else {
            input.type = 'text';
            eyes.src = './images/eyes-open.png';
            flag = 0;
        }
    }

    var watch = document.querySelector('#repassword')
    var img = document.getElementById('eye');
    //下面是一個判斷每次點選的效果
    var flag = 0;
    img.onclick = function () {
        if (flag == 0) {
            watch.type = 'password';
            eye.src = './images/eyes-close.png'; //閉眼圖
            flag = 1;
        } else {
            watch.type = 'text';
            eye.src = './images/eyes-open.png'; //睜眼圖
            flag = 0;
        }
    }
</script>
</body>

</html>