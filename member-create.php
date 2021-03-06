<?php
require_once("./method/pdo-connect.php");
require_once("./public/admin-if-login.php");
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
        <?php require_once("./public/admin-header-logined.php"); ?>
        <!--menu-->
        <aside class="col-lg-2 navbar-side shadow-sm">
            <?php require_once("./public/nav.php") ?>
        </aside>
        <!--/menu-->
        <div class="col-9 d-flex justify-content-between align-items-center button-group shadow-sm">
            <div class="">
                <a role="button" href="./member-list.php" class="btn btn-primary">θΏε</a>
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
                        <label for="photo" class="form-label">η§η</label>
                        <input type="file" class="form-control" id="inputGroupFile02" name="member_photo">
                    </div>
                    <div class="col-md-5">
                        <label for="name" class="form-label">ε§ε</label>
                        <input type="text" class="form-control" id="name" name="member_name" placeholder="θ«θΌΈε₯ε§ε">
                    </div>
                    <div class="col-md-5">
                        <label for="gender" class="form-label">ζ§ε₯</label>
                        <select id="gender" name="member_gender" class="form-select"
                                aria-label="Default select example">
                            <option selected>θ«ιΈζζ§ε₯</option>
                            <option value="η·">η·η</option>
                            <option value="ε₯³">ε₯³η</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="phone" class="form-label">ι»θ©±</label>
                        <input type="text" class="form-control" id="phone" name="member_phone" placeholder="θ«θΌΈε₯ι»θ©±">
                    </div>
                    <div class="col-md-5">
                        <label for="email" class="form-label">δΏ‘η?±</label>
                        <input type="email" class="form-control" id="email" name="member_email" placeholder="θ«θΌΈε₯email">
                    </div>
                    <div class="col-md-5">
                        <label for="account" class="form-label">εΈ³θ</label>
                        <input type="text" class="form-control" id="account" name="member_account" placeholder="θ«θΌΈε₯εΈ³θ">
                    </div>
                    <div class="col-md-5 password-ipt">
                        <label for="password" class="form-label">ε―η’Ό</label>
                        <input type="password" class="form-control" id="password" name="member_password"
                               placeholder="θ«θΌΈε₯ε―η’Ό"><label class="password-img"><img src="./images/eyes-close.png" alt="JSε―¦ηΎθ‘¨ε?δΈ­ι»ιΈε°ηΌηι‘―η€Ίι±θε―η’Όζ‘δΈ­ηε―η’Ό"
                                                               id="eyes"></label>
                    </div>
                    <div class="col-10">
                        <label for="address" class="form-label">ε°ε</label>
                        <input type="text" class="form-control" id="address" name="member_address" placeholder="θ«θΌΈε₯ε°ε">
                    </div>
                    <div class="col-10 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">ιεΊ</button>
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

    //η²εεη΄ οΌε©η¨?ζΉεΌι½ε―δ»₯οΌ
    var watch = document.querySelector('#password')
    var imgs = document.getElementById('eyes');
    //δΈι’ζ―δΈεε€ζ·ζ―ζ¬‘ι»ιΈηζζ
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