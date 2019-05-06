<?php
require_once ("include.php");
require_once ("access.php");
user_access(1);

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>دریافت لیستها</title>
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
require_once ("adminpanel.php");
?>
<br class="mb-3">
<div class="container">
    <h2 class="text-right">دریافت لیستهای مربوط به دوره</h2>
</div>
<hr class="my-3">
<div class="container">

    <table class="table table-hover table-striped text-center table-bordered align-items-right justify-content-center table-responsive-sm">
        <thead class="thead-dark">
        <tr>
            <th>کد دوره</th>
            <th>عنوان دوره</th>
            <th>مدرس</th>
            <th>لیست ها</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM course WHERE activate=1");
        while ($row=$result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['code']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['teacher']; ?></td>
                <td>
                    <div class="dropright">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            لیستها
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form class="px-4 py-3">
                                <a href="" class="btn btn-info my-2 mx-2 btn-block">دریافت ژتون</a>
                                <div class="dropdown-divider"></div>
                                <a href="" class="btn btn-primary my-2 mx-2 col-5 px-0">لیست حضور و غیاب</a>
                                <a href="" class="btn btn-primary my-2 mx-2 col-5 px-0">صورت جلسه امتحان</a>
                                <div class="dropdown-divider"></div>
                                <a href="" class="btn btn-primary my-2 mx-2 col-5 px-0">لیست شماره های تلفن همراه</a>
                                <a href="" class="btn btn-primary my-2 mx-2 col-5 px-0">لیست ایمیل ها</a>
                                <div class="dropdown-divider"></div>
                                <a href="" class="btn btn-primary my-2 mx-2 btn-block px-0">لیست ثبت نام های تایید
                                    نشده</a>
                            </form>
                        </div>
                    </div>
                    <!--size button ha dorost nashod-->
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
</body>
<script src="Scripts/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</html>
