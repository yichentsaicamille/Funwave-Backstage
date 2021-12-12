<header id="header" class="header">
    <div class="container-fluid d-flex justify-content-between align-items-center navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="shopping-list.php" class="navbar-brand">
            <h3 class="px-5">
                <i class="fas fa-shopping-basket"></i> Shopping Cart
            </h3>
        </a>
        <div class="d-flex">
            <div>
                <a href="cart.php" class="nav-item active text-decoration-none">
                    <h5 class="px-5 cart">
                        <i class="fas fa-shopping-cart"></i> Cart
                        <?php
                        if (isset($_SESSION['cart'])) {
                            $count = count($_SESSION['cart']);
                            echo "<span id='cart_count' class='text-warning'>$count</span>";
                        } else {
                            echo "<span id='cart_count' class='text-warning'>0</span>";
                        }
                        ?>
                    </h5>
                </a>
            </div>
            <div>
                <div class="text-white">Hi, <?= $_SESSION["member"]["member_name"] ?>&nbsp; &nbsp;<a href="./method/doLogout.php" class="btn btn-outline-light btn-sm">登出</a></div>
            </div>
        </div>
    </div>
</header>