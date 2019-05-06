<?php
require_once ("include.php");
require_once ("access.php");
user_access(0);



?>

<html>
<head>
    <meta charset="UTF-8">
    <title>نتیجه پرداخت</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
require_once ("userpanel.php");
?>
<div class="container text-right">
    <h3 class="text-center d-inline-flex">نتیجه پرداخت</h3>
    <?php
    require_once("msgshow.php");
    ?>

    <table class="table table-hover text-center table-bordered table-responsive-sm">
        <thead class="thead-dark">
        <tr>
            <th class="text-center">نتیجه</th>
            <th class="text-center">مبلغ</th>
            <th class="text-center">کد پیگیری</th>
            <th class="text-center">شماره تراکنش</th>
            <th class="text-center">نام پذیرنده</th>
        </tr>
        </thead>
        <tbody>
            <tr class="">
                <td ><?php  ?></td>
                <td><?php  ?></td>
                <td><?php  ?></td>
                <td><?php  ?></td>
                <td ><?php  ?></td>
            </tr>
        </tbody>
    </table>

    <!--EEEEEEEEEEEEEEEEEEEEEEEEE-->
</div>


</body>
<script src="Scripts/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>

</script>
</html>
