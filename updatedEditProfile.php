<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href=".\css\editProfile.css" type="text/css" />
    <title>goruntuKarti</title>
</head>
<body>
<?php
session_start();
require_once("dbconnect.php");
$username=$_GET['username'];
$mysqli = dbconnect();
$result = $mysqli->prepare("SELECT username,useremail, name  FROM user WHERE username= ? ");
$result->bind_param('s', $username);
$result->execute();
$result->bind_result($username,$useremail,$name);
$result->fetch();
?>

<div class="pageContainer">
    <div class="header">
        <div class ="leftHeader">
            goruntu<i>Karti</i>
        </div>
        <div class="rightHeader">
            <form action="index.php" method="post">
                <div class="username">
                    <h1>Welcome</h1>
                </div>
                <div class="password">
                    <h1><?php echo $username ?>!!</h1>
                    <br>
                </div>
                <div class="login">
                    <br>
                    <nav>
                        <ul>
                            <li><a href="#">&nbsp; &nbsp; &#9660; &nbsp;  </a>
                                <ul>
                                    <li><a href="home.php?username=<?php echo $username?>">Home</a></li>
                                    <li><a href="pinboards.php?username=<?php echo $username?>">Pinboards</a></li>
                                    <li><a href="friends.php?username=<?php echo $username?>">Friends</a></li>
                                    <li><a href="index.php">LogOut</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </form>
        </div>
    </div>

    <div class="editProfile">
        <h2>Your Profile has been updated!!</h2>
        <h1>Update Your Profile </h1>
        <form action="updateEditProfileDetails.php?username=<?php echo $username?>" method="post">
            <input id="textbox" type="text" placeholder="Name" name="newName"  value="<?php echo $name ?>"> <br><br>
            <input id="textbox" type="text" placeholder="Unique Username" name="newUsername"  value="<?php echo $username ?>"><br><br>
            <input id="textbox" type="text" placeholder="Email" name="newUseremail" value="<?php echo $useremail ?>" > <br><br>
            <input id="textbox" type="password" placeholder="password" name="newPassword"><br><br>
            <input id="textbox" type="password" placeholder="Re-enter password" name="samePassword"><br><br>
            <input id="signUp" type="submit" name="submit" value="Update">
        </form>
    </div>
</div>
</body>
</html>