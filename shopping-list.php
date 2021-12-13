<?php
require_once ("./method/pdo-connect.php");
require_once("./public/if-login.php");
$sqlProductList="SELECT * FROM products WHERE product_valid='1' ORDER BY product_id ASC";
$stmtProductList=$db_host->prepare($sqlProductList);
try{
    $stmtProductList->execute();
    $rowProductList=$stmtProductList->fetchAll(PDO::FETCH_ASSOC);
    $productCount=$stmtProductList->rowCount();
}catch (PDOException $e){
    echo $e->getMessage();
}
if(isset($_POST['add_cart'])){
    if (isset($_SESSION['cart'])){
//      從$_SESSION['cart']中，找出key:product_id對應的值
        $item_array_id=array_column($_SESSION['cart'],"product_id");
//      如果點選的$_POST['product_id']有存在$item_array_id之中
        if (in_array($_POST['product_id'], $item_array_id)){
            echo "<script>alert('商品已加入購物車!')</script>";
            echo "<script>window.location='shopping-list.php'</script>";
        }else{
            $count = count($_SESSION['cart']);
            $item_array=array(
                'product_id'=>$_POST['product_id'],
                'quantity'=>1
            );
            $_SESSION['cart'][$count] =$item_array;
//            print_r($_SESSION['cart']);
        }
    }else{
//        最開始$_SESSION['cart']還未有值。給入第一個值。
        $item_array=array(
                'product_id'=>$_POST['product_id'],
                'quantity'=>1
        );
        $_SESSION['cart'][0]=$item_array;
//        print_r($_SESSION['cart']);
    }
}
//unset($_SESSION["cart"]);
//var_dump($_SESSION['cart']);
//var_dump($_SESSION['cart'][0]);
//var_dump(array_column($_SESSION['cart'], 'product_id'));
//array(3) { [0]=> string(1) "1" [1]=> string(1) "2" [2]=> string(1) "3" }
?>
<!doctype html>
<html lang="en">
<head>
    <title>Shopping list</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- fontawesome -->
    <link rel="stylesheet" href="fontawesome-free-5.15.4-web/css/all.css">
    <style>
        .cart{
            color: white;
            text-decoration: none;
        }
        td{
            word-wrap: break-word;
            word-break: break-all;
            overflow-y:auto;
        }
        .product_img{
            min-width: 140px;
        }
        .product_price{
            min-width: 155px;
        }
        .product_name{
            max-width: 235px;
        }
    </style>
</head>
<body>
    <?php require_once("./public/cart_header.php") ?>
<div class="container">
        <table class="table table-bordered m-3 text-center">
            <thead>
            <tr class="text-nowrap">
                <th>購物車</th>
                <th>商品編號</th>
                <th>商品圖片</th>
                <th>商品名稱</th>
                <th>單價</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rowProductList as $value): ?>
                <tr class="text-nowrap">
                    <td>
                        <form action="shopping-list.php" method="post">
                            <button type="submit" name="add_cart" class="btn btn-warning"><i class="fas fa-shopping-cart"></i></button>
                            <input type="hidden" name="product_id" value="<?=$value["product_id"]?>">
                        </form>
                    </td>
                    <td><?=$value["product_id"]?></td>
                    <td class="product_img">
                        <div class="ratio ratio-1x1 my-2">
                            <img class="cover-fit product_img" src="images/product/<?=$value["product_image"]?>" alt="product image">
                        </div>
                    </td>
                    <td class="product_name"><?=$value["product_name"]?></td>
                    <td class="product_price">$ <?=$value["product_price"]?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>