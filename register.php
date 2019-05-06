<?php
require_once ("include.php");
require_once ("access.php");
user_access(0);

if(isset($_GET['register'])){
    $membernum = $_GET['user'];
    $courseid = $_GET['course'];
    $query = "INSERT INTO register (course_id,student_id,pay_id) VALUES($courseid,$membernum,0)";
    if($conn->query($query)){
        $_SESSION['msg'] = "به دوره‌های شما اضافه شد، لطفا در قسمت <a href='mycourses.php'>دوره‌های من</a> مراحل ثبت نام و پرداخت شهریه را تکیل کنید ";
        $_SESSION['msg_type'] = 1;
    }else{
        echo $query;
        $_SESSION['msg'] = "عملیات ثبت دوره با خطا مواجه شد. لطفا به پشتیبانی اطلاع دهید";
        $_SESSION['msg_type'] = 0;
    }
}

if(isset($_GET['del'])){
    $query = "DELETE FROM register WHERE course_id = {$_GET['del']} AND student_id={$_SESSION['user_id']} AND pay_id!=2";
    if($conn->query($query)){
        $_SESSION['msg'] = "دوره با موفقیت حذف شد";
        $_SESSION['msg_type'] = 1;
    }else{
        $_SESSION['msg'] = "عملیات حذف دوره با خطا مواجه شد. لطفا به پشتیبانی اطلاع دهید";
        $_SESSION['msg_type'] = 0;
    }
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>ثبت نام دوره جدید</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
<?php
require_once ("userpanel.php");
?>
<div class="container text-right">
    <h3 class="text-center d-inline-flex">لیست دوره ها</h3>
    <?php
    require_once("msgshow.php");
    ?>
    <!-- <a href="addcourse.php" class="btn btn-primary d-inline-flex mr-5">+ افزودن دوره جدید</a> -->

    <table class="table table-hover text-center table-bordered table-responsive-sm">
        <thead class="thead-dark">
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">نام دوره</th>
            <th class="text-center">مدرس</th>
            <th class="text-center">تاریخ برگزاری</th>
            <th class="text-center">مبلغ شهریه (ريال)</th>
            <th class="text-center">وضعیت</th>
            <th class="text-center">عملیات</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT *  FROM course where activate=1";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr class="">
                <td><?php echo $row['code']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['teacher']; ?></td>
                <td><?php echo $row['length'] ?></td>
                <td><?php echo $row['cost'] ?></td>
                <?php
                $query1 = "SELECT * FROM register WHERE course_id={$row['id']} AND student_id={$_SESSION['user_id']};";
                $result1 = $conn->query($query1);
                if($result1->num_rows < 1){
                    //not regiter
                    ?>
                    <td><span class="badge badge-warning badge-pill">ثبت نام نشده</span></td>
                    <td><a href="register.php?register=1&course=<?php echo $row['id']?>&user=<?php echo $_SESSION['user_id']; ?>" class="btn btn-success">ثبت نام</td>
                    <?php
                }else{
                    ?>
                    <td><span class="badge badge-warning badge-pill">قبلا ثبت نام شده</span></td>
                    <?php
                    $row1 = $result1->fetch_assoc();
                    if($row1['pay_id']==2){
                        ?>
                        <td><span class="badge badge-warning badge-pill">امکان لغو ثبت نام وجود ندارد</span></td>
                        <?php
                    }else{
                        ?>
                        <td><a href="?del=<?php echo $row['id'] ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>
                        <?php
                    }
                    ?>
                <?php
                }
                ?> 
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

    <!--EEEEEEEEEEEEEEEEEEEEEEEEE-->
    </div>


</body>
<script src="Scripts/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</html>
