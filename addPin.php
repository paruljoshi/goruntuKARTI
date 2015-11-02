<!DOCTYPE html>
<html>
<head>
<title>Add Pin</title>
<link rel="stylesheet" href="./css/addPin.css" type="text/css" />
</head>
<?php
session_start();
require("dbconnect.php");
$username = $_GET['username'];
?>
<body>
<div class = "left">
	<a href="addPinURL.php?username=<?php echo $username ?>">From<br>URL</a>

</div>
<div class = "right">
	<a href="addPinComputer.php?username=<?php echo $username ?>">From<br>Computer</a>
</div>
</body>
</html>