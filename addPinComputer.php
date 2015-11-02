

<?php
session_start();
require("dbconnect.php");
$username = $_GET['username'];
?>

<html>
<head>
<title>Insert Local File</title>
<link rel="stylesheet" href="./css/addPin.css" type="text/css" />
</head>
<body class="computer">
    <form id = "addPinComputer" action="addedComputer.php" enctype="multipart/form-data" method="post">
        <input type="text" name="name" placeholder="Name"/> <br>
        <textarea name="description" placeholder="Description"></textarea> <br>
        <?php
            $mysqli = dbconnect();
            $result = $mysqli->prepare("SELECT pinboard_id, pinboard_name FROM pinboard WHERE username = ?");
            $result->bind_param('s',$username);
            $result->execute();
            $boards = $result->get_result();
            echo 'Choose pinboard:<br><br>';
            foreach($boards as $row){
                echo '<input type="radio" value="'.$row['pinboard_id'].'" name="pinboard">'.$row['pinboard_name'].'<br>';
            }
        ?>
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <input type="file" name="localLocation"/> <br>
        <input type="submit" name="add" value="Add" />
    </form>
</body>
</html>
