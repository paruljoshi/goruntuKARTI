<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css/pinboards.css" type="text/css" />
    <title>goruntuKarti</title>
</head>
<?php
session_start();
require("dbconnect.php");
$pinboard_id = $_POST['pinboard'];
$pin_id = $_POST['pin_id'];
$name = $_POST['name'];
$description = $_POST['description'];
?>
<body>
<?php
$mysqli = dbconnect();
echo $pin_id."<br>";
echo $name."<br>";
echo $pinboard_id."<br>";
echo $description."<br>";

$result = $mysqli->prepare("UPDATE pin SET pin_name=?, pinboard_id=?, pin_desc=? WHERE pin_id=?");
$result->bind_param('ssss', $name, $pinboard_id, $description, $pin_id);
if($result->execute()) {
    echo "Success!";
}
else {
    echo "Error!";
}
?>
</body>
</html>