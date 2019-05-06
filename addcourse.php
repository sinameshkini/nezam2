<?php
require_once ("include.php");
require_once ("access.php");
user_access(1);

if (isset($_GET['insert'])){
    $code = convertoeng($_POST['code']);
    $name = $_POST['name'];
    $teacher = $_POST['teacher'];
    $cost = convertoeng($_POST['cost']);
    $place = $_POST['place'];
    $length = $_POST['length'];
    $activate = $_POST['activate'];
    $result = $conn->query("SELECT * FROM course WHERE code={$code};");
    if ($result->num_rows < 1){
        $query = "INSERT INTO course (`code`,`name`,teacher,`length`,cost,place,activate)
                                        VALUES('$code','$name','$teacher','$length','$cost','$place',$activate)";
        if ($conn->query($query)) {
            $_SESSION['msg'] = "عملیات با موفقیت انجام شد.";
            $_SESSION['msg_type'] = 1;
            require_once ("courses.php");
            exit;
        } else {
            echo $query;
            $_SESSION['msg'] = "خطا در سرور";
            $_SESSION['msg_type'] = 0;
            //exit;
        }
    }else{
        $_SESSION['msg'] = "این کد دوره قبلا ثبت شده است، لطفا اصلاح کنید و دوباره تلاش کنید";
        $_SESSION['msg_type'] = 0;
    }
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>پنل ادمین</title>
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
require_once ("adminpanel.php");
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <section class="col-6 border border-info px-0">
            <div class="card-header bg-info">
                <h2 class="card-title text-light text-center">ثبت دوره جدید</h2>
            </div>
            <div class="card-body h4">
                <form action="?insert=1" class="form-group" method="post" enctype="multipart/form-data" id="addcourse">
                    <?php
                    require_once ("msgshow.php");
                    ?>
                    <div class="form-inline row px-3 my-3">
                        <label for="" class="form-control-lable col-4">کد دوره</label>
                        <input type="text" name="code" placeholder="اعداد" class="form-control col-8"
                               <?php if(isset($code)){?>value="<?php echo $code;?>"<?php }?> >
                    </div>
                    <div class="form-inline row px-3 my-3">
                        <label for="" class="form-control-lable col-4">عنوان دوره</label>
                        <input type="text" name="name" placeholder="فقط حروف فارسی" class="form-control col-8"
                               <?php if(isset($name)){?>value="<?php echo $name;?>"<?php }?>>
                    </div>
                    <div class="form-inline row px-3 my-3">
                        <label for="" class="form-control-lable col-4">مدرس</label>
                        <input type="text" name="teacher" placeholder="فقط حروف فارسی" class="form-control col-8"
                               <?php if(isset($teacher)){?>value="<?php echo $teacher;?>"<?php }?>>
                    </div>
                    <div class="form-inline row px-3 my-3">
                        <label for="" class="form-control-lable col-4">زمان برگزاری</label>
                        <input type="text" name="length" placeholder="17 دی الی 19 دی 1397" class="form-control col-8"
                               <?php if(isset($length)){?>value="<?php echo $length;?>"<?php }?>>
                    </div>
                    <div class="form-inline row px-3 my-3">
                        <label for="" class="form-control-lable col-4">شهریه</label>
                        <input type="text" name="cost" placeholder="اعداد لاتین" class="form-control col-8"
                               <?php if(isset($cost)){?>value="<?php echo $cost;?>"<?php }?>>
                    </div>
                    <div class="form-inline row px-3 my-3">
                        <label for="" class="form-control-lable col-4">مکان برگزاری</label>
                        <input type="text" name="place" placeholder="دانشکده فنی..." class="form-control col-8"
                               <?php if(isset($place)){?>value="<?php echo $place;?>"<?php }?>>
                    </div>
                    <div class="form-group form-inline row px-3 my-3">
                        <label for="" class="form-control-lable col-4">وضعیت</label>
                        <select name="activate" id="" class="form-control col-8">
                            <option value="0">غیر فعال</option>
                            <option value="1">فعال</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-success submit col-4 offset-4 disabled" value="ثبت دوره">
                </form>
            </div>
        </section>
    </div>
</div>

</body>
<script src="Scripts/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script>
    jQuery.validator.setDefaults({
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback text-center');
            element.closest('.form-inline').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
    $( document ).ready( function () {
        $.validator.addMethod("regex", function (value, element, regexpr) {
            return regexpr.test(value);
        }, "فقط کاراکتر فارسی وارد شود");
        jQuery.validator.addMethod("noSpace", function (value, element) {
            return value.indexOf(" ") < 0 && value != "";
        }, "فاصله وارد نشود");


        $("#addcourse").validate({
            rules: {
                code: {
                    required: true,
                    minlength: 5,
                    maxlength: 10,
                    digits: true,
                    noSpace: true
                },
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 300,
                    regex: /^[0-9\u0600-\u06FF\s]+$/
                },
                teacher: {
                    required: true,
                    minlength: 3,
                    maxlength: 200,
                    regex: /^[\u0600-\u06FF\s]+$/
                },
                cost: {
                    required: true,
                    minlength: 1,
                    maxlength: 20,
                    digits: true,
                    noSpace: true
                },
                length: {
                    required: true,
                    minlength: 5,
                    maxlength: 200,
                    regex: /^[0-9\u0600-\u06FF\s]+$/
                },
                place: {
                    required: true,
                    minlength: 5,
                    maxlength: 300,
                    regex: /^[0-9\u0600-\u06FF\s]+$/
                }
            },
            messages: {
                code: {
                    required: "این فیلد نباید خالی باشد",
                    minlength: "حداقل 5 رقم",
                    maxlength: "حداکثر 10 رقم",
                    digits: "فقط اعداد مجاز هستند",
                    noSpace: "کاراکتر فاصله غیر مجاز است"
                },
                name: {
                    required: "این فیلد نباید خالی باشد",
                    minlength: "حداقل 3 کاراکتر",
                    maxlength: "حداکثر 300 کاراکتر",
                    regex: "فقط حروف فارسی مجاز هستند"
                },
                teacher: {
                    required: "این فیلد نباید خالی باشد",
                    minlength: "حداقل 3 کاراکتر",
                    maxlength: "حداکثر 200 کاراکتر",
                    regex: "فقط حروف فارسی مجاز هستند"
                },
                cost: {
                    required: "این فیلد نباید خالی باشد",
                    minlength: "حداقل 1 رقم",
                    maxlength: "حداکثر 20 رقم",
                    digits: "فقط اعداد مجاز هستند",
                    noSpace: "کاراکتر فاصله غیر مجاز است"
                },
                length: {
                    required: "این فیلد نباید خالی باشد",
                    minlength: "حداقل 5 کاراکتر",
                    maxlength: "حداکثر 200 کاراکتر",
                    regex: "فقط حروف فارسی مجاز هستند"
                },
                place: {
                    required: "این فیلد نباید خالی باشد",
                    minlength: "حداقل 5 کاراکتر",
                    maxlength: "حداکثر 300 کاراکتر",
                    regex: "فقط حروف فارسی مجاز هستند"
                }
            }
        })
        var form = $("#addcourse");
        $('input').on(' keyup' , function () {
            if(form.valid()){
                $('.submit').removeClass('disabled');
            }else if(!form.valid()){
                $('.submit').addClass('disabled');
            }
        })


    });

</script>
</html>
