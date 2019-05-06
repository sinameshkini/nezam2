<?php
if(!isset($_SESSION['user_type'])){
    require_once("index.php");
    exit;
}

function user_access($type){
    if($_SESSION['user_type']<$type){
        require_once("index.php");
        exit;
    }
}