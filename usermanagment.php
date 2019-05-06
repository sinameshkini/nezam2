<?php
require_once ("include.php");
require_once ("access.php");
user_access(1);

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>مدیریت کاربران</title>
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
require_once ("adminpanel.php");
?>
<!--header/ modiriat karbaran class active-->
<br class="mb-3">
<div class="container">
    <h2 class="text-right">مدیریت کاربران</h2>
</div>
<hr class="my-3">
<div class="container">
    <div class="form-group row">
        <a href="signup.php" class="btn btn-info  offset-4">ثبت کاربر جدید</a>
        <form action="usermanagment.php" method="get" class="input-group col-5 mb-3">
            <div class="input-group-prepend">
                <input type="text" name="search" class="form-control" placeholder="کد ملی، نام خانوادگی" aria-label="" aria-describedby="">
                <button type="submit" class="btn btn-default rounded">
                    جستجو
                </button>
            </div>
        </form>
    </div>
    <table class="table table-hover table-striped text-center table-bordered align-items-right justify-content-center table-responsive-sm">
        <thead class="thead-dark">
        <tr>
            <th>ردیف</th>
            <th>شماره نظام مهندسی</th>
            <th>نام</th>
            <th>نام خانوادگی</th>
            <th>کد ملی</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $counter = 1;
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $query = "SELECT * FROM user WHERE lastname LIKE '%$search%' OR codemeli LIKE '%$search%' AND user_type=0";
            $result = $conn->query($query);
        }else{
            $query = "SELECT * FROM user WHERE user_type=0";
            $result = $conn->query($query);
        }
        while ($row = $result->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $counter++; ?></td>
            <td><?php echo $row['membernum']; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['codemeli']; ?></td>
            <td>
                <div class="dropright">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        جزئیات </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <form class="px-4 py-3">
                            <p class="text-center">شماره تماس همراه</p>
                            <p class="text-center"><?php echo $row['mobile']; ?></p>
                            <div class="dropdown-divider"></div>
                            <p class="text-center">ایمیل</p>
                            <p class="text-center"><?php echo $row['email']; ?></p>
                            <div class="dropdown-divider"></div>
                            <img src="<?php if ($row['img']==null){
                                echo "img/profiles/nobody.jpg";
                            }else{
                                echo $row['img'];
                            } ?>" class="img-fluid my-3" alt="" srcset="">
                        </form>
                        <div class="dropdown-divider"></div>
                        <a href="" class="btn btn-warning my-2 mx-2 col-5 ">اصلاح</a>
                        <a href="" class="btn btn-primary my-2 mx-2 col-5 ">پنل کاربری</a>
                    </div>
                </div>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <!--End teble-->
</div>

</body>
<script src="Scripts/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</html>
