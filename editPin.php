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
    if ($pin_owner == $username){
        $mysqli2 = dbconnect();
        $result2 = $mysqli2->prepare("SELECT pin_name, pin_desc, pinboard_name FROM pin, pinboard WHERE pin_id = ? AND pin.pinboard_id = pinboard.pinboard_id");
        $result2->bind_param('s',$pin_id);
        $result2->execute();
        $boards = $result2->get_result();
        foreach($boards as $row){
            echo 'EDIT PIN <br><br>
                <form id="editPin" action="editedPin.php" method="post">
                    Name: <input type = "text" name = "name" placeholder="'.$row['pin_name'].'" /><br><br>
                    Description: <textarea name = "description" placeholder="'.$row['pin_desc'].'"></textarea>
            ';
            $mysqli3 = dbconnect();
            $result3 = $mysqli3->prepare("SELECT pinboard_id, pinboard_name FROM pinboard WHERE username = ?");
            $result3->bind_param('s',$username);
            $result3->execute();
            $boards3 = $result3->get_result();
            echo '<br><br>Please select a (possible new) pinboard. This pin is currently in the pinboard \''.$row['pinboard_name'].'\'<br>';
            foreach($boards3 as $row3){
                echo '<input type="radio" value="'.$row3['pinboard_id'].'" name="pinboard">'.$row3['pinboard_name'].'<br>';
            }
            echo '<input type="hidden" name="pin_id" value="'.$pin_id.'"/>';
            echo '<br><input type="submit" value="Edit Pin" name="editPin"/> <br>';
            echo '</form>';
        }
    }
    else{
        echo "Sorry, only the owner of this pin can delete it.";
    }
}

?>
</body>
</html>