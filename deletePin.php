<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css/pin.css" type="text/css" />
    <title>goruntuKarti</title>
</head>
<body>
<?php
    session_start();
    require("dbconnect.php");
    $username = $_GET['username'];
    $pin_id = $_GET['pin_id'];
    $mysqli = dbconnect();
    $result = $mysqli->prepare("SELECT username FROM pin, pinboard WHERE pin.pinboard_id = pinboard.pinboard_id AND  pin_id = ?");
    $result->bind_param('s',$pin_id);
    $result->execute();
    $result->bind_result($pin_owner);
    while($result->fetch()){
        if ($pin_owner != $username){
            echo "Sorry, only the owner of this pin can delete it.";
        }
        else {
            $mysqli2 = dbconnect();
            $result2 = $mysqli2->prepare("DELETE FROM pin WHERE pin_id = ?");
            $result2->bind_param('s',$pin_id);
            if($result2->execute()) {
                echo "Image has been deleted.";
            }
            else {
                echo "Sorry. There was an unknown error. Please try again later.";
            }
        }
    }
?>
</body>
</html>