<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css/pinboards.css" type="text/css" />
    <title>goruntuKarti</title>
</head>
<?php
session_start();
require("dbconnect.php");
$username = $_GET['username'];
$pinboard_id = $_GET['pinboard_id'];
$mysqli = dbconnect();
?>
<body>
<div class="pageContainer">
    <div class="header">
        <div class ="leftHeader">
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
                            <li><a href="#">&nbsp &nbsp &#9660; &nbsp</a>
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

    <div class ="home">
        <div class="searchBar">
            <form id="search-form" action="searchTag.php">
                <input type="text" name="tag" />
                <input type="submit" value="search" name="search"/>
            </form>
        </div>
    <?php $result = $mysqli->prepare("INSERT INTO follows (pinboard_id,follow_time,username) VALUES (?,CURRENT_TIMESTAMP,?)");
    $result->bind_param('ss', $pinboard_id, $username);
    if($result->execute()){
        echo "&nbsp&nbsp&nbsp&nbspSuccess!<br><br>";
    }
    else{
        echo "&nbsp&nbsp&nbsp&nbspEither you are already following this pinboard OR an error has occurred<br><br>";
    }
    ?>
        &nbsp&nbsp&nbsp&nbsp<a href="javascript:history.back()">Go Back</a>
</body>
</html>