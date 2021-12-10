<!--Bug: 訂單送出 信用卡卻沒有跳轉到信用卡頁面！！！-->

<!doctype html>
<html lang="en">
<head>
    <title>Credit Card</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <img src="../images/order/VerifiedByVisa.svg" alt="img" title="Tim!" height="150" width="" class="">
        <div class="col-6">
            <div class="card mt-3 p-2 mt-5">
                <div class="form-row form-group mt-2">
                    <label for="" class="col-sm-2 col-form-label">卡號</label>
                    <div class="col-sm-10">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control card-input" maxlength="4" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control card-input" maxlength="4" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control card-input" maxlength="4" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control card-input" maxlength="4" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row form-group mt-1">
                    <label for="" class="col-sm-2 col-form-label">過期時間</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="YY/MM" required>
                    </div>
                    <label for="" class="col-sm-2 col-form-label">驗證碼</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" maxlength="3" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <button id="bt" class="btn btn-outline-secondary" type="submit">確認結帳</button>
    </div>

</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    $(".card-input").keyup(function(){
        let maxLength=$(this).attr("maxlength")
        let currentLength=$(this).val().length
        console.log(maxLength+", "+currentLength)
        if(maxLength==currentLength){
            $(this).parent().next().find(":input").focus()
            console.log("hi")
        }
    })

    window.onload=function(){
        var obt=document.getElementById("bt");
        obt.onclick=function(){
            alert("付款成功!");
            <?php header("location: ../product-list.php"); ?>
        }
    }
</script>
</body>
</html>