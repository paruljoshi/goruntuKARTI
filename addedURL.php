<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css/pinboards.css" type="text/css" />
    <title>goruntuKarti</title>
</head>
<?php
session_start();
require("dbconnect.php");
$name = $_POST['name'];
$description = $_POST['description'];
$pinboard_id = $_POST['pinboard'];
$url = $_POST['url'];
?>
<body>

<?php
$mysqli = dbconnect();
$result = $mysqli->prepare("SELECT MAX(pin_id) FROM pin");
$result->execute();
$boards=$result->get_result();
foreach($boards as $row){
    $max_pin_id=$row['MAX(pin_id)'];
}
$max_pin_id += 1;
$image_location = 'C:\Users\Parul\Google Drive\Semester 2\Database\Project\goruntuKARTI\images\image'.$max_pin_id.'.jpg';
file_put_contents($image_location, file_get_contents($url));
$result = $mysqli->prepare("INSERT INTO pin(pin_id, pin_name, url, pin_desc, image, pinboard_id) VALUES (NULL, ?, ?,?,?, ?)");
$result->bind_param('sssss', $name, $image_location, $description, $image_location, $pinboard_id);
if($result->execute()) {
    echo "success!";
}
else {
    echo "error!";
}
?>
</body>
</html>