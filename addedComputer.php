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
//$local_file = $_FILES['localLocation']['tmp_name'];



?>
<body>
    <?php
        $mysqli = dbconnect();
        $result = $mysqli->prepare("SELECT MAX(pin_id) FROM pin");
        $result->execute();
        $boards = $result->get_result();
        foreach ($boards as $row) {
            $max_pin_id = $row['MAX(pin_id)'];
        }
        $max_pin_id += 1;
        $uploaddir = 'C:/Users/Parul/Google Drive/Semester 2/Database/Project/goruntuKARTI/images';
        $uploadfile = $uploaddir . "image" . $max_pin_id . ".jpg";
        echo '<pre>';
        if (move_uploaded_file($_FILES['localLocation']['tmp_name'], $uploadfile)) {
            $result = $mysqli->prepare("INSERT INTO pin(pin_id, pin_name, url, pin_desc, image, pinboard_id) VALUES (NULL, ?, ?, ?, LOAD_FILE(?), ?)");
            $result->bind_param('sssss', $name, $uploadfile, $description, $uploadfile, $pinboard_id);
            if ($result->execute()) {
                echo "Success!";
            } else {
                echo "Database Error";
            }
        } else {
            echo "Sorry your file could not be uploaded. Check the php.ini file on the server to ensure that this action is allowed.\n";
        }


    /*if (move_uploaded_file($_FILES["localLocation"]["tmp_name"], $image_location)) {
                echo "The file ". basename( $_FILES["localLocation"]["name"]). " has been uploaded.";

            } else {
                echo "Sorry, there was an error uploading your file.";
            }*/

?>
</body>
</html>