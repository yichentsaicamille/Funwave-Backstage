<?php
if(isset($_GET["id"])){
    $id=$_GET["id"];
}else{
    $id=0;
}
require_once ("./method/db-connect.php");
$sql="SELECT * FROM member WHERE id='$id' AND valid=1";
$result=$conn->query($sql);
$memberExist=$result->num_rows;
?>
<!doctype html>
<html lang="en">
<head>
    <title>修改會員</title>
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
                <a role="button" href="member-management.php" class="btn btn-primary">返回</a>
            </div>
        </div>
        <article class="article col-9 shadow-sm"> <!--content-->
            <div>
                <?php if($memberExist===0): ?>
                    使用者不存在
                <?php else:
                $row=$result->fetch_assoc();
                ?>
                <form class="row g-3 mt-5 pb-5 d-flex justify-content-center" action="member-update.php" method="post">
                    <input type="hidden" name="id" value="<?=$row["id"]?>">
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <div>
                            <img class="photo-img cover-fit" src="images/<?=$row["photo"]?>">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="photo" class="form-label">照片</label>
                        <input type="file" class="form-control" id="inputGroupFile02" value="<?=$row["photo"]?>" readonly>
                    </div>
                    <div class="col-md-5">
                        <label for="name" class="form-label">姓名</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?=$row["name"]?>" placeholder="請輸入姓名" readonly>
                    </div>
                    <div class="col-md-5">
                        <label for="gender" class="form-label">性別</label>
                        <select id="gender" class="form-select" aria-label="Default select example" value="<?=$row["gender"]?>" disabled>
                            <option selected>請選擇性別</option>
                            <option value="1">男生</option>
                            <option value="2">女生</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="phone" class="form-label">電話</label>
                        <input type="text" class="form-control" id="phone" name="phone"value="<?=$row["phone"]?>" placeholder="請輸入電話" readonly>
                    </div>
                    <div class="col-md-5">
                        <label for="email" class="form-label">信箱</label>
                        <input type="email" class="form-control" id="email" name="email"value="<?=$row["email"]?>" placeholder="請輸入email" readonly>
                    </div>
                    <div class="col-md-5">
                        <label for="account" class="form-label">帳號</label>
                        <input type="text" class="form-control" id="account" name="account"value="<?=$row["account"]?>" placeholder="請輸入帳號" readonly>
                    </div>
                    <div class="col-md-5">
                        <label for="password" class="form-label">密碼</label>
                        <input type="password" class="form-control" id="password" name="password"value="<?=$row["password"]?>" placeholder="請輸入密碼" readonly>
                    </div>
                    <div class="col-10">
                        <label for="address" class="form-label">地址</label>
                        <input type="text" class="form-control" id="address" name="address"value="<?=$row["address"]?>" placeholder="請輸入地址" readonly>
                    </div>
                    <div class="col-10 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">送出</button>
                    </div>
                </form>
                <?php endif; ?>
            </div>

        </article> <!--/content-->
    </div>
</div>
</body>
</html>

