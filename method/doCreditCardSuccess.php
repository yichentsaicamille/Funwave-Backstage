<!--應要有公版介面，require_once路徑卻有錯，先移除，fontawesome也沒有出來-->
<?php 
require_once("pdo-connect.php");
require_once("../public/if-login.php");
?>
<!doctype html>
<html lang="en">
<head>
    <title>Cart checkout</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("../public/css.php") ?>
    <style>
        body {
            background: #f3f3f3;
        }
        .header {
            padding-left: 0px;
            padding-right: 0px;
        }
        .article {
            background: #fff;
            margin: 100px auto;
            padding: 0px 10px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row wrap d-flex justify-content-center align-items-center">
    <?php require_once("../public/cart_header.php") ?>
        </aside>
        <article class="article col-lg-7 shadow-sm d-flex justify-content-center align-items-center p-5 mt">
            <div class="">
                <div class="text-center d-block">
                    <i class="fas fa-check-circle fa-5x mt-5 mb-4 text-success"></i>
                    <h2 class="mb-2">付款成功!</h2>
                    <h2 class="mb-5">訂單已送出!</h2>
                </div>
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

</body>
</html>