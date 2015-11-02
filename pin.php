<!--TODO: 
1) Show Picture
2) Pin It! button/link
3) Edit button/link
4) Delete button/link
5) Comments
6) Add Comment
Note: The size of the window is 800x700.
-->
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="./css/pin.css" type="text/css" />
	<title>goruntuKarti</title>
</head>
<?php
session_start();
require("dbconnect.php");
$username = $_GET['username'];
$pin_id = $_GET['pin_id'];


$repin_id=0;
if(isset($_GET['repin_id'])) {
    $repin_id = $_GET['repin_id'];
}

$mysqli = dbconnect();
$result = $mysqli->prepare("SELECT image FROM pin WHERE pin_id = ?");
$result->bind_param('s',$pin_id);
$result->execute();
$result->bind_result($image);
?>
<body>
	<div class="imagePlaceholder">
        <?php
        while($result->fetch()) {
            echo '<img src="data:image/jpeg;base64,'.base64_encode($image).'" />';
        }
        ?>
	</div>
	<div class="menu">
		<div class="left">
            <?php
            echo '<a href="pinIt.php?username='.$username.'&pin_id='.$pin_id.'">Pin It!</a>';
            $mysqli=dbconnect();
            $check_like=$mysqli->prepare("SELECT * FROM likes WHERE username = ? AND pin_id=?");
            $check_like->bind_param("ss",$username,$pin_id);
            $check_like->execute();
            $numb_like=$check_like->get_result();

            if($repin_id==0) {
                if (mysqli_num_rows($numb_like)== 0) {
                    echo "<a href='likePin.php?username=" . $username . "&pin_id=" . $pin_id . " '>";
                    echo '<input type="submit" value="like" name="like"/></a> ';
                    echo '<a>';
                } else {
                    echo '<input type="submit" value="liked" name="liked"/> ';
                }
            }
            ?>
            <?php
            $mysqli=dbconnect();
            $check_like=$mysqli->prepare("SELECT COUNT(*) AS likes FROM likes WHERE pin_id=?");
            $check_like->bind_param("s",$pin_id);
            $check_like->execute();
            $numb_like=$check_like->get_result();
            foreach ($numb_like as $likes) {
                echo 'likes(';
                if($likes['likes']!=0) {
                    echo $likes['likes'];
                }else{
                    echo '0';
                }
                echo ')';
            }
            ?>




            </div>
		<!-- If the pin is 'owned' by the user: -->
		<div class="right">
            <?php
            echo '<a href="editPin.php?username='.$username.'&pin_id='.$pin_id.'">Edit</a> ';
            echo '<a href="deletePin.php?username='.$username.'&pin_id='.$pin_id.'">Delete</a>';
            ?>
		</div>
		<!-- End if -->
	</div>
	<div class="viewComments">
        <?php

        if($repin_id==0) {
            $mysqli = dbconnect();
            $result = $mysqli->prepare("SELECT comment,username FROM comment_pin WHERE pin_id = ? ");
            $result->bind_param('s', $pin_id);
            $result->execute();
            $comment = $result->get_result();
            foreach ($comment as $row) {
                echo $row['username'];
                echo ':';
                echo $row['comment'];
                echo'<br>';
            }
        }else{
            $mysqli = dbconnect();
            $result = $mysqli->prepare("SELECT comment,username FROM comment_repin WHERE repin_id = ?");
            $result->bind_param('s', $repin_id);
            $result->execute();
            $comment = $result->get_result();
            foreach ($comment as $row) {
                echo $row['username'];
                echo ':';
                echo $row['comment'];
                echo'<br>';
            }
        }
        ?>
	</div>
	<div class="addComment">
        <form action="addComment.php?username=<?php echo $username?>" method="post">
            <textarea rows="1" cols="85" placeholder="Add Comment" name="addComment"></textarea>
            <input type="submit" value="Add Comment" name="Add Comment"/>
            <input type="hidden" name="pin_id" value="<?php echo $pin_id?>"/>
            <input type="hidden" name="repin_id" value="<?php echo $repin_id?>"/>
        </form>


	</div>
</body>
</html>