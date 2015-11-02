<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href=".\css\friends.css" type="text/css" />
    <title>goruntuKarti</title>
</head>
<body>
<?php
session_start();
require_once("dbconnect.php");
$username=$_GET['username'];
$mysqli =dbconnect();
?>

<div class="pageContainer">
    <div class="header">
        <div class ="leftHeader">
            goruntu<i>Karti</i>
        </div>
        <div class="rightHeader">
            <form action="index.php" method="post">
                <div class="username">
                    <h1> Welcome</h1>
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
                                    <li><a href="editProfile.php?username=<?php echo $username?>">Edit Profile</a></li>
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

    <?php
    $query1 = $mysqli->prepare("SELECT requester_username FROM add_friend WHERE requestee_username = ? AND status='waiting'");
    $query1->bind_param('s', $username);
    $query1->execute();
    $request=$query1->get_result();
    //$query1->fetch();
    foreach($request as $row){
        echo '<div class="searchFriendBox">';
            echo '<div class="requesterName">';
            echo $row['requester_username'];
            echo '</div>';
            echo '<div class="addDelete">';
            echo "<a href='acceptFriendRequest.php?username=" . $username . "&requestee_username=" . $row['requester_username'] . " '>";
            echo '<input id="status" type="submit" name="Add Friend" value="Add Friend">';
            echo '</a>';
            echo '&nbsp';
            echo '&nbsp';
            echo '&nbsp';
            echo '&nbsp';
            echo "<a href='deleteFriendRequest.php?username=" . $username . "&requestee_username=" . $row['requester_username'] . " '>";
            echo '<input id="status" type="submit" name="Delete Request" value="Delete Request">';
            echo '</a>';
            echo '</div>';
        echo '</div>';
    }
 ?>
</div>
</body>
</html>