<?php
if(isset($_GET["id"])){
    $coach_id=$_GET["id"];
}else{
    $coach_id=0;
}
require_once ("./method/pdo-connect.php");
require_once("./public/admin-if-login.php");
$sql="SELECT * FROM genre 
    JOIN coach ON genre.genre_id = coach.genre_id 
WHERE coach_id='$coach_id' AND coach_valid=1 
GROUP BY genre.genre_id";
$stmt = $db_host->prepare($sql);
$num_rows = $stmt->fetchColumn();

try {
    $stmt->execute();
    $row = $stmt->fetch();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $e){
    echo $e->getMessage();
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Coach Content</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>

</head>
<body>
<div class="container-fluid">
    <div class="row">
    <?php require_once("./public/admin-header-logined.php"); ?>
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
                <?php if($num_rows===0): ?>
                    使用者不存在
                <?php else:
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <form class="row g-3 mt-5 pb-5 d-flex justify-content-center" method="post">
                    <input type="hidden" name="coach_id" value="<?=$row["coach_id"]?>">
                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <div>
                            <img class="photo-img cover-fit" src="images/coach/<?=$row["coach_photo"]?>">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label for="photo" class="form-label d-none">照片</label>
                        <input type="file" class="form-control d-none" id="photo" value="<?=$row["coach_photo"]?>" readonly>
                    </div>
                    <div class="col-md-5">
                        <label for="name" class="form-label">姓名</label>
                        <input type="text" class="form-control" id="name" name="coach_name" value="<?=$row["coach_name"]?>" placeholder="請輸入姓名" readonly>
                    </div>
                    <div class="col-md-5">
                        <label for="gender" class="form-label">性別</label>
                        <select id="gender" class="form-select" aria-label="Default select example" disabled>
                            <option><?= $row['gender'] ?></option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="phone" class="form-label">電話</label>
                        <input type="text" class="form-control" id="phone" name="coach_phone" value="<?=$row["coach_phone"]?>" placeholder="請輸入電話" readonly>
                    </div>
                    <div class="col-md-5">
                        <label for="email" class="form-label">信箱</label>
                        <input type="email" class="form-control" id="email" name="coach_email" value="<?=$row["coach_email"]?>" placeholder="請輸入email" readonly>
                    </div>
                    <div class="col-md-5">
                        <label for="account" class="form-label">帳號</label>
                        <input type="text" class="form-control" id="account" name="coach_account" value="<?=$row["coach_account"]?>" placeholder="請輸入帳號" readonly>
                    </div>
                    <div class="col-md-5">
                        <label for="password" class="form-label">密碼</label>
                        <input type="password" class="form-control" id="password" name="coach_password" value="<?=$row["coach_password"]?>" placeholder="請輸入密碼" readonly>
                    </div>
                    <div class="col-10">
                        <label for="address" class="form-label">專長</label>
                        <input type="text" class="form-control" id="expertise" name="coach_expertise" value="<?=$row["coach_expertise"]?>" placeholder="請輸入專長" readonly>
                    </div>
                    <div class="col-10">
                        <label for="address" class="form-label">地址</label>
                        <input type="text" class="form-control" id="address" name="coach_address" value="<?=$row["coach_address"]?>" placeholder="請輸入地址" readonly>
                    </div>
                </form>
                <?php endif; ?>
            </div>

        </article> <!--/content-->
    </div>
</div>
</body>
</html>

