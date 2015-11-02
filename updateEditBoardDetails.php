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
$pinboard_name = $_POST['pinboard_name'];
$mysqli=dbconnect();
$newPinboard_name = $_POST["newPinboardName"];
$description = $_POST["description"];
$category ="other";

if(isset($_POST['privacy'])) {
    $privacy = "friends";
}else{
    $privacy = "everyone";
}

if (isset($_POST['category'])) {
    $category=$_POST['category'];
}

if($newPinboard_name==$pinboard_name) {
    $editBoard = $mysqli->prepare("UPDATE `pinboard` SET `pinboard_name`=?, `last_accessed`= CURRENT_TIMESTAMP, `date_created`=CURRENT_TIMESTAMP, `privacy`=?, `category`=?, `description`=? WHERE `username` = ? AND `pinboard_name`=?");
    $editBoard->bind_param('ssssss', $newPinboard_name, $privacy, $category, $description, $username, $pinboard_name);
    $editBoard->execute();
    header("location:pinboards.php?username=" . $username . "");
}
else {
    $addBoard = $mysqli->prepare("SELECT pinboard_name FROM pinboard WHERE username=? AND pinboard_name=? ");
    $addBoard->bind_param('ss', $username, $newPinboard_name);
    $addBoard->execute();
    $addBoard->bind_result($board_name);
    $addBoard->fetch();

    if ($board_name==$newPinboard_name) {
        header("location:editPinboardNameExists.php?username=" . $username . "&pinboard_name=" .$pinboard_name. "&newPinboard_name=" .$newPinboard_name. "");
    } else {
        $newBoard = $mysqli->prepare("INSERT INTO `pinboard`(`pinboard_id`, `pinboard_name`, `last_accessed`, `username`, `date_created`, `privacy`, `category`, `description`) VALUES (NULL,?,CURRENT_TIMESTAMP ,?,CURRENT_TIMESTAMP ,?,?,?)");
        $newBoard->bind_param('sssss', $newPinboard_name, $username, $privacy, $category, $description);
        $newBoard->execute();
        header("location:pinboards.php?username=" . $username . "");

    }
}
?>
</body>
</html>