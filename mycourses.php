<?php
require_once ("include.php");
require_once ("access.php");
user_access(0);

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
// if(isset($_POST['referenceId'])) {
//     if ($_POST['referenceId'] != "") {
//         $client = new SoapClient('https://ikc.shaparak.ir/XVerify/Verify.xml', array('soap_version' => SOAP_1_1));
//         $params['token'] = $_POST["token"]; // please replace currentToken
//         $params['merchantId'] = "A1FF";
//         $params['referenceNumber'] = $_POST['referenceId'];
//         $params['sha1Key'] = '22338240992352910814917221751200141041845518824222260';
//         $result = $client->__soapCall("KicccPaymentsVerification", array($params));


//     } else {

//         $client = new SoapClient('https://ikc.shaparak.ir/XToken/Tokens.xml', array('soap_version' => SOAP_1_1));

//         $params['amount'] = "1000";
//         $params['merchantId'] = "A1FF";
//         $params['invoiceNo'] = "12345678";
//         $params['paymentId'] = "12345678";
// //$params['specialPaymentId'] = "123456789123";
//         $params['revertURL'] = "http://healthtime.ir/payment.php";
// //$params['description'] = "aaaaa";
//         $result = $client->__soapCall("MakeToken", array($params));

//     }
// }

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>دوره‌های من</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
require_once ("userpanel.php");
?>
<div class="container text-right">
    <h3 class="text-center d-inline-flex">دوره‌های من</h3>
    <?php
    require_once("msgshow.php");
    ?>

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
        $query = "SELECT course.*,pay_status.lable  FROM course,register,pay_status WHERE course.id=register.course_id AND student_id={$_SESSION['user_id']} AND pay_id=pay_status.id;";
//        echo $query;
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr class="">
                <td ><?php echo $row['code']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['teacher']; ?></td>
                <td><?php echo $row['length'] ?></td>
                <td ><?php echo $row['cost'] ?></td>
                <td><?php echo $row['lable'] ?></td>
                <td>
                    <!-- <a href="?delete=" class="delete " data-toggle="modal" course-name="<?php echo $row['name']; ?>" course-id="<?php echo $row['id']; ?>" data-target="#exampleModal"><i class="far fa-trash-alt"></i></a> -->
                    <button code="<?php echo $row['id']; ?>" class="btn btn-primary payment" >پرداخت</button>
                </td>
                <?php
                ?> 
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

    </div>
<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <a href="" class="btn btn-danger dlcourse mx-2">بله، میخواهم حذف کنم</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div> -->

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('.delete').click(function () {
            var name = $('.delete').attr('course-name');
            var id = $('.delete').attr('course-id');
            $('.text-delete').text(name);
            console.log(id)
            $('.dlcourse').attr("href" , '?delete='+id)
        });
        $('.payment').on('click' , function (e) {
            e.preventDefault();
            var id = $(this).attr('code');
            $.ajax({
                url:'payment.php',
                type:"POST",
                data:{act:'maketoken', id:id },
                success : function (msg) {
                    console.log(msg)
                },
                error:function (msg) {
                    console.log(msg)
                }
            })
        });



    })
</script>
</html>
