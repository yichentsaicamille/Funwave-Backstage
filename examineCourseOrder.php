<?php
require_once("method/pdo-connect.php");
require_once("./public/admin-if-login.php");

$course_order_id=$_GET["course_order_id"];

$sql_select="SELECT course_order_id, course_order_datetime, schedule_id, coach_id, student_id FROM course_order_list WHERE course_order_id=?";
$stmt=$db_host->prepare($sql_select);

try{

    $stmt->execute([$course_order_id]);

    $row=$stmt->fetch(PDO::FETCH_ASSOC);

}catch(PDOException $e){
    echo $e->getMessage();
}

?>


<!doctype html>
<html lang="en">
<head>
    <title>Course Order Content</title>
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
                <a role="button" href="service.php" class="btn btn-primary">返回</a>
            </div>
        </div>
        <article class="article col-9 shadow-sm"> <!--content-->
            <div>
                <form class="row g-3 mt-5 pb-5 d-flex flex-column justify-content-center" method="post">
                    <div class="col-md-5 m-3">
                        <label for="course_order_id" class="form-label">訂單編號</label>
                        <input type="text" class="form-control" id="course_order_id" name="course_order_id" value="<?= $row['course_order_id'] ?>" readonly>
                    </div>

                    <div class="col-md-5 m-3">
                        <label for="course_order_datetime" class="form-label">訂單日期</label>
                        <input type="text" class="form-control" id="course_order_datetime" name="course_order_datetime" value="<?= $row['course_order_datetime'] ?>" readonly>
                    </div>
                    <div class="col-md-5 m-3">
                        <label for="schedule_id" class="form-label">開課代碼</label>
                        <input type="text" class="form-control" id="schedule_id" name="schedule_id" value="<?= $row['schedule_id'] ?>" readonly>
                    </div>

                    <div class="col-md-5 m-3">
                        <label for="coach_id" class="form-label">教練代碼</label>
                        <input type="text" class="form-control" id="coach_id" name="coach_id" value="<?= $row['coach_id'] ?>" readonly>
                    </div>

                    <div class="col-md-5 m-3">
                        <label for="student_id" class="form-label">學生編號</label>
                        <input type="text" class="form-control" id="student_id" name="student_id" value="<?= $row['student_id'] ?>" readonly>
                    </div>


                    <!-- <div class="col-md-5 m-3">

                        <input name="action" type="hidden" value="delete">
                        <button class="btn btn-danger" type="submit" onclick="javascript:return del()">取消訂單</button>
                    </div> -->

                </form>

            </div>

        </article> <!--/content-->
    </div>
</div>

<script>

    // function del() {
    //     var msg = "確定確定要取消這個訂單嗎？";
    //     if (confirm(msg)==true){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }
</script>
</body>
</html>