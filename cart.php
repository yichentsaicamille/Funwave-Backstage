<?php
require_once("./method/pdo-connect.php");
//product-list.php已設好session
$productId = array_column($_SESSION['cart'], "product_id");
//implode()把陣列元素組合為一個字串。
//var_dump($productId);
$sql = "SELECT * FROM products where product_id in (" . implode(',', $productId) . " ) AND product_valid = 1 ORDER BY product_id DESC";
$stmt = $db_host->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll();
//var_dump($products);
?>

<!doctype html>
<html lang="en">
<head>
    <title>Cart</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">

    <!-- fontawesome -->
    <link rel="stylesheet" href="fontawesome-free-5.15.4-web/css/all.css">

    <style>
        .cart {
            color: white;
            text-decoration: none;
        }
        .cart_count {
            text-align: center;
            padding: 0 0.9rem 0.1rem 0.9rem;
            border-radius: 3rem;
        }
        .price-details h6 {
            padding: 3% 2%;
        }
        .quantity {
            width: 70px;
        }
    </style>
</head>
<body>
<?php require_once("./public/cart_header.php") ?>
<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="pt-4">
                <h6>My Cart</h6>
                <hr>
                <form action="cart.php" method="get" class="cart-items">
                    <?php foreach ($products as $product): ?>

                        <div class="border rounded cart-item" data-id="<?= $product['product_id'] ?>">
                            <div class="row bg-white">
                                <div class="col-md-3 ps-0">
                                    <!--                                    待圖片有了，再移除註解，不然每次跳錯誤-->
                                    <!--                                    <img src="images/-->
<!--                                     //= $product['product_image'] >" alt="image1" class="img-fluid">-->
                                </div>
                                <div class="col-md-5 pb-3 pt-2 " >
                                    <h5 class="pt-2" ><?= $product['product_name'] ?></h5>
                                    <small class="text-secondary">Seller: cartoon</small>
                                    <h5 class="pt-2 product_price"><?= $product['product_price'] ?></h5>
                                </div>
                                <div class="col-md-4 py-5">
                                    <div>
                                        <button type="button" class="btn bg-light border rounded-circle minus"><i
                                                    class="fas fa-minus"></i></button>
                                        <input type="text" value="1" class="form-control d-inline quantity"
                                               name="quantity">
                                        <button type="button" class="btn bg-light border rounded-circle plus"><i
                                                    class="fas fa-plus"></i></button>
                                        <div id="subtotal" class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </form>
            </div>
        </div>
        <div class="col-md-4 offset-md-1 mt-5">
            <form action="cart_checkout.php" method="post">
                <div class="p-4 border rounded bg-white h-25">

                    <h6>價錢明細</h6>
                    <hr>
                    <input id="cart" type="hidden" name="cart">
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php
                            if (isset($_SESSION['cart'])) {
                                $count = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            } else {
                                echo "<h6>Price (0 items)</h6>";
                            }
                            ?>
                            <h6>運費</h6>
                            <hr>
                            <h6>account payable</h6>
                        </div>
                        <div class="col-md-6">
                            <h6 class="total">$ <?php echo ""; ?></h6>
                            <h6 class="text-success"> 免運費FREE</h6>
                            <hr>
                            <h6 class="total">
                                $ <?php echo ""; ?>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-evenly mt-5">
                    <a role="button" class="btn btn-secondary" href="product-list.php">繼續購物</a>
                    <button type="submit" class="btn btn-primary" >下一步</button>
                </div>
            </form>
        </div>
    </div>

</div>


<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>


<script>
    // 購物車數量增減
    $(".plus").click(function () {
        let n = $(this).siblings(".quantity").val();
        n++;
        $(this).siblings(".quantity").val(n);
    })
    $(".minus").click(function () {
        let n = $(this).siblings(".quantity").val();
        //當文字框的值減到1時就不再執行n--及後面的程式碼
        if (n == 1) {
            return false;
        }
        n--;
        $(this).siblings(".quantity").val(n);
    })
    // 取得數量、計算小計
    $(".minus, .plus, .quantity").on("click change keypress keyup blur", function () {
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }

        var total = 0;
        var product_quantity = $(this).val();
        if (product_quantity < 0) $(this).val(0);

        $(".cart-item").each(function () {
            var product_price = $(this).find(".product_price").text();
            var quantity = $(this).find(".quantity").val();
            var subtotal = product_price * quantity;
            $(this).find(".s_price").text(subtotal);
            total += subtotal;
        });
        $(".total").text(total);

        let cart=[];
        $(".cart-item").each(function(){
            let item={
                product_id: $(this).data("id"),
                quantity: Number($(this).find(".quantity").val())
            }
            cart.push(item)
        })
        // console.log(cart)
        $("#cart").val(JSON.stringify(cart));
    });
</script>

</body>
</html>