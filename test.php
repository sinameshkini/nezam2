<?php
echo "fuck";
if(isset($_POST['test'])){
    echo $_POST['test'];
}
    var_dump($_FILES);
$uploadDirectory = "images/";
$fileExtensions = ['jpg', 'png', 'jpeg']; // Get all the file extensions
$fileName = $_FILES['img']['name'];
$fileSize = $_FILES['img']['size'];
$fileTmpName = $_FILES['img']['tmp_name'];
$fileType = $_FILES['img']['type'];
$fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
$photoName = 'sina.' . $fileExtension;
$uploadPath = $uploadDirectory . $photoName;
$didUpload = move_uploaded_file($fileTmpName, $uploadPath);
if($didUpload){
    echo "ok";
}else{
    echo "error";
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <form method="post" action="test.php">
        <input type="file" id="" class="form-control" name="img" >
        <input id="" class="form-control" name="test" type="text">
        <button id="" class="form-control" type="submit">send</button>
    </form>
</body>
</html>