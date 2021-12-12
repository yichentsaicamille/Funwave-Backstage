<?php
require_once("./method/pdo-connect.php");     //讀pdo連資料庫
require_once("./public/admin-if-login.php");

$sql="SELECT * FROM(                   
    (products INNER JOIN big_cats 
    ON products.big_cat_id = big_cats.big_cat_id
    )
INNER JOIN small_cats
ON products.small_cat_id = small_cats.small_cat_id
)
INNER JOIN colors 
ON products.color_id = colors.color_id ORDER BY products.product_id ASC";


$stmt = $db_host->prepare($sql);     

try {
    $stmt->execute();
    //$row = $stmt->fetch();     
    //$rows = $stmt->fetchAll();  
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);  
}catch (PDOException $e){
    echo $e->getMessage();
}



$count = $db_host->prepare($sql);   
$count->execute();   
$allDataCount=$count->rowCount();



//如果有搜尋
if (isset($_GET["search"]) && ($_GET["search"] != "")) {

    $search = $_GET["search"];
    
    $sql="SELECT * FROM(                   
        (products INNER JOIN big_cats 
        ON products.big_cat_id = big_cats.big_cat_id
        )
    INNER JOIN small_cats
    ON products.small_cat_id = small_cats.small_cat_id
    )
    INNER JOIN colors 
    ON products.color_id = colors.color_id WHERE small_cat LIKE '%$search%' ";


    //準備好語句for搜尋框
    $result_query = $db_host->prepare($sql);
} 
else {
//如果沒有搜尋就顯示分頁

    if (isset($_GET["p"])) {
        $p = $_GET["p"];

    } else {
        $p = 1;

    }
    $pageItems = 6;
    $startItem = ($p - 1) * $pageItems;

//計算總頁數
    $pageCount = $allDataCount / $pageItems;


//取餘數
    $pageR = $allDataCount % $pageItems;


    $startNo = ($p - 1) * $pageItems + 1;
    $endNo = $p * $pageItems;

    if ($pageR !== 0) {
        $pageCount = ceil($pageCount);//如果不=0無條件進位
        if ($pageCount == $p) {
            $endNo = $endNo - ($pageItems - $pageR);
        }
    }

//    有限制筆數的語句
    $sql = $sql="SELECT * FROM(                   
        (products INNER JOIN big_cats 
        ON products.big_cat_id = big_cats.big_cat_id
        )
    INNER JOIN small_cats
    ON products.small_cat_id = small_cats.small_cat_id
    )
    INNER JOIN colors 
    ON products.color_id = colors.color_id ORDER BY products.product_id ASC 
    LIMIT $startItem, $pageItems";  //做出每頁限制幾筆的部分
   
//    準備好語句
    $result_query = $db_host->prepare($sql);

}

//最後執行
try {
    $result_query->execute();
    $rows = $result_query->fetchAll(PDO::FETCH_ASSOC);
    $product_rows = $result_query->rowCount();

    //    echo $product_rows;
} catch (PDOException $e) {
    echo $e->getMessage();
}



?>

<!doctype html>
<html lang="en">

<head>
    <title>Product List</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once("./public/css.php") ?>
    <script src="https://kit.fontawesome.com/8ad17a247c.js" crossorigin="anonymous"></script>  <!-- fontawesome -->
    <style>
    .des{           
        max-width: 420px;
        word-break:break-word; word-wrap:break-word;
        overflow-y:auto;
        /* white-space:normal; */
        /* text-overflow: ellipsis; */
    }
    table td {
       min-width: 120px; 
       min-height: 150px;
       max-height: 150px;
    }
    /* pre{
        white-space: pre-wrap;
        word-wrap: break-word;
    } */
    .name-block{
        min-width: 200px;
    }
    .item-block{
        min-width: 140px;
    }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row wrap d-flex">
        <?php require_once("./public/admin-header-logined.php") ?>

            <!--menu-->
            <aside class="col-lg-2 navbar-side shadow-sm">
                <?php require_once("./public/nav.php") ?>
            </aside>
            <!--/menu-->

            <div class="col-lg-9 d-flex justify-content-between align-items-center button-group shadow-sm">

                <div class="d-flex align-items-center ml-5">
                    <a role="button" href="product-list.php" class="btn btn-primary text-nowrap me-3"><i class="fas fa-stream"></i>  商品總覽</a>
    
                    <a role="button" href="product-create.php" class="btn btn-primary text-nowrap"><i class="fas fa-plus"></i>  新增商品</a>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <!-- 搜尋 -->
                    <form action="product-list.php" method="get">
                        <div class="d-flex">
                            <input class="form-control me-2" type="search" name="search"
                            placeholder="分類搜尋" 
                            value="<?php if (isset($search)) echo $search; ?>">
                            <button class="btn btn-primary text-nowrap" type="submit">搜尋</button>
                        </div>
                    </form>
                </div> <!--搜尋button&欄位區塊-->

            </div> <!--上段內容框-->

            <!-- <div class="col-lg-9 d-flex mt-3 justify-content-between align-items-center button-group shadow-sm">
                
                <div class="d-flex justify-content-between align-items-center">
                        <div>
                            總共 <?=$allDataCount?> 筆商品
                        </div>
                </div>
           
            </div>  中段內容框 -->
            
            <!--內容-->
            <article class="article col-lg-9 shadow-sm table-responsive">
                <!--內容-->
                <div class="table-wrap">
                    <?php if ($dataExist = $stmt->fetchAll() > 0): ?>
                        <table class="table table-bordered align-middle my-3">
                            <thead>
                                <tr>
                                            <th class="text-center">查看內容</th>
                                            <th class="text-center">編輯商品</th>
                                            <!-- <th>商品排序</th> -->
                                            <th class="text-center">商品名稱</th>
                                            <th class="text-center">貨號</th>
                                            <th class="text-center">大分類</th>
                                            <th class="text-center">小分類</th>
                                            <th class="text-center">商品圖片</th>
                                            <th class="text-center">顏色</th>
                                            <th class="text-center">尺寸</th>
                                            <th class="text-center">品項描述</th>
                                            <th class="text-center">定價</th>
                                            <th class="text-center">庫存數</th>
                                            <th class="text-center">編輯時間</th>
                                            <!-- <th>上架</th> -->
                                            <th class="text-center">編輯商品</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($rows as $value):?>

                                    <tr>

                                            <td class="text-center">   <!--查看按鈕-->
                                                <a role="button" href="product-detail.php?id=<?= $value["product_id"] ?>"
                                                class=""><i class="fas fa-search"></i></a>
                                            </td>

                                            <td class="text-center text-nowrap">  <!--編輯按鈕開始-->
                                
                                                <a role="button" href="product-edit.php?id=<?= $value["product_id"] ?>"
                                                class="mb-2"><i class="fas fa-edit"></i></a> 
                                                /
                                                <a role="button" href="method/doDelete-product.php?id=<?= $value["product_id"] ?>"  
                                                class="" onclick="javascript:return del();" value="刪除"><i class="fas fa-trash-alt"></i></a>

                                            </td>  <!--編輯按鈕結束-->


                                            <!-- <td class="text-center"><?= $value["product_id"] ?></td> -->
                                            <td class="name-block text-center"><?= $value["product_name"] ?></td>
                                            <td class="item-block text-center"><?= $value["product_item"] ?></td>
                                            <td class="text-center"><?= $value["big_cat"] ?></td>
                                            <td class="text-center"><?= $value["small_cat"] ?></td>

                                            <td class="cover-fit text-center">

                                                <img src="./images/product/<?= $value["product_image"] ?>" alt="<?= $value["product_image"] ?>"  width=180px>

                                            </td>

                                            <td class="text-center"><?= $value["color"] ?></td>
                                            <td class="text-center"><?= $value["product_size"] ?></td>

                                            <td class="des">
                                                <pre class="des text-align-left"><?= $value["product_describe"] ?></pre>
                                            </td>

                                            <td class="text-center">

                                                <?php if($value["product_price"]>=1000): 
                                                        echo number_format($value["product_price"])."<br>";
                                                    else:
                                                        echo number_format($value["product_price"]);
                                                    endif;
                                                ?>

                                            </td>

                                            <td class="text-center"><?= $value["product_stock"] ?></td>
                                            <td class="text-center"><?= $value["product_create_time"] ?></td>
                                            <!-- <td><?= $value["product_valid"] ?></td> -->

                                            <td class="text-nowrap text-center">  <!--編輯按鈕開始-->
                                    
                                                <a role="button" href="product-edit.php?id=<?= $value["product_id"] ?>"
                                                class="mb-2"><i class="fas fa-edit"></i></a> 
                                                /
                                                <a role="button" href="method/doDelete-product.php?id=<?= $value["product_id"] ?>"  
                                                class="" onclick="javascript:return del();" value="刪除"><i class="fas fa-trash-alt"></i></a>

                                            </td>  <!--編輯按鈕結束-->

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div> <!--分頁開始-->
                        <!--如果有分頁要顯示目前筆數-->
                            <?php if (isset($p)): ?>
                                <div class="py-2">共 <?= $allDataCount ?> 筆商品</div>
                            <?php else: ?>
                                <div class="py-2">共 <?= $product_rows ?> 筆商品</div>
                            <?php endif; ?>
                        </div>


                        <!-- 如果使用搜尋功能因為沒有p pagaCount會跑出來有問題 所以加上判斷 有p才出現這個UI-->
                        <?php if (isset($p)): ?>
                            <nav aria-label="Page navigation example ">
                                <ul class="pagination justify-content-center">
                                <li class="page-item"><a class="page-link" href="product-list.php?p=1">第一頁</a></li>
                                    <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                        <!--當下頁數跟頁碼相同時echo active 寫在li class裡面-->
                                        <li class="page-item <?php if ($p == $i) echo "active" ?>">
                                            <a class="page-link" href="product-list.php?p=<?= $i ?>"><?= $i ?></a></li>
                                    <?php endfor; ?>
                                    <li class="page-item"><a class="page-link" href="product-list.php?p=<?= $pageCount ?>">最末頁</a></li>
                                </ul>
                            </nav>
                        <?php endif; ?>  <!--分頁結束-->

                    <?php else : ?>
                        沒有商品資料
                    <?php endif; ?>
                </div>

            </article>
            <!--內容結束-->
        </div>
    </div>

<script>
    function del() {
        var msg = "確定要刪除嗎？\n\n請確認！";
        if (confirm(msg) == true) {
            window.location.replace("./method/doDelete-product.php?product_id=<?= $value["product_id"] ?>");
            return true;
        } else {
            return false;
        }
    }

    

</script>
</body>

</html>