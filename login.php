<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>validUser</title>
</head>
<body>
<?php
$con=mysqli_connect("127.0.0.1", "root", "root", "goruntukarti");
if (mysqli_connect_errno($con))
{
    echo "MySql Error: " . mysqli_connect_error();
}

$query=mysqli_query($con,"SELECT * FROM user WHERE username='$_POST[username]' && password='$_POST[password]'");
$count=mysqli_num_rows($query);
$row=mysqli_fetch_array($query);
session_start(); //start a new user session

if ($count==1){
    session_start();
    $_SESSION['username'] = $_POST['username'];
    header("location:home.php? username=".$_POST[username]);
}
else
{
    header("location:incorrectLogin.php");
}

mysqli_close($con);


?>
</body>
</html>