<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css/friends.css" type="text/css"/>
    <title>goruntuKarti</title>
</head>
<body>
<?php
session_start();
require("dbconnect.php");
$username = $_GET['username'];
$mysqli = dbconnect();
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

    <div class="home">
        <div class="searchBar">
            <form id="search-form" action="searchFriends.php" method="post">
                <input type="hidden" name="username" value="<?php echo $username;?>"/>
                <input type="text" name="friends" placeholder="Search your Friends"/>
                <input type="submit" value="search" name="search"/>
            </form>
        </div>

        <div class="info">
            Look out for your friends and check what pinboards they have!!
        </div>

        <div id="friends">
            <?php
            $result = $mysqli->prepare("SELECT requestee_username FROM add_friend WHERE requester_username= ? AND status='accepted'");
            $result->bind_param('s', $username);
            $result->execute();
            $currentFriends = $result->get_result();

            foreach ($currentFriends as $row) {
                echo '<div class = "friendBox">';
                    echo '<div class="friend" >';
                    echo '<u>';
                    echo $row['requestee_username'];
                    echo '</u>';
                    echo '</div >';

                $result = $mysqli->prepare("SELECT pinboard_name FROM pinboard WHERE username= ?");
                $result->bind_param('s', $row['requestee_username']);
                $result->execute();
                $boards = $result->get_result();
                foreach ($boards as $row1) {
                    echo '<div class="friendBoard">';
                    echo $row1['pinboard_name'];
                    echo '</div>';
                }
                echo '</div >';

            }
            ?>
        </div>
    </div>
</div>
</body>
</html>