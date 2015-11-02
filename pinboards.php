<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css/pinboards.css" type="text/css"/>
    <title>goruntuKarti</title>
</head>
<body>

<?php
session_start();
require("dbconnect.php");
$username = $_GET['username'];
$mysqli = dbconnect();
$result = $mysqli->prepare("SELECT COUNT(pinboard_id) AS boards FROM pinboard WHERE username= ? ");
$result->bind_param('s', $username);
$result->execute();
$result->bind_result($boardCount);
$result->fetch();
?>

<?php
$username = $_GET['username'];
$mysqli = dbconnect();
$result = $mysqli->prepare("SELECT COUNT(pin_id) AS pins FROM pin,pinboard WHERE pin.pinboard_id = pinboard.pinboard_id and pinboard.username = ? ");
$result->bind_param('s', $username);
$result->execute();
$result->bind_result($pinCount);
$result->fetch();
?>

<?php
$username = $_GET['username'];
$mysqli = dbconnect();
$result = $mysqli->prepare("SELECT COUNT(pin_id) AS likes FROM likes WHERE likes.pin_id IN (SELECT pin_id AS count FROM pin,pinboard WHERE pin.pinboard_id = pinboard.pinboard_id and pinboard.username = ?)");
$result->bind_param('s', $username);
$result->execute();
$result->bind_result($likeCount);
$result->fetch();
?>

<?php
$username = $_GET['username'];
$mysqli = dbconnect();
$result = $mysqli->prepare("SELECT COUNT(username) AS followers FROM follows WHERE pinboard_id IN (SELECT pinboard_id AS boards FROM pinboard WHERE username= ?)");
$result->bind_param('s', $username);
$result->execute();
$result->bind_result($followersCount);
$result->fetch();
?>

<?php
$username = $_GET['username'];
$mysqli = dbconnect();
$result = $mysqli->prepare("SELECT COUNT(*) AS following FROM follows WHERE username= ?");
$result->bind_param('s', $username);
$result->execute();
$result->bind_result($followingCount);
$result->fetch();
?>
<div class="pageContainer">
    <div class="header">
        <div class="leftHeader">
            goruntu<i>Karti</i>
        </div>
        <div class="rightHeader">
            <form action="index.php" method="post">
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

    <div class="home">
        <div class="searchBar">
            <form id="search-form" action="searchTag.php">
                <input type="text" name="tag"/>
                <input type="submit" value="search" name="search"/>

            </form>
        </div>

        <div id="pinboards">
            <div class="icon first">
                <a href="createPinboard.php?username=<?php echo $username ?>">Create Pinboard</a>
            </div>


            <?php
            $username = $_GET['username'];
            $mysqli = dbconnect();
            $result = $mysqli->prepare("SELECT pinboard_id,pinboard_name FROM pinboard WHERE username= ?");
            $result->bind_param('s', $username);
            $result->execute();
            $boards = $result->get_result();

            foreach ($boards as $row) {
                //echo $row['pinboard_name'];


                echo '<div class = "icon">';
                echo "<a href='pins.php?username=".$username."&pinboard_id=".$row['pinboard_id']." '>";
                echo '<div class="top" >';
                echo $row['pinboard_name'];
                echo '</div >';
                echo '<div class="middle" >';
                echo '<img src = "./images/train.jpg" height = "250" width = "200" />';
                echo '</div >';
                echo '</a >';
                echo '<div class="bottom" >';

                echo "<a href='editPinboard.php?username=".$username."&pinboard_name=".$row['pinboard_name']." '>Edit</a>";
                echo '</div >';
                echo '</div >';
            }
            ?>
        </div>
        <div id="statistics">
            <div class="box">
                <div class="left">
                    Boards
                </div>
                <div class="right">
                    <?php echo $boardCount ?>
                </div>
            </div>
            <div class="box">
                <div class="left">
                    Pins
                </div>
                <div class="right">
                    <?php echo $pinCount ?>
                </div>
            </div>
            <div class="box">
                <div class="left">
                    Likes
                </div>
                <div class="right">
                    <?php echo $likeCount ?>
                </div>
            </div>
            <div class="box">
                <div class="left">
                    Followers
                </div>
                <div class="right">
                    <?php echo $followersCount ?>
                </div>
            </div>
            <div class="lastBox">
                <div class="left">
                    Following
                </div>
                <div class="right">
                    <?php echo $followingCount ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>