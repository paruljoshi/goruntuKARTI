<html>
<head>
    <link rel="stylesheet" href="./css/friends.css" type="text/css"/>
    <title>goruntuKarti</title>
</head>

<body>
<?php
session_start();
require_once("dbconnect.php");
$username= $_GET['username'];
$requestee_username= $_GET ['requestee_username'];
$mysqli =dbconnect();
$addFriend = $mysqli->prepare("INSERT INTO `add_friend`(`requester_username`, `requestee_username`, `status`, `request_time`, `last_status_change`) VALUES (?,?,'waiting',CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP )");
$addFriend->bind_param('ss', $username,$requestee_username);
$addFriend->execute();
?>

<div class="pageContainer">
    <div class="header">
        <div class="leftHeader">
            goruntu<i>Karti</i>
        </div>
        <div class="rightHeader">
            <form action="#" method="post">
                <div class="username">
                    <h1><?php echo $username ?></h1>
                </div>
                <div class="password">
                    <h1></h1>
                    <br>
                </div>
                <div class="login">
                    <br>
                    <nav>
                        <ul>
                            <li><a href="#"> &nbsp; &nbsp; &#9660; &nbsp; </a>
                                <ul>
                                    <li><a href="home.php?username=<?php echo $username ?>">Home</a></li>
                                    <li><a href="editProfile.php?username=<?php echo $username ?>">Edit Profile</a></li>
                                    <li><a href="pinboards.php?username=<?php echo $username?>">Pinboards</a></li>
                                    <li><a href="index.php">LogOut</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </form>
        </div>
    </div>
    <div class="requestSent">
    A Friend Request to <?php echo $requestee_username ?> is sent.<br>
        <font size="5px">Go to <a href="home.php?username=<?php echo $username?>"><font color="#ff1493">Home</font> </a>

    </div>
    </div>
</body>
</html>