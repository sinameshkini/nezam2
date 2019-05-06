<?php

$conn = new mysqli("localhost","admin","M@$!n@m75","nezam_pro");
// var_dump($conn);
if($conn){
    $conn->set_charset("utf8");
}else{
    $_SESSION['msg'] = "خطای 101 - لطفا به ادمین اطلاع دهید";
    $_SESSION['msg_type'] = 0;
}
