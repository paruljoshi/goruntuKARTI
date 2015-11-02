<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>checkUser</title>
</head>

<body>
    <?php
        require_once("dbconnect.php");
        $username=$_POST["username"];
        $mysqli=dbconnect();
        $check_user=$mysqli->prepare("SELECT * FROM user WHERE username = ?");
        $check_user->bind_param("s",$username);
        $check_user->execute();
        $numb_user=$check_user->get_result();

        if(mysqli_num_rows($numb_user)>0){
        header("location:incorrectSignUp.php");
        }

        //to check if required fields are empty
        elseif(mysqli_num_rows($numb_user)==0){
            if ($_POST["username"]=="" || $_POST["useremail"]== "" || $_POST["password"] == "" || $_POST["samePassword"]=="") {
                header("location:incorrectSignUp1.php");
            }
        else {
                $username = $_POST["username"];
                $password = $_POST["password"];
                $useremail = $_POST["useremail"];
                $name = $_POST["name"];
                $sign_up = $mysqli->prepare("Insert into user(username,password,useremail,name,last_update)values(?,?,?,?,CURRENT_TIMESTAMP)");
                $sign_up->bind_param('ssss', $username, $password, $useremail, $name);
                $sign_up->execute();
            //    header("location:home.php");
            session_start();
            $_SESSION['username'] = $_POST['username'];
            header("location:home.php? username=".$_POST[username]);
            }
    }
    ?>
</body>
</html>