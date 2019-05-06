<?php
require_once ('include.php');
if(isset($_GET['login'])){
    login();
}elseif (isset($_GET['logout'])){
    logout();
}
if(isset($_SESSION['user_type'])){
    if($_SESSION['user_type']==1) {
        require_once("admin.php");
    }elseif($_SESSION['user_type']==0){
        require_once("user.php");
    }else{
        echo "شما کاربر غیر مجاز هستید و به این صفحه دسترسی ندارید";
    }
    exit;
}
function login(){
    global $conn;
    global $salt;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedpass = md5($password.$salt);
    $query = "SELECT * FROM user WHERE codemeli='$username' AND `password`='$hashedpass'";
    // echo $query;
    $result=$conn->query($query);
    
    // var_dump($result);
    // exit;
    
    $row=$result->fetch_assoc();
    
    // exit;
    if($row["codemeli"] == null){
        $_SESSION['msg'] = "نام کاربری و یا کلمه عبور اشتباه است، لطفا مجددا تلاش کنید";
        $_SESSION['msg_type'] = 0;
    }
    else{
        $_SESSION['username'] = $username;
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['user_type'] = $row['user_type'];
        $_SESSION['membernum'] = $row['membernum'];
        if ($row['img']==null){
            $_SESSION['img'] = "img/profiles/nobody.jpg";
        }else{
            $_SESSION['img'] = $row['img'];
        }
        $_SESSION['user_id'] = $row['id'];
        if($_SESSION['user_type']==0){
            require_once("user.php");
//            echo "user";
        }
        elseif($_SESSION['user_type']==1){
            require_once('admin.php');
//            echo "admin";
        }else{
            echo "شما کاربر غیر مجاز هستید و به این صفحه دسترسی ندارید";
        }
        exit;
    }
}

function logout(){
    $_SESSION = array();
    session_destroy();
}

$query = "SELECT * FROM news ORDER BY id DESC LIMIT 5";
$result = $conn->query($query);


?>

<html>
<head>
    <meta charset="UTF-8">
    <title>نظام مهندسی گلستان</title>
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="header">
        <div class="container-fluid row justify-content-start align-items-center">
            <a href="index.php"><img src="img/Golestan.png" class="img-fluid"></a>
            <b class="h3">مرکز آموزشهای کوتاه مدت دانشگاه گلستان</b>
        </div>
    </div>
    <br>
    <div class="container-fluid row justify-content-center">
        <b class="h2">سامانه برگزاری دوره‌های آموزشی نظام مهندسی</b>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5" id="loginform">
                <div class="justify-content-center mt-3">
                    <section class="border border-info px-0">
                        <div class="card-header bg-info">
                            <h2 class="card-title text-light text-center">ورود به پنل شخصی</h2>
                        </div>
                        <div class="card-body">
                            <?php
                            require_once("msgshow.php");
                            ?>
                            <form action="index.php?login=1" method="post" class="form-group container h3">
                                <div class="form-inline px-3 my-3 row justify-content-between">
                                    <label for="" class="form-control-lable offset-1">کد ملی</label>
                                    <input type="text" name="username" placeholder="اعداد لاتین بدون خط فاصله" class="form-control col-6">
                                </div>
                                <div class="form-inline px-3 my-3 row justify-content-between">
                                    <label for="" class="form-control-lable offset-1">کلمه عبور</label>
                                    <input type="password" name="password" placeholder="کلمه عبور..." class="form-control col-6">
                                </div>
                                <div class="row justify-content-around">
                                    <input type="submit" class="btn btn-success col-3" value="ورود">
                                    <a href="recovery.php" class="btn btn-danger col-3 ">بازیابی
                                        کلمه عبور</a>
                                    <a href="signup.php" class="btn btn-primary col-3">ثبت
                                        نام</a>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
            <div class="col-7" id="news">
                <!-- Card new -->
                <div class="row justify-content-center mt-3">
                    <section class="border border-secondary px-0" style="width: 100%">
                        <div class="card-header bg-secondary">
                            <h2 class="card-title text-light text-center">اخبار و اطلاعیه‌ها</h2>
                        </div>
                        <div class="card-body">
                        <?php
                        if($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <!--new1  -->
                                <div class="row justify-content-center mt-1 mb-5 text-right d-block">
                                    <section class="px-0">
                                        <div class="card-header bg-info text-light mx-3">
                                            <span class="card-title py-0 my-0 h3"><?php echo $row["title"]; ?></span>
                                        </div>
                                        <div class="card-body h4">
                                            <span><?php echo $row["content"]; ?></span>
                                        </div>
                                        <div class="card-footer h4">
                                            <span>تاریخ انتشار خبر: <?php echo date('d/m/Y', $row["date"]); ?></span>
                                        </div>
                                    </section>
                                </div>
                                <?php
                            }
                        }else{
                            ?>
                            <div class="row justify-content-center mt-1 mb-5 text-right d-block">
                                <section class="px-0">
                                    <div class="card-header bg-info text-light mx-3">
                                        <span class="card-title py-0 my-0 h3">هیچ خبری درج نشده است.</span>
                                    </div>
                                    <div class="card-body h4">
                                        <span></span>
                                    </div>
                                </section>
                            </div>
                            <?php
                        }
                        ?>
                            <!-- new2 -->
                        </div>
                    </section>
                </div>
                <!-- End card news -->
            </div>
        </div>
    </div>
</body>

</html>