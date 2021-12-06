<!doctype html>
<html lang="en">
<head>
    <title>新增教練</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>

</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php require_once("./public/header.php") ?>
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
                <form class="row g-3 mt-5 pb-5 d-flex justify-content-center" action="./method/addCoach.php" method="post">
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
                        <input type="text" class="form-control" id="name" name="coach_name" placeholder="請輸入姓名">
                    </div>
                    <div class="col-md-5">
                        <label for="gender" class="form-label">性別</label>
                        <select id="gender" name="genre_id" class="form-select" aria-label="Default select example">
                            <option selected>請選擇性別</option>
                            <option value="1">男生</option>
                            <option value="2">女生</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="phone" class="form-label">電話</label>
                        <input type="text" class="form-control" id="phone" name="coach_phone" placeholder="請輸入電話">
                    </div>
                    <div class="col-md-5">
                        <label for="email" class="form-label">信箱</label>
                        <input type="email" class="form-control" id="email" name="coach_email" placeholder="請輸入email">
                    </div>
                    <div class="col-md-5">
                        <label for="account" class="form-label">帳號</label>
                        <input type="text" class="form-control" id="account" name="coach_account" placeholder="請輸入帳號">
                    </div>
                    <div class="col-md-5">
                        <label for="password" class="form-label">密碼</label>
                        <input type="password" class="form-control" id="password" name="coach_password"
                               placeholder="請輸入密碼">
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
                        <button type="submit" class="btn btn-primary">送出</button>
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
</script>
</body>
</html>
