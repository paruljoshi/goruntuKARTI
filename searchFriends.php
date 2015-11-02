<html>
<head>
    <link rel="stylesheet" href="./css/friends.css" type="text/css"/>
    <title>goruntuKarti</title>
</head>

<body>
<?php
session_start();
require_once("dbconnect.php");
$friends = "%{$_POST['friends']}%";
$username= $_POST['username'];
$mysqli =dbconnect();
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

    <?php
    $query = $mysqli->prepare("SELECT username FROM user WHERE username LIKE ?");
    $query->bind_param('s', $friends);
    $query->execute();
    $newFriends = $query->get_result();

    foreach ($newFriends as $row) {
        //while($query->fetch()) {
        if ($row['username'] != $username) {
            echo '<div class="searchFriendBox">';
            echo '<div class="friendName">';
            echo $row['username'];
            echo '</div>';
            $query1 = $mysqli->prepare("SELECT status FROM add_friend WHERE requester_username = ? AND requestee_username= ?");
            $query1->bind_param('ss', $username, $row['username']);
            $query1->execute();
            $query1->bind_result($status);
            $query1->fetch();


            if ($query1->num_rows == 0) {
                if ($status == 'accepted') {
                    echo '<div class="status">';
                    echo '<input id="status" type="submit" name="delete" value="Delete Friend">';
                    echo '</div>';
                } else if ($status == 'waiting') {
                    echo '<div class="status">';
                    echo '<input id="status" type="submit" name="waiting" value="Waiting">';
                    echo '</div>';
                } else {
                    echo '<div class="status">';
                    echo "<a href='addFriend.php?username=" . $username . "&requestee_username=" . $row['username'] . " '>";
                    echo '<input id="status" type="submit" name="Add Friend" value="Add Friend">';
                    echo '</a>';
                    echo '</div>';
                }
            }
            echo '</div>';
        }
    }
    ?>


</body>
</html>