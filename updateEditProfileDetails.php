<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>checkUser</title>
</head>

<body>
<?php
session_start();
require_once("dbconnect.php");
$username=$_GET["username"];
$mysqli=dbconnect();
$newName=$_POST["newName"];
$newUsername= $_POST['newUsername'];
$newUseremail=$_POST["newUseremail"];
$newPassword=$_POST['newPassword'];
$samePassword=$_POST['samePassword'];


    if(empty($newPassword) && empty($samePassword)) {
        $editProfile = $mysqli->prepare("UPDATE `user` SET `name`=?,`useremail`=?, `last_update`= CURRENT_TIMESTAMP  WHERE `username` = ?");
        $editProfile->bind_param('sss',$newName ,$newUseremail, $username);
        $editProfile->execute();
        header("location:updatedEditProfile.php?username=" . $username . "");
    }

    else {
        if ($newPassword == $samePassword) {
            $editProfile = $mysqli->prepare("UPDATE `user` SET `name`=?,`useremail`=?,`password`=?, `last_update`= CURRENT_TIMESTAMP  WHERE `username` = ?");
            $editProfile->bind_param('ssss', $newName, $newUseremail, $newPassword, $username);
            $editProfile->execute();
            header("location:updatedEditProfile.php?username=" . $username . "");
        } else {
            header("location:reEnterPassword.php?username=" . $username . "");
        }

    }
?>
</body>
</html>