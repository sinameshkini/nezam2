<?php
require_once ("include.php");
require_once ("access.php");
user_access(1);

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
</body>
<script src="Scripts/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</html>
