<?php
/**
 * Created by PhpStorm.
 * User: Sina Meshkini
 * Date: 1/9/2019
 * Time: 4:53 PM
 */
require_once ("include.php");
require_once ("access.php");
user_access(0);

?>



<nav class="navbar bg-light navbar-light nav-pills flex-column flex-sm-row navbar-expand-sm justify-content-start align-items-center sticky-top m-0 p-0">
    <div class="container-fluid h4">
        <a href="index.php" class="navbar-brand"><img src="img/Golestan.png" class="img-fluid" style="width: 60px"></a>
        <span class="">سامانه برگزاری دوره‌های نظام مهندسی گستان</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenutoggle"
                aria-controls="mainmenutoggle" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggler-icon"></span></button>

        <div class="collapse navbar-collapse" id="mainmenutoggle">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="index.php">خانه</a>
                <!-- DropDown -->
                <div class="dropdown">
                    <a href="#" class="nav-item nav-link dropdown dropdown-toggle" data-toggle="dropdown">دوره‌ها</a>
                    <div class="dropdown-menu">
                        <a href="register.php" class="dropdown-item">ثبت نام دوره جدید</a>
                        <a href="mycourses.php" class="dropdown-item">دوره‌های من</a>
                    </div>
                </div>
                <a class="nav-item nav-link" href="#">حسابداری</a>

            </div>

        </div>
        <img src="<?php echo $_SESSION['img']; ?>" class="img-fluid rounded-circle pull-left" style="width: 50px;">
        <div class="btn btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                <?php echo $_SESSION['lastname']; ?>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="userupdate.php?id=<?php echo $_SESSION['user_id']; ?>">اصلاح مشخصات کاربری</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item bg-danger text-white" href="index.php?logout=1">خروج از حساب کاربری</a>
            </div>
        </div>
    </div>
</nav>

<?php
require_once ("msgshow.php");
?>