<?php 
require_once("method/pdo-connect.php");
require_once("./public/admin-if-login.php");
?>
<!doctype html>
<html lang="en">
<head>
    <title>Create Product</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>

    <style>
        /* .mybutton{
            width: 300px;
            height: 48px;
            font-size: 13pt;
            font-weight: bold;
            text-align: center;
            
        } */
        .javapic{
            max-width: 400px;
            margin: 20px;
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
                <a role="button" href="product-list.php" class="btn btn-primary">返回商品總覽</a>
            </div>
        </div>
        <article class="article col-9 shadow-sm"> <!--content-->
            <div>
                <form class="row g-3 mt-5 pb-5 d-flex justify-content-center" action="./method/doInsert-product.php" method="post">
    
                    <div class="col-md-5 mb-3">
                        <label for="name" class="form-label">商品名稱</label>
                        <input type="text" class="form-control" id="name" name="product_name" placeholder="請輸入商品名稱" required>
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="item" class="form-label">貨號</label>
                        <input type="text" class="form-control" id="item" name="product_item" placeholder="請輸入貨號" required>
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="bigcat" class="form-label">大分類</label>
                        <select id="bigcat" name="big_cat_id" class="form-select" required aria-label="select example">
                            <option selected>請選擇大分類</option>
                            <option value="1">衝浪板</option>
                            <option value="2">衝浪板配件</option>
                            <option value="3">海灘配件</option>
                        </select>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="smallcat" class="form-label">小分類</label>
                        <select id="smallcat" name="small_cat_id" class="form-select" required aria-label="select example">
                            <option selected>請選擇小分類</option>
                            <option value="1">長板</option>
                            <option value="2">短板</option>
                            <option value="3">快樂版</option>
                            <option value="4">衝浪板舵</option>
                            <option value="5">衝浪腳繩</option>
                            <option value="6">防滑墊</option>
                            <option value="7">衝浪板袋</option>
                            <option value="8">衝浪T</option>
                            <option value="9">帽子</option>
                        </select>
                    </div>

                     
                    <div class="col-md-10">
                        <label for="productimage" class="form-label">商品圖片</label>
                        <input type="file" class="form-control" id="productimage" name="product_image" required>
                    </div>
                    <div class="col-md-10 d-flex justify-content-center align-items-center mb-3">
                        <div> 
                            <img id="preview-image" class="javapic cover-fit d-none" src="">
                        </div>
                    </div> 

                    <div class="col-md-5 mb-3">
                        <label for="color" class="form-label">顏色</label>
                        <select id="color" name="color_id" class="form-select" required aria-label="select example">
                            <option selected>請選擇顏色</option>
                            <option value="1">紅色</option>
                            <option value="2">橙色</option>
                            <option value="3">黃色</option>
                            <option value="4">綠色</option>
                            <option value="5">藍色</option>
                            <option value="6">紫色</option>
                            <option value="7">灰色</option>
                            <option value="8">黑色</option>
                            <option value="9">白色</option>
                        </select>
                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="size" class="form-label">尺寸</label>
                        <input type="text" class="form-control" id="size" name="product_size" placeholder="請輸入尺寸" required>
                    </div>

                    <div class="col-md-10 mb-3">
                        <label for="describe" class="form-label">商品描述</label>
                        <div class="">
                            <textarea class="form-control" id="describe" name="product_describe" placeholder="請輸入描述文字" rows="3"></textarea>
                        </div>
                     </div>

                    <div class="col-md-5 mb-3">
                        <label for="price" class="form-label">定價</label>
                        <input type="text" class="form-control" id="price" name="product_price" placeholder="請輸入定價" required>
                    </div>
                    
                    <div class="col-md-5 mb-3">
                        <label for="stock" class="form-label">庫存量</label>
                        <input type="text" class="form-control" id="stock" name="product_stock" placeholder="請輸入庫存量" required>
                    </div>
                    
                    <!-- <div class="col-10 mb-2">
                            <hr size="3px" width="100%">
                    </div> -->
                    
                    <div class="col-10 d-flex justify-content-end">
                        <button type="submit" class="mybutton btn btn-primary">送出</button>
                    </div>

                </form>
            </div>

        </article> <!--/content-->
    </div>
</div>

<script>
    var avatar = document.getElementsByName("product_image")[0]
    var previewAvatar = document.getElementById("preview-image")
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
