<?php
/**
 * Created by PhpStorm.
 * User: Sina Meshkini
 * Date: 1/9/2019
 * Time: 4:53 PM
 */
require_once ("include.php");
require_once ("access.php");
user_access(1);

?>



    <nav class="navbar bg-light navbar-light nav-pills flex-column flex-sm-row navbar-expand-sm justify-content-start align-items-center m-0 p-0">
        <div class="container-fluid h4">
            <a href="index.php" class="navbar-brand"><img src="img/Golestan.png" class="img-fluid" style="width: 60px">
            <span class="">سامانه برگزاری دوره‌های نظام مهندسی گستان</span></a>
            <div class="d-flex row align-items-center" style="height: 50px;">
                <img src="<?php echo $_SESSION['img']; ?>" class="img-fluid img-circle" style="width: 50px;">
                <div class="btn btn-group col">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                        <?php echo $_SESSION['lastname']; ?>
                    </button>
                    <div class="dropdown-menu" style="z-index:2000;">
                        <a class="dropdown-item" href="userupdate.php?id=<?php echo $_SESSION['user_id']; ?>">اصلاح مشخصات کاربری</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item bg-danger text-white" href="index.php?logout=1">خروج از حساب کاربری</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <nav class="navbar bg-dark navbar-dark nav-pills flex-column flex-sm-row navbar-expand-sm align-items-center sticky-top m-0 p-0">
        <div class="container collapse navbar-collapse" id="mainmenutoggle">
            <div class="navbar-nav ml-auto h5">
                <a class="nav-item nav-link" href="index.php">خانه</a>
                <!-- DropDown -->
                <div class="dropdown">
                    <a href="#" class="nav-item nav-link dropdown dropdown-toggle" data-toggle="dropdown">دوره‌ها</a>
                    <div class="dropdown-menu">
                        <a href="addcourse.php" class="dropdown-item">تعریف دوره جدید</a>
                        <a href="courses.php" class="dropdown-item">مدیریت دوره‌ها</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class="nav-item nav-link dropdown dropdown-toggle" data-toggle="dropdown">کاربران</a>
                    <div class="dropdown-menu">
                        <a href="signup.php" class="dropdown-item">افزودن کاربر جدید</a>
                        <a href="usermanagment.php" class="dropdown-item">مدیریت کاربران</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class="nav-item nav-link dropdown dropdown-toggle" data-toggle="dropdown">حسابداری</a>
                    <div class="dropdown-menu">
                        <a href="signup.php" class="dropdown-item">ثبت هزینه</a>
                        <a href="usermanagment.php" class="dropdown-item">محاسبه درآمد</a>
                    </div>
                </div>
                <a class="nav-item nav-link" href="lists.php">دریافت لیستها</a>

            </div>

        </div>
    </nav>
<?php
require_once ("msgshow.php");
?>