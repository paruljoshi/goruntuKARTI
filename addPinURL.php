<!--
1. Check that the inserted address is for an image
2. Go to that page (image)
3. Download the image
4. Store the image in the database
-->

<?php
session_start();
require("dbconnect.php");
$username = $_GET['username'];
?>

<html>
<head>
<title>Insert URL</title>
<link rel="stylesheet" href="./css/addPin.css" type="text/css" />
</head>


<body class="URL">
	<form id="addURL" action="addedURL.php" method="post">
        <input type="text" id="textbox" name="name" placeholder="Name"/> <br><br>
        <textarea name="description" id="textbox" placeholder="Description"></textarea> <br>
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
        <input id="textbox" type="url" name="url" placeholder="URL"/> <br>
		<input type="submit" name="add" value="Add" />
	</form>
</body>