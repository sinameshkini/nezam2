<?php
require_once ('include.php');
require_once("class.phpmailer.php");
$msg = "";
if(isset($_GET['recovery'])){
    if(!isset($_POST['mail']) || $_POST['mail'] == null){
        $_SESSION['msg'] = "فیلد ایمیل را پر کنید";
        $_SESSION['msg_type'] = 0;
    }else{
        $mail_address = $_POST['mail'];
        $result=$conn->query("SELECT * FROM user WHERE email='$mail_address'");
        $row=$result->fetch_assoc();
        if($row["email"] == null){
            $_SESSION['msg'] = "این ایمیل ثبت نام نشده است";
            $_SESSION['msg_type'] = 0;
        }else{
            $mail = new PHPMailer();
            $mail->addAddress($mail_address);
            $mail->setFrom('info@sottabyte.ir', 'Support');
            $mail->addReplyTo("info@sottabyte.ir");
            $mail->Subject    = 'Golestan Nezam password recovery';
            $ath = md5($row['codemeli']);
            $memnum = $row['membernum'];
            $mail->Body = "<h2>یازیابی کلمه عبور سامانه نظام مهندسی دانشگاه گلستان</h2><br>جهت بازیابی برروی لینک زیر کلیک کنید<br><a href='http://10.75.48.183/nezam/recovery.php?mem=$memnum&ath=$ath'>بازیابی کلمه عبور</a>";
            $mail->isHTML(true);
            if ($mail->send()) {
                $_SESSION['msg'] = 'لطفا ایمیل خود را چک کنید. همچنین پوشه اسپم را چک کنید';
                $_SESSION['msg_type'] = 1;
            } else {
                $_SESSION['msg'] = 'خطا در سیستم لطفا با پشتیبانی تماس بگیرید';
                $_SESSION['msg_type'] = 0;
            }
        }
    }
}

?>
<html>

<head>
    <meta charset="UTF-8">
    <title>بازیابی کلمه عبور</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="header">
        <div class="container-fluid row justify-content-start align-items-center sticky-top">
            <a href="#"><img src="img/Golestan.png" class="img-fluid"></a>
            <b class="h3">مرکز آموزشهای کوتاه مدت دانشگاه گلستان</b>
        </div>
    </div>
    <br>
    <div class="container justify-content-center">
        <h2 class="text-center mb-3">بازیابی کلمه عبور</h2>
        <hr>
        <div class="row justify-content-around">
            <section class="card col-5 bg-light">
                <!--offset to center-->
                <div class="card-body">
                    <form class="form-group" action="?recovery=1" method="post">
                        <div class="form-inline row my-5 mx-5">
                            <label for="" class="form-control-lable h3 mx-3 col-4">ایمیل:</label>
                            <input type="email" name="mail" class="form-control mx-3 col-6">
                            <?php
                            if($_SESSION['msg'] != ""){ ?>
                                <div class="alert mt-5  
                                <?php if($_SESSION['msg_type']){ echo "alert-success";}else{
                                    echo "alert-danger";
                                }?> h4 text-center">
                                    <?php
                                    echo $_SESSION['msg'];
                                    $_SESSION['msg'] = "";
                                    ?>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <input type="submit" class="btn btn-success mt-5 mb-5" value="ارسال ایمیل بازیابی">
                        <a href="index.php" class="btn btn-warning">بازگشت</a>
                    </form>
                    
                    
                </div>
            </section>
            <div class="alert  alert-primary h3 text-center col-5">
                ایمیل خود را وارد کنید تا یک ایمیل حاوی یک لینک برای شما ارسال گردد. ممکن است در پوشه Inbox یا Spam شما ذخیره شده باشد. با کلیک بر روی آن میتوانید یک کلمه عبور جدید برای خود انتخاب کنید.        
            </div>
        </div>
    </div>
</body>




</html>