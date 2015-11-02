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
$mysqli=dbconnect();
$boardName = $_POST["boardName"];
$check_user=$mysqli->prepare("SELECT pinboard_name FROM pinboard WHERE username = ? AND pinboard_name=?");
$check_user->bind_param("ss",$username,$boardName);
$check_user->execute();
$numb_user=$check_user->get_result();

if(mysqli_num_rows($numb_user)>0){
     header("location:pinboardExists.php?username=<?php echo $username?>");
}

//to check if required fields are empty
/*elseif(mysqli_num_rows($numb_user)==0){
    if ($_POST["boardName"]=="" ) {
        echo "empty value";
        //header("location:incorrectSignUp1.php");
    }
 */   else {
    $boardName = $_POST["boardName"];
    $boardDescription = $_POST["boardDescription"];
        if(isset($_POST['friends'])) {
            $privacy = $_POST['friends'];
            }else{
            $privacy = "everyone";
        }
        if (isset($_POST['category'])) {
            $category=$_POST['category'];
        }

    //$boardCategory = $_POST["useremail"];
    $addBoard = $mysqli->prepare("INSERT INTO `pinboard`(`pinboard_id`, `pinboard_name`, `last_accessed`, `username`, `date_created`, `privacy`, `category`, `description`) VALUES (NULL,?,CURRENT_TIMESTAMP ,?,CURRENT_TIMESTAMP ,?,?,?)");
    $addBoard->bind_param('sssss', $boardName, $username,$privacy,$category, $boardDescription);
    $addBoard->execute();
    //echo "Pinboard is created!!";
    //session_start();
     //$_SESSION['username'] = $_POST['username'];
    header("location:pinboards.php?username=".$username."");

    //header("location:home.php? username=".$_POST[username]);
}
//}
?>
</body>
</html>