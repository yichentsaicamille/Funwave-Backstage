<?php
if(isset($_GET["id"])){
    $product_id=$_GET["id"];
}else{
    $product_id=0;
}

require_once ("./method/pdo-connect.php");
require_once("./public/admin-if-login.php");
$sql="SELECT * FROM(
    (products INNER JOIN big_cats 
    ON products.big_cat_id = big_cats.big_cat_id
    )
INNER JOIN small_cats
ON products.small_cat_id = small_cats.small_cat_id
)
INNER JOIN colors 
ON products.color_id = colors.color_id  WHERE product_id='$product_id'";

$stmt = $db_host->prepare($sql);
$num_rows = $stmt->fetchColumn();

try {
    $stmt->execute();
    $row = $stmt->fetch();
    // $rows = $stmt->fetchAll();
    // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $e){
    echo $e->getMessage();
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Product Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>

    <style>
        .des{
            height: 300px;
            word-break:break-word; word-wrap:break-word;
            overflow: auto;
        }
        .pic{
            max-width: 390px;
            max-height: 390px;
        }
        .picout{
            border: 1px solid #cccc;
            width: 82%;
            max-height: 400px;
            min-height: 400px;
            margin: 0px;
        }

        .desc{
            height: 300px;
            word-break:break-word; word-wrap:break-word;
            overflow: auto;
        }
        /* .mybutton{
            width: 300px;
            height: 48px;
            font-size: 13pt;
            font-weight: bold;
            text-align: center;
            margin-left: 120px;
            margin-top: 30px;            
        } */
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
                <a role="button" href="product-list.php" class="btn btn-primary">??????????????????</a>
            </div>
        </div>

        <article class="article col-9 shadow-sm"> <!--content-->
            <div>
                <?php if($num_rows===0): ?>
                    ???????????????
                <?php else:
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <form class="row g-3 mt-5 pb-5 d-flex justify-content-center" action="./method/doUpdate-product.php" method="post">

                        <input type="hidden" name="product_id" value="<?=$row["product_id"]?>">
                        
                        <div class="col-md-5 mb-3">
                            <label for="name" class="form-label">????????????</label>
                            <input type="text" class="form-control" id="name" name="product_name" value="<?=$row["product_name"]?>" placeholder="?????????????????????" required>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="item" class="form-label">??????</label>
                            <input type="text" class="form-control" id="item" name="product_item" value="<?=$row["product_item"]?>" placeholder="???????????????" required>
                        </div>

                        <div class="col-md-5 mb-3">
                                <div class="mb-2">?????????</div>
                                <select class="form-select" aria-label="bigcatSelect" name="big_cat_id" id="bigcat">
                                    <option value="1" <?php if ($row["big_cat"]==="?????????")echo "selected" ?>>?????????</option>
                                    <option value="2" <?php if ($row["big_cat"]==="???????????????")echo "selected" ?>>???????????????</option>
                                    <option value="3" <?php if ($row["big_cat"]==="????????????")echo "selected" ?>>????????????</option>
                                </select>
                        </div>

                        <div class="col-md-5 mb-3">
                                <div class="mb-2">?????????</div>
                                <select class="form-select" aria-label="smallcatSelect" name="small_cat_id" id="smallcat">
                                    <option value="1" <?php if ($row["small_cat"]==="??????")echo "selected" ?>>??????</option>
                                    <option value="2" <?php if ($row["small_cat"]==="??????")echo "selected" ?>>??????</option>
                                    <option value="3" <?php if ($row["small_cat"]==="?????????")echo "selected" ?>>?????????</option>
                                    <option value="4" <?php if ($row["small_cat"]==="????????????")echo "selected" ?>>????????????</option>
                                    <option value="5" <?php if ($row["small_cat"]==="????????????")echo "selected" ?>>????????????</option>
                                    <option value="6" <?php if ($row["small_cat"]==="?????????")echo "selected" ?>>?????????</option>
                                    <option value="7" <?php if ($row["small_cat"]==="????????????")echo "selected" ?>>????????????</option>
                                    <option value="8" <?php if ($row["small_cat"]==="??????T")echo "selected" ?>>??????T</option>
                                    <option value="9" <?php if ($row["small_cat"]==="??????")echo "selected" ?>>??????</option>
                                </select>
                        </div>

                        <div class="col-md-10">
                            <label for="productimage" class="form-label">????????????</label>
                            <input type="file" class="form-control" id="productimage" name="product_image" value="<?= $row["product_image"] ?>" >
                        </div>
                        <div class="picout col-md-10 d-flex justify-content-center align-items-center rounded mb-3">
                            <div>
                                <img class="pic" id="preview-image" class="photo-img cover-fit" src="./images/product/<?= $row["product_image"] ?>" alt="?????????????????????" value="<?= $row["product_image"] ?>">
                            </div>
                        </div>

                        <div class="col-md-5 mb-3">
                                <div for="color" class="mb-2 form-label">??????</div>
                                <select id="color" class="form-select" aria-label="colorSelect" name="color_id" requierd>
                                    <option value="1" <?php if ($row["color"]==="??????")echo "selected" ?>>??????</option>
                                    <option value="2" <?php if ($row["color"]==="??????")echo "selected" ?>>??????</option>
                                    <option value="3" <?php if ($row["color"]==="??????")echo "selected" ?>>??????</option>
                                    <option value="4" <?php if ($row["color"]==="??????")echo "selected" ?>>??????</option>
                                    <option value="5" <?php if ($row["color"]==="??????")echo "selected" ?>>??????</option>
                                    <option value="6" <?php if ($row["color"]==="??????")echo "selected" ?>>??????</option>
                                    <option value="7" <?php if ($row["color"]==="??????")echo "selected" ?>>??????</option>
                                    <option value="8" <?php if ($row["color"]==="??????")echo "selected" ?>>??????</option>
                                    <option value="9" <?php if ($row["color"]==="??????")echo "selected" ?>>??????</option>
                                </select>
                        </div>


                        <div class="col-md-5 mb-3">
                            <label for="size" class="form-label">??????</label>
                            <input type="text" class="form-control" id="size" name="product_size" value="<?=$row["product_size"]?>" placeholder="???????????????" >
                        </div>

                        <div class="col-md-10 mb-3">
                            <label for="describe" class="form-label">????????????</label>
                            <div class=""> 
                                <textarea class="form-control" id="describe" rows="10" name="product_describe" required><?=$row["product_describe"]?></textarea>  
                            </div>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="price" class="form-label">??????</label>
                            <input type="text" class="form-control" id="price" name="product_price" value="<?=$row["product_price"]?>" placeholder="???????????????" required>
                        </div>
                        
                        <div class="col-md-5 mb-4">
                            <label for="stock" class="form-label">?????????</label>
                            <input type="text" class="form-control" id="stock" name="product_stock" value="<?=$row["product_stock"]?>" placeholder="??????????????????" required>
                        </div>

                        <!-- <div class="col-10">
                            <hr size="3px" width="100%">
                        </div> -->
                        
                    
                        <div class="col-10 d-flex justify-content-end">
                            <div class="form-inline">
                                <button type="reset" class="mybutton btn btn-primary mr-3">????????????</button>

                                <button type="submit" class="mybutton btn btn-primary" onclick="javascript:return update();">????????????????????????</button>

                            </div>
                        </div>

                    </form>
                <?php endif; ?>
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
        }
    }


</script>
</body>







</html>

