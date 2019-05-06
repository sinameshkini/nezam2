<?php
require_once ("include.php");
require_once ("access.php");
user_access(1);
if(isset($_GET['active'])){
    $result = $conn->query("UPDATE course SET activate=1 WHERE id={$_GET['active']}");
}
if(isset($_GET['deactive'])){
    $result = $conn->query("UPDATE course SET activate=0 WHERE id={$_GET['deactive']}");
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>مدیریت دوره ها</title>
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<div>
<?php
require_once ("adminpanel.php");
?>
<div class="container">
<div class="container text-right">
    <h3 class="text-center d-inline-flex">لیست دوره ها</h3>
    <a href="addcourse.php" class="btn btn-primary d-inline-flex mr-5">+ افزودن دوره جدید</a>
</div>
    <div class="alert alert-danger ajax-msg mt-5 text-center d-none"></div>
<?php
require_once ("msgshow.php");

$result = $conn->query("SELECT * FROM course;");

if ($result->num_rows < 1) { ?>
    <div class="alert  alert-info text-center">
        <h2 class="alert-heading">ادمین عزیز</h2>
        <hr>
        <h3>هیچ دوره ای در پایگاه داده وجود ندارد</h3>
        <a href="addcourse.php" class="btn btn-primary">+ افزودن دوره جدید</a>
    </div>

    <?php

} else {
    ?>


    <table class="table table-hover text-center table-bordered table-responsive-sm">
        <thead class="thead-dark">
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">کد دوره</th>
            <th class="text-center">نام دوره</th>
            <th class="text-center">مدرس</th>
            <th class="text-center">مبلغ شهریه (ريال)</th>
            <th class="text-center">تاریخ برگزاری</th>
            <th class="text-center">محل برگزاری</th>
            <th class="text-center">عملیات</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $counter =1;
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr class="item<?php echo $row['id'] ?>">
                <td><?php echo $counter++; ?></td>
                <td><?php echo $row['code']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['teacher']; ?></td>
                <td><?php echo $row['cost']; ?></td>
                <td><?php echo $row['length']; ?></td>
                <td><?php echo $row['place']; ?></td>
                <td>
                    <a class="px-2" href="?edit="><i class="far fa-edit"></i></a>
                    <a href="?delete=" class="delete" data-toggle="modal" course-name="<?php echo $row['name']; ?>" course-id="<?php echo $row['id']; ?>" data-target="#exampleModal"><i class="far fa-trash-alt"></i></a>
                    <?php if ($row['activate'] ==1 ) {
                    ?>
                    <a href="?deactive=<?php echo $row['id']; ?>"><i class="fas fa-eye"></i></a>
                    <?php
                    }
                    else { ?>
                    <a href="?active=<?php echo $row['id']; ?>"><i class="fas fa-eye-slash"></i></a>
                  <?php  }
?>

                </td>
            </tr>
            <?php

        }
        ?>
        </tbody>
    </table>

    <!--EEEEEEEEEEEEEEEEEEEEEEEEE-->
    </div>
    <?php

}
?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اخطار</h5>
                </div>
                <div class="modal-body d-flex justify-content-start" id="myModalBody">
                    <span class="h4">آیا مطمئنید میخواهید دوره <span class="h4 text-delete font-weight-bold"></span> را حذف کنید؟</span>
                </div>
                <div class="modal-footer d-flex justify-content-start">
                    <button data-dismiss="modal" class="btn btn-danger dlcourse mx-2">بله، میخواهم حذف کنم</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="Scripts/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        var id;
        $('.delete').click(function () {
            var name = $(this).attr('course-name');
             id = $(this).attr('course-id');
            $('.text-delete').text(name);

        });
         $('.dlcourse').click(function () {
             $.ajax({
                     type:"POST",
                     url:'ajax.php',
                     data: {
                         "id":id
                     },
                     success:function (msg) {
                         if(msg == "ok") {
                             $('.item'+id).remove();
                         }
                         else {
                             $('.ajax-msg').text(msg);
                             $('.ajax-msg').removeClass('d-none');
                             $('.ajax-msg').fadeOut(5000);
                         }


                 },
                 error: function (msg) {
                     $('.ajax-msg').text(msg);
                     $('.ajax-msg').show();
                     $('.ajax-msg').fadeOut(5000);

             }
         })

        });



    })
</script>
</html>
