<!doctype html>
<html lang="en">
<head>
    <title>information</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>


</head>
<body>
<div class="container-fluid">
    <div class="row wrap d-flex ">
        <?php require_once("./public/header.php") ?>
        <aside class="col-lg-2 navbar-side shadow-sm">
            <?php require_once("./public/nav.php") ?>
        </aside>
        <div class="col-9 d-flex align-items-center button-group shadow-sm">
            <div class="d-flex">
                <a class="btn btn-primary me-4" href="info-list.php">返回</a>
            </div>
        </div>
        <article class="article col-9 shadow-sm">
            <div>
                <form action="./method/infoInsert.php" class="row g-3 mt-5 pb-5 d-flex justify-content-center" method="post">
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <div>
                            <img id="preview-photo" class="photo-img cover-fit d-none" src=" ">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="photo" class="form-label">照片</label>
                        <div class="d-flex align-items-center">
                            <input type="file" class="form-control"  name="info_image" id="photo">
                        </div>
                    </div>
                    <div class="col-md-10 py-3">
                        <label>類型
                            <input type="text" style="margin-top: 0.5rem" class="form-control mb-3" name="info_category">
                        </label>
                        <br>
                        <label class="form-label">標題</label>
                        <input type="text" class="form-control mb-3" name="info_title">
                        <label for="exampleFormControlTextarea1" class="form-label">內容</label>
                        <textarea class="form-control" name="info_content" rows="20"></textarea>
                    </div>
                    <div class="col-md-10 d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">送出</button>
                    </div>
                </form>
            </div>
        </article>

    </div>
</div>
<script>
    var avatar = document.getElementsByName("info_image")[0]
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
