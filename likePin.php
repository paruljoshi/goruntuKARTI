<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css/pin.css" type="text/css" />
    <title>goruntuKarti</title>
</head>
<?php
session_start();
require("dbconnect.php");
$username = $_GET['username'];
$pin_id=$_GET['pin_id'];

    $mysqli = dbconnect();
    $result = $mysqli->prepare("INSERT INTO `likes`(`username`, `pin_id`) VALUES (?,?)");
    $result->bind_param('ss',$username, $pin_id);
    $result->execute();
    header("location:pin.php?username=" . $username . "&pin_id=".$pin_id."");


?>
<body>


</body>
</html>