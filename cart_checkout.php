<!--address無法加required，因為如果只選超商會過不了。 可能要用js感應觸發再傳送給html required!!!!!!!!!!!!!!!!-->

<?php
//把所選數量放進session
require_once("./method/pdo-connect.php");

$cart=$_POST["cart"];
//json_decode()從JSON中提取資料。$assoc，TRUE，函式將返回一個關聯陣列，FALSE，函式將返回物件。
$cart=json_decode($cart,true);
//var_dump($cart);
//echo '<br>';

//直接將$_SESSION['cart']的內容替換陣列$cart
$_SESSION['cart']=$cart;
//var_dump($_SESSION['cart']);
?>

<!doctype html>
<html lang="en">
<head>
    <title>Cart checkout</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>
    <style>

    </style>

</head>
<body>
<div class="container-fluid">
    <div class="row wrap d-flex">
        <?php require_once("./public/header.php") ?>
        <!--menu-->
        <aside class="col-lg-2 navbar-side shadow-sm">
            <?php require_once("./public/nav.php") ?>
        </aside>
        <!--/menu-->
        <article class="article col-lg-9 shadow-sm table-responsive content-group">
            <div class="table-wrap">
                <form action="./method/doInsertOrder.php" method="post" class="m-3">
                    <div class="row d-flex justify-content-center">
                        <!--小專未做會員登入(前台)，故先不連接登入的會員資料-->
<!--                        <input id="" type="hidden" name="member_id" class="form-control" value="" readonly>-->
<!--                        <div class="col-md-10 mb-4">-->
<!--                            <label class="mb-2" for="">會員姓名</label>-->
<!--                            <input id="" type="text" name="member_id" class="form-control" value="" readonly>-->
<!--                        </div>-->
                        <div class="col-md-4 mb-4 mt-4">
                            <label class="mb-2" for="receiver">收件人姓名</label>
                            <input id="receiver" type="text" name="receiver" class="form-control" value="" required>
                        </div>
                        <div class="col-md-6 mb-4 mt-4">
                            <label class="mb-2" for="receiver_phone">收件人電話</label>
                            <input id="receiver_phone" type="number" name="receiver_phone" class="form-control" value="" required>
                        </div>
                        <!--依送貨方式，對應顯現收件人地址or超商門市-->
                        <div class="col-md-4 mb-4">
                            <div class="mb-2">送貨方式</div>
                            <select class="form-select" aria-label="delivery select" name="delivery" id="delivery_select">
                                <option value="#delivery1">宅配到府</option>
                                <option value="#delivery2">超商取貨</option>
                            </select>
                        </div>
<!--                        address無法加required，因為這樣選超商，這邊會過不了。 可能要用js感應觸發再傳送給html required!!!!!!!!!!!!!!!!-->
                        <div class="col-md-6 mb-4" id="delivery1">
                            <label class="mb-2" for="address">收件人地址</label>
                            <input id="address" type="text" name="address" class="form-control" value="">
                        </div>
                        <div class="col-md-6 mb-4" id="delivery2">
                            <div class="mb-2">超商門市</div>
                            <select class="form-select" aria-label="convenient_store select" name="convenient_store">
                                <option value="一零一門市">一零一門市</option>
                                <option value="中興門市">中興門市</option>
                                <option value="世貿門市">世貿門市</option>
                                <option value="湯圍門市">湯圍門市</option>
                                <option value="上美崙門市">上美崙門市</option>
                                <option value="東大門市">東大門市</option>
                            </select>
                        </div>
                        <div class="col-md-10 mb-5">
                            <div class="mb-2">付款方式</div>
                            <select class="form-select" aria-label="payment select" name="payment">
                                <option value="信用卡">信用卡</option>
                                <option value="貨到付款">貨到付款</option>
                            </select>
                        </div>
                        <div class="col-md-10 d-flex justify-content-evenly mb-4">
                            <a role="button" class="btn btn-secondary" href="cart.php">上一步</a>
                            <button id="bt" class="btn btn-primary" type="submit">送出訂單</button>
                        </div>
                    </div>
                </form>
            </div>
        </article>
    </div>
</div>


<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script>
    // 依送貨方式，對應顯現收件人地址or超商門市
    $('div[id="delivery2"]').hide();

    $('#delivery_select').change(function(){
        let deliveryValue=$(this).val();
        $('div[id^="delivery"]').hide();
        $(deliveryValue).show();
    });

</script>
</body>
</html>