<?php
require_once ('include.php');
extract($_POST);
$id=$_POST['id'];
$query = "DELETE FROM course WHERE id=$id";
if(!$conn->query($query))
    echo "حذف این دوره امکان پذیر نیست.";
else
    echo "ok";
?>