<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="./css/pinboards.css" type="text/css" />
	<title>goruntuKarti</title>
</head>
<body>
<?php
session_start();
require_once("dbconnect.php");
$username = $_GET['username'];
$pinboard_name = $_GET['pinboard_name'];
$mysqli = dbconnect();
$result = $mysqli->prepare("SELECT privacy,category,description FROM pinboard WHERE username= ? AND pinboard_name = ?");
$result->bind_param('ss', $username,$pinboard_name);
$result->execute();
$result->bind_result($privacy,$category,$description);
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
                            <li><a href="#">Task&#9660;</a>
                                <ul>
                                    <li><a href="pinboards.php?username=<?php echo $username?>">Pinboard</a></li>
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
                <form id="search-form" action="searchTag.php?username=<?php echo $username?>">
                    <input type="text" name="tag"/>
                    <input type="submit" value="search" name="search"/>

                </form>
            </div>
            <form action="updateEditBoardDetails.php?username=<?php echo $username?>" method="post" id="create_pinboard_form">
                <span class="heading"><u>EDIT PINBOARD</u></span> <br><br><br>
                <div class="title">Name</div>
                <input type="hidden" name="pinboard_name" value="<?php echo $pinboard_name;?>"/>
                <input type="text" name="newPinboardName" value="<?php echo $pinboard_name ?>"> </input>
                <br><br>
                <div class="title">Description</div>
                <textarea name="description"><?php echo $description ?> </textarea>
                <br><br>
                <div class="title">Category</div>
                <div class="radioButtons">
                    <input type="radio" name="category" value="art">Art<br>
                    <input type="radio" name="category" value="beauty">Beauty<br>
                    <input type="radio" name="category" value="nature">Nature<br>
                    <input type="radio" name="category" value="music">Music<br>
                    <input type="radio" name="category" value="trains">Trains<br>
                    <input type="radio" name="category" value="travel">Travel<br>
                    <input type="radio" name="category" value="other">Other<br>
                </div>
                <br><br><br><br><br><br><br><br>
                <div class="title">Friends only</div>

                <?php
                    if($privacy=="friends"){
                       echo '<input type="checkbox" name="friends" value="privacy" checked> <br><br>';
                    }
                    else{
                        echo '<input type="checkbox" name="friends" value="privacy" > <br><br>';
                    }
                ?>
                <input type="submit" name="submit" value="Edit Pinboard">
            </form>
            </div>
        </div>
    </body>
</html>
