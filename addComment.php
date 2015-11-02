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
$comment=$_POST['addComment'];
$pin_id=$_POST['pin_id'];
$repin_id=0;
$repin_id=$_POST['repin_id'];

if($repin_id==0) {
    $mysqli = dbconnect();
    $result = $mysqli->prepare("INSERT INTO `comment_pin`(`username`, `pin_id`, `comment`, `comment_time`) VALUES (?,?,?,CURRENT_TIMESTAMP )");
    $result->bind_param('sss',$username, $pin_id,$comment);
    $result->execute();
    header("location:pin.php?username=" . $username . "&pin_id=".$pin_id."");

}else{
    $mysqli = dbconnect();
    $result = $mysqli->prepare("INSERT INTO `comment_repin`(`username`, `repin_id`, `comment`, `comment_time`) VALUES (?,?,?,CURRENT_TIMESTAMP )");
    $result->bind_param('sss',$username, $repin_id,$comment);
    $result->execute();
    header("location:pin.php?username=" . $username . "&pin_id=".$pin_id."&repin_id=".$repin_id."");

}
?>
<body>


</body>
</html>