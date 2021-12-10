<?php 
require_once("./method/pdo-connect.php");
require_once("./public/admin-if-login.php");
?>
<!doctype html>
<html lang="en">
<head>
    <title>新增教練</title>
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
        <?php require_once("./public/admin-header-logined.php") ?>
        <!--menu-->
        <aside class="col-lg-2 navbar-side shadow-sm">
            <?php require_once("./public/nav.php") ?>
        </aside>
        <!--/menu-->
        <div class="col-9 d-flex justify-content-between align-items-center button-group shadow-sm">
            <div>
                <a role="button" href="coach.php" class="btn btn-primary">返回</a>
            </div>
        </div>
        <article class="article col-9 shadow-sm"> <!--content-->
            <div>
                <form id="form" class="row g-3 mt-5 pb-5 d-flex justify-content-center" action="./method/addCoach.php" method="post">
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <div>
                            <img id="preview-photo" class="photo-img cover-fit d-none" src="">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="photo" class="form-label">照片</label>
                        <input type="file" class="form-control" id="photo" name="coach_photo">
                    </div>
                    <div class="col-md-5">
                        <label for="name" class="form-label">姓名</label>
                        <input type="text" class="form-control" id="name" name="coach_name" placeholder="請輸入姓名" required>
                        <div id="nameError" class="text-danger mb-2"></div>
                    </div>
                    <div class="col-md-5">
                        <label for="gender" class="form-label">性別</label>
                        <select id="gender" name="genre_id" class="form-select" required aria-label="select example">
                            <option selected>請選擇性別</option>
                            <option value="1">男生</option>
                            <option value="2">女生</option>
                        </select>
                        <div id="genderError" class="text-danger mb-2"></div>
                    </div>
                    <div class="col-md-5">
                        <label for="phone" class="form-label">電話</label>
                        <input type="text" class="form-control" id="phone" name="coach_phone" placeholder="請輸入電話" required>
                        <div id="phoneError" class="text-danger"></div>
                    </div>
                    <div class="col-md-5">
                        <label for="email" class="form-label">信箱</label>
                        <input type="email" class="form-control" id="email" name="coach_email" placeholder="請輸入email" required>
                        <div id="emailError" class="text-danger mb-2"></div>
                    </div>
                    <div class="col-md-5">
                        <label for="account" class="form-label">帳號</label>
                        <input type="text" class="form-control" id="account" name="coach_account" placeholder="請輸入帳號" required>
                        <div id="accountError" class="text-danger mb-2"></div>
                    </div>
                    <div class="col-md-5 password-ipt">
                        <label for="password" class="form-label">密碼</label>
                        <input type="password" class="form-control show-on" id="password" name="coach_password"
                               placeholder="請輸入密碼" id="eyes" required>
                        <label class="password-img"><img src="./images/eyes-open.png" id="eyes"></label>
                        <div id="passwordError" class="text-danger"></div>
                    </div>
                    <div class="col-10">
                        <label for="address" class="form-label">專長</label>
                        <input type="text" class="form-control" id="address" name="coach_expertise" placeholder="請輸入地址">
                    </div>
                    <div class="col-10">
                        <label for="address" class="form-label">地址</label>
                        <input type="text" class="form-control" id="address" name="coach_address" placeholder="請輸入地址">
                    </div>
                    <div class="col-10 d-flex justify-content-end">
                        <button id="submitBtn" type="submit" class="btn btn-primary">送出</button>
                    </div>
                </form>
            </div>

        </article> <!--/content-->
    </div>
</div>

<script>
    var avatar = document.getElementsByName("coach_photo")[0]
    var previewAvatar = document.getElementById("preview-photo")
    avatar.onchange = () => {
        var file = avatar.files[0]
        if (file) {
            previewAvatar.src = URL.createObjectURL(file)
            previewAvatar.classList.remove('d-none')
        }
    }

    let watch = document.querySelector('.show-on')
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

    // let form = document.querySelector("#form"), submitBtn = document.querySelector("#submitBtn"), name = document.querySelector("#name"), account = document.querySelector("#account"), password = document.querySelector("#password"), email = document.querySelector("#email"), phone = document.querySelector("#phone"), nameError = document.querySelector("#nameError"), accountError = document.querySelector("#accountError"), emailError = document.querySelector("#emailError"), passwordError = document.querySelector("#passwordError"), phoneError = document.querySelector("#phoneError");
    //
    // const regEmail = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    //
    // submitBtn.addEventListener("click", function(e) {
    //     e.preventDefault();
    //     let accountExist = true;
    //     nameError.innerText = accountError.innerText = emailError.innerText = passwordError.innerText = repasswordError.innerText = phoneError.innerText = " "; //初始值都是空白
    //     if (name.value === "") {
    //         nameError.innerText = "姓名不能空白";
    //     }
    //     if (account.value === "") {
    //         accountError.innerText = "帳號不能空白";
    //     }
    //     if (account.value.length < 3 || account.value.length > 12) {
    //         accountError.innerText = "帳號長度不符";
    //     }
    //     if (email.value === "") {
    //         emailError.innerText = "信箱不能空白";
    //     }
    //     if (!regEmail.test(email.value)) {
    //         emailError.innerText = "格式錯誤";
    //     }
    //     if (password.value === "") {
    //         passwordError.innerText = "密碼不能空白";
    //     }
    //     if (repassword.value === "") {
    //         repasswordError.innerText = "密碼不能空白";
    //     }
    //     if (phone.value === "") {
    //         phoneError.innerText = "電話不能空白";
    //     }
    //
    //     if (accountExist && nameError.innerText === "" && accountError.innerText === "" && emailError.innerText === "" && passwordError.innerText === "" && repasswordError.innerText === "" && phoneError.innerText === "") {
    //         form.submit();
    //     }
    //
    // })
</script>
</body>
</html>
