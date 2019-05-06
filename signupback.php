<?php
require_once("include.php");

if(isset($_GET['insert'])) {
    $membernum = $_POST['membernum'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $codemeli = filter_var($_POST['codemeli'],FILTER_VALIDATE_INT);
    $parvanenum = $_POST['parvanenum'];
    $phone = $_POST['phone'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $hashedpass = md5($password.$salt);
    if($codemeli == null or strlen($codemeli) <10 or strlen($codemeli) >10){
        $_SESSION['msg'] = "کد ملی باید تنها شامل 10 رقم لاتین باشد";
        $_SESSION['msg_type'] = 0; 
    }else{
        $query = "SELECT * FROM user WHERE codemeli='$codemeli'";
        $result=$conn->query($query);
        $row=$result->fetch_assoc();
        if($row["codemeli"] != null){
            $_SESSION['msg'] = "این کد ملی قبلا ثبت شده است";
            $_SESSION['msg_type'] = 0;
        }elseif(strlen($password)<6){
            $_SESSION['msg'] = "کلمه عبور باید حداقل 6 کاراکتر باشد";
            $_SESSION['msg_type'] = 0;
        }elseif($password != $confirm){
            $_SESSION['msg'] = "کلمه عبور با یکدیگر مطابقت ندارند";
            $_SESSION['msg_type'] = 0;
        }else{
        $result=$conn->query("SELECT * FROM user WHERE membernum='$membernum'");
        $row=$result->fetch_assoc();
        if($row["membernum"] != null){
            $_SESSION['msg'] = "این شماره عضویت نظام مهندسی قبلا ثبت شده است";
            $_SESSION['msg_type'] = 0; 
        }
    }
    
    if($_FILES['photo']['size']>10){

    // file upload
    //$currentDir = getcwd();
    $uploadDirectory = "images/";

    //$errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

    $fileName = $_FILES['photo']['name'];
    $fileSize = $_FILES['photo']['size'];
    $fileTmpName  = $_FILES['photo']['tmp_name'];
    $fileType = $_FILES['photo']['type'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    $photoName = $codemeli . '.' . $fileExtension;
    $uploadPath = $uploadDirectory . $photoName;

    if (! in_array($fileExtension,$fileExtensions)) {
        $errors[] = "This file extension is not allowed. Please upload a jpeg or png or jpg file";
    }

    if ($fileSize > 500000) {
        $errors[] = "This file is more than 500KB. Sorry, it has to be less than or equal to 500KB";
    }

    if (empty($errors)) {
	//echo $fileTmpName;
	//echo $uploadPath;
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if (!$didUpload) {
            echo "An error occurred somewhere. Try again or contact the admin";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";
        }
    }
    
    $query = "INSERT INTO user (membernum,firstname,lastname,codemeli,parvanenum,phone,mobile,email,address,password,image)
     VALUES('$membernum','$firstname','$lastname','$codemeli','$parvanenum','$phone','$mobile','$email','$address','$hashedpass','$uploadPath')";
    $conn->query($query) or die("Unsuccsicfully signup,Database Error");
}else{
    $query = "INSERT INTO user (membernum,firstname,lastname,codemeli,parvanenum,phone,mobile,email,address,password)
    VALUES('$membernum','$firstname','$lastname','$codemeli','$parvanenum','$phone','$mobile','$email','$address','$hashedpass')";
   $conn->query($query) or die("Unsuccsicfully signup,Database Error");
}
echo "ثبت نام شما با موفقیت انجام شد";
$_SESSION['username'] = $codemeli;
$_SESSION['lastname'] = $lastname;
$_SESSION['membernum'] = $membernum;
require_once ("register.php");
exit;
    
}
    
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>افزودن کاربر جدید</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
//require_once ("adminpanel.php");
?>
<div id="header">
        <div class="container-fluid row justify-content-start align-items-center">
            <a href="index.php"><img src="img/Golestan.png" class="img-fluid"></a>
            <b class="h3">مرکز آموزشهای کوتاه مدت دانشگاه گلستان</b>
        </div>
    </div>
    <br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <section class="col-6 border border-info px-0">
                <div class="card-header bg-info">
                    <h2 class="card-title text-light text-center">ثبت نام در سامانه</h2>
                </div>
                <div class="card-body h4">
                    <?php require_once("msgshow.php"); ?>
                    <form action="?insert=1" class="form-group" method="post" enctype="multipart/form-data">
                        <div class="form-inline row px-3 my-3">
                            <label for="" class="form-control-lable col-4">نام</label>
                            <input type="text" name="firstname" placeholder="فقط حروف فارسی" class="form-control col-8" required>
                        </div>
                        <div class="form-inline row px-3 my-3">
                            <label for="" class="form-control-lable col-4">نام خانوادگی</label>
                            <input type="text" name="lastname" placeholder="فقط حروف فارسی" class="form-control col-8" requir>
                        </div>
                        <div class="form-inline row px-3 my-3">
                            <label for="" class="form-control-lable col-4">کد ملی</label>
                            <input type="text" name="codemeli" placeholder="10 رقم اعداد لاتین بدون فاصله و خط تیره" class="form-control col-8" requir>
                        </div>
                        <div class="form-inline row px-3 my-3">
                            <label for="" class="form-control-lable col-4">کلمه عبور</label>
                            <input type="password" name="password" placeholder="کلمه عبور..." class="form-control col-8" required>
                        </div>
                        <div class="form-inline row px-3 my-3">
                            <label for="" class="form-control-lable col-4">تکرار کلمه عبور</label>
                            <input type="password" name="confirm" placeholder="کلمه عبور..." class="form-control col-8" required>
                        </div>
                        <div class="form-inline row px-3 my-3">
                            <label for="" class="form-control-lable col-4">شماره عضویت نظام مهندسی</label>
                            <input type="text" name="membernum" placeholder="اعداد لاتین بدون فاصله و خط تیره" class="form-control col-8" requir>
                        </div>
                        <div class="form-inline row px-3 my-3">
                            <label for="" class="form-control-lable col-4">شماره پروانه اشتغال به کار</label>
                            <input type="text" name="parvanenum" placeholder="حروف و اعداد لاتین" class="form-control col-8" required>
                        </div>
                        <div class="form-inline row px-3 my-3">
                            <label for="" class="form-control-lable col-4">ایمیل</label>
                            <input type="email" name="email" placeholder="مثال: example@gmail.com" class="form-control col-8" required>
                        </div>
                        <div class="form-inline row px-3 my-3">
                            <label for="" class="form-control-lable col-4">شماره موبایل</label>
                            <input type="tel" name="mobile" placeholder="*********09" class="form-control col-8" required>
                        </div>
                        <div class="form-inline row px-3 my-3">
                            <label for="" class="form-control-lable col-4">شماره تماس ثابت</label>
                            <input type="tel" name="phone" placeholder="*********09" class="form-control col-8" required>
                        </div>
                        <div class="form-inline row px-3 my-3">
                            <label for="" class="form-control-lable col-4">آدرس</label>
                            <input type="text" name="address" placeholder="گرگان، خیابان پاسداران ..." class="form-control col-8" required>
                        </div>
                        <div class="form-inline row px-3 my-3">
                            <label for="" class="form-control-lable col-4">عکس پرسنلی</label>
                            <input type="file" name="photo" class="form-control col-8" required>
                        </div>
                        <p class="form-text text-monospace">فایل با فرمت jpg و حجم کمتر از 500 کیلوبایت</p>
                        <input type="submit" class="btn btn-success col-4 offset-4" value="ثبت کاربر">
                    </form>
                </div>
            </section>
        </div>
    </div>

</body>
<script src="Scripts/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</html>