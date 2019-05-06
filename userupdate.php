<?php
require_once ("include.php");
if(isset($_GET['update'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $nationcode = convertoeng($_POST['nationcode']);
    $membernum = convertoeng($_POST['membernum']);
    $parvanenum = convertoeng($_POST['parvanenum']);
    $email = $_POST['email'];
    $mobile = convertoeng($_POST['mobile']);
    $phone = convertoeng($_POST['phone']);
    $address = $_POST['address'];
    $result = $conn->query("SELECT * FROM user WHERE codemeli='$nationcode' AND id!={$_SESSION['user_id']}");
    $row = $result->fetch_assoc();
    if ($row["codemeli"] == null) {
        if(strlen($nationcode)==10){
            $result = $conn->query("SELECT * FROM user WHERE membernum='$membernum' AND id!={$_SESSION['user_id']}");
            $row = $result->fetch_assoc();
            if ($row["membernum"] == null) {
                $result = $conn->query("SELECT * FROM user WHERE email='$email' AND id!={$_SESSION['user_id']}");
                $row = $result->fetch_assoc();
                if ($row["email"] == null) {
                    $result = $conn->query("SELECT * FROM user WHERE mobile='$mobile' AND id!={$_SESSION['user_id']}");
                    $row = $result->fetch_assoc();
                    if ($row["mobile"] == null) {
                        $query = "UPDATE user SET firstname='$firstname',lastname='$lastname',codemeli='$nationcode',membernum='$membernum',
                                  parvanenum='$parvanenum',email='$email',mobile='$mobile',phone='$phone',address='$address' WHERE id={$_GET['update']};";
                        if ($conn->query($query)) {
                            $_SESSION['msg'] = "اطلاعات کاربری شما با موفقیت تغییر کرد";
                            $_SESSION['msg_type'] = 1;
                            require_once ("user.php");
                            exit;
                        } else {
                            echo $query;
                            unlink($uploadPath);
                            $_SESSION['msg'] = "خطا در سرور";
                            $_SESSION['msg_type'] = 0;
                            //exit;
                        }
                    } else {
                        $_SESSION['msg'] = "این شماره همراه قبلا ثبت شده است";
                        $_SESSION['msg_type'] = 0;
                    }
                } else {
                    $_SESSION['msg'] = "این ایمیل قبلا ثبت شده است";
                    $_SESSION['msg_type'] = 0;
                }
            }else{
                $_SESSION['msg'] = "این شماره عضویت نظام مهندسی قبلا ثبت شده است";
                $_SESSION['msg_type'] = 0;
            }
        }else{
            $_SESSION['msg'] = "کد ملی باید 10 رقم لاتین بدون خط فاصله باشد";
            $_SESSION['msg_type'] = 0;
        }
    } else {
        $_SESSION['msg'] = "این کد ملی قبلا ثبت شده است";
        $_SESSION['msg_type'] = 0;
    }
}

if(isset($_GET['id'])){
    $result = $conn->query("SELECT * FROM user WHERE id={$_GET['id']};");
    $row = $result->fetch_assoc();
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $nationcode = $row['codemeli'];
    $membernum = $row['membernum'];
    $parvanenum = $row['parvanenum'];
    $email = $row['email'];
    $mobile = $row['mobile'];
    $phone = $row['phone'];
    $address = $row['address'];
}

?>


<html>

<head>
    <meta charset="UTF-8">
    <title>اصلاح مشخصات کاربر</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
require_once ("userpanel.php");
?>

<br>
<div class="container mt-5">
    <div class="row justify-content-center">
        <section class="col-6 border border-info px-0">
            <div class="card-header bg-info">
                <h2 class="card-title text-light text-center">اصلاح مشخصات کاربری</h2>
            </div>
            <div class="card-body h4">
                <form action="?update=<?php echo $_SESSION['user_id'];?>" class="form-group" method="post" enctype="multipart/form-data" id="signup">
                    <?php
                    require_once ("msgshow.php");
                    ?>
                    <div class="form-inline row px-3 my-3">
                        <label for="" class="form-control-lable col-4">نام</label>
                        <input type="text" name="firstname" placeholder="فقط حروف فارسی" class="form-control col-8"
                               <?php if(isset($firstname)){?>value="<?php echo $firstname;?>"<?php }?> >
                    </div>
                    <div class="form-inline row px-3 my-3">
                        <label for="" class="form-control-lable col-4">نام خانوادگی</label>
                        <input type="text" name="lastname" placeholder="فقط حروف فارسی" class="form-control col-8"
                               <?php if(isset($lastname)){?>value="<?php echo $lastname;?>"<?php }?>>
                    </div>
                    <div class="form-inline row px-3 my-3">
                        <label for="" class="form-control-lable col-4">کد ملی</label>
                        <input type="text" name="nationcode" placeholder="10 رقم اعداد لاتین بدون فاصله و خط تیره" class="form-control col-8"
                               <?php if(isset($nationcode)){?>value="<?php echo $nationcode;?>"<?php }?>>
                    </div>
                    <div class="form-inline row px-3 my-3">
                        <label for="" class="form-control-lable col-4">شماره عضویت نظام مهندسی</label>
                        <input type="text" name="membernum" placeholder="اعداد لاتین بدون فاصله و خط تیره" class="form-control col-8"
                               <?php if(isset($membernum)){?>value="<?php echo $membernum;?>"<?php }?>>
                    </div>
                    <div class="form-inline row px-3 my-3">
                        <label for="" class="form-control-lable col-4">شماره پروانه اشتغال به کار</label>
                        <input type="text" name="parvanenum" placeholder="اعداد لاتین" class="form-control col-8"
                               <?php if(isset($parvanenum)){?>value="<?php echo $parvanenum;?>"<?php }?>>
                    </div>
                    <div class="form-inline row px-3 my-3">
                        <label for="" class="form-control-lable col-4">ایمیل</label>
                        <input type="email" name="email" placeholder="مثال: example@gmail.com" class="form-control col-8"
                               <?php if(isset($email)){?>value="<?php echo $email;?>"<?php }?>>
                    </div>
                    <div class="form-inline row px-3 my-3">
                        <label for="" class="form-control-lable col-4">شماره موبایل</label>
                        <input type="tel" name="mobile" placeholder="*********09" class="form-control col-8"
                               <?php if(isset($mobile)){?>value="<?php echo $mobile;?>"<?php }?>>
                    </div>
                    <div class="form-inline row px-3 my-3">
                        <label for="" class="form-control-lable col-4">شماره تلفن</label>
                        <input type="tel" name="phone" placeholder="********017" class="form-control col-8"
                               <?php if(isset($phone)){?>value="<?php echo $phone;?>"<?php }?>>
                    </div>
                    <div class="form-inline row px-3 my-3">
                        <label for="" class="form-control-lable col-4">آدرس</label>
                        <input type="text" name="address" placeholder="گرگان، خیابان پاسداران ..." class="form-control col-8"
                               <?php if(isset($address)){?>value="<?php echo $address;?>"<?php }?>>
                    </div>
                    <input type="submit" class="btn btn-success submit col-4 offset-4 disabled" value="ویرایش">
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


        $("#signup").validate({
            rules: {
                firstname: {
                    required: true,
                    minlength: 3,
                    maxlength: 200,
                    regex: /^[\u0600-\u06FF\s]+$/,
                    noSpace: true
                },
                lastname: {
                    required: true,
                    minlength: 3,
                    maxlength: 200,
                    regex: /^[\u0600-\u06FF\s]+$/,
                    noSpace: true
                },
                nationcode: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true,
                    noSpace: true
                },
                membernum: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true,
                    noSpace: true
                },
                parvanenum: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true,
                    noSpace: true
                },
                password: {
                    required: true,
                    minlength: 6,
                },
                confirm: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true,
                    minlength: 11,
                    maxlength: 11,
                    digits: true,
                },
                phone: {
                    required: true,
                    minlength: 11,
                    maxlength: 11,
                    digits: true,
                },
                address: {
                    required: true,
                    minlength: 5,
                    maxlength: 1000,
                    regex: /^[\u0600-\u06FF\s]+$/,
                },
                img: {
                    extension: "jpg|jpeg|png|JPG|JPEG|PNG"
                }
            },
            messages: {
                firstname: {
                    required: "نام کاربر نباید خالی باشد",
                    minlength: "حداقل تعداد حروف 3 کاراکتر است",
                    maxlength: "حداکثر تعداد حروف 200 کاراکتر است",
                    regex: "فقط حروف فارسی مجاز است",
                    noSpace: "از کاراکتر فاصله استفاده نکنید"
                },
                lastname: {
                    required: "نام خانوادگی کاربر نباید خالی باشد",
                    minlength: "حداقل تعداد حروف 3 کاراکتر است",
                    maxlength: "حداکثر تعداد حروف 200 کاراکتر است",
                    regex: "فقط حروف فارسی مجاز است",
                    noSpace: "از کاراکتر فاصله استفاده نکنید"
                },
                nationcode: {
                    required: "این فیلد اجباری است",
                    minlength: "کد ملی شامل 10 رقم بدون فاصله و خط تیره است",
                    maxlength: "کد ملی شامل 10 رقم بدون فاصله و خط تیره است",
                    digits: "کد ملی فقط شامل اعداد است",
                    noSpace: "از فاصله استفاده نکنید"
                },
                membernum: {
                    required: "این فیلد اجباری است",
                    minlength: "شماره عضویت نظام مهندسی شامل 10 رقم بدون فاصله و خط تیره است",
                    maxlength: "شماره عضویت نظام مهندسی شامل 10 رقم بدون فاصله و خط تیره است",
                    digits: "شماره عضویت نظام مهندسی فقط شامل اعداد است",
                    noSpace: "از فاصله استفاده نکنید"
                },
                parvanenum: {
                    required: "این فیلد اجباری است",
                    minlength: "شماره پروانه شامل 10 رقم بدون فاصله و خط تیره است",
                    maxlength: "شماره پروانه شامل 10 رقم بدون فاصله و خط تیره است",
                    digits: "شماره پروانه فقط شامل اعداد است",
                    noSpace: "از فاصله استفاده نکنید"
                },
                password: {
                    required: "این فیلد اجباری است",
                    minlength: "حداقل 6 کاراکتر مورد نیاز است",
                },
                confirm: {
                    required: "این فیلد اجباری است",
                    minlength: "حداقل 6 کاراکتر مورد نیاز است",
                    equalTo: "کلمه عبور یکسان نیست!"
                },
                email: {
                    required: "این فیلد اجباری است",
                    email: "لطفا ایمیل صحیح وارد کنید"
                },
                mobile: {
                    required: "این فیلد اجباری است",
                    minlength: "شماره 11 رقم میباشد",
                    maxlength: "شماره 11 رقم میباشد",
                    digits: "فقط شامل اعداد میباشد"
                },
                phone: {
                    required: "این فیلد اجباری است",
                    minlength: "شماره 11 رقم میباشد",
                    maxlength: "شماره 11 رقم میباشد",
                    digits: "فقط شامل اعداد میباشد"
                },
                address: {
                    required: "این فیلد اجباری است",
                    minlength: "حداقل  تعداد کاراکتر 5",
                    maxlength: "حداکثر 1000 کاراکتر",
                    regex: "فقط از حروف فارسی استفاده کنید"
                },
                img: {
                    extension: "jpg|jpeg|png|JPG|JPEG|PNG فرمتهای مجاز:"
                }
            }
        })
        var form = $("#signup");
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
