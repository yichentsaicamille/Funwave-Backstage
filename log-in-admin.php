<?php
$activePage = basename($_SERVER['PHP_SELF'], ".php");
session_start();
if (isset($_SESSION["admin"])) {
    header("location: ./member-list.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Admin Log In</title>
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
                            ?>" href="./log-in-admin.php">登入</a></li>
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
                    <form id="form" action="./method/doLoginAdmin.php" method="post">
                        <h1 class="text-center">會員登入</h1>
                        <div class="mb-3">
                            <label for="account">帳號</label>
                            <input id="account" type="text" name="admin_account" class="form-control" placeholder="請輸入 3~12 個字元的帳號">
                            <div id="accountError" class="text-danger mb-2"></div>
                        </div>
                        
                        <div class="mb-3 password-ipt">
                            <label for="password">密碼</label>
                            <input id="password" type="password" name="admin_password" class="form-control show-on" required placeholder="請輸入密碼"><label class="password-img"><img src="./images/eyes-close.png" alt="JS實現表單中點選小眼睛顯示隱藏密碼框中的密碼" id="eyes"></label>
                            <div id="passwordError" class="text-danger"></div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" id="submitBtn" type="submit">登入</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        let form = document.querySelector("#form");
        let submitBtn = document.querySelector("#submitBtn");
        let account = document.querySelector("#account");
        let password = document.querySelector("#password");
        let accountError = document.querySelector("#accountError");
        let passwordError = document.querySelector("#passwordError");

        submitBtn.addEventListener("click", function(e) {
            e.preventDefault();
            let accountExist = true;
            accountError.innerText = passwordError.innerText = " "; //初始值都是空白
            if (account.value === "") {
                accountError.innerText = "帳號不能空白";
            }
            if (account.value.length < 3 || account.value.length > 12) {
                accountError.innerText = "帳號長度不符";
            }
            if (password.value === "") {
                passwordError.innerText = "密碼不能空白";
            }

            if (accountExist && accountError.innerText === "" && passwordError.innerText === "") {
                form.submit();
            }

        })

        let watch = document.querySelector('#password')
        let imgs = document.getElementById('eyes');
        //下面是一個判斷每次點選的效果
        let flag = 0;
        imgs.onclick = function() {
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
</body>

</html>