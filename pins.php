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
            <div id="links"><a href="javascript:history.back()">Previous Page</a>&nbsp&nbsp&nbsp<a href="followedPinboard.php?username=<?php echo $username?>&pinboard_id=<?php echo $pinboard_id?>">Follow Pinboard</a></div>
            <div id = "pinboards">
                <div class = "icon first">
                    <a target="_top" href="javascript:void(0)" onclick="window.open('addPin.php?username=<?php echo $username ?>', 'Open Link', 'toolbar=no, location=…=no, resizable=no, copyhistory=yes, height=300, width=300')">Add Pin</a>
                </div>

                <?php

                $result = $mysqli->prepare("SELECT pin_id, pin_name, image FROM pin WHERE pinboard_id = ?");
                $result->bind_param('s', $pinboard_id);
                $result->execute();
                $boards = $result->get_result();

                foreach($boards as $row){
                    //echo $row['pin_name'];
                    echo '
                    <div class = "icon">
                        <a target="_top" href="javascript:void(0)" onclick="window.open(\'pin.php?username='.$username.'&pin_id='.$row['pin_id'].'\', \'Open Link\', \'toolbar=no, location=no, resizable=no, copyhistory=yes, height=700, width=800\')">
                        <div class="top">'.$row['pin_name'].'</div>
                        <div class="middle">
                            <img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" height="250" width="200" />
                        </div>
                        </a>
                        <div class="bottom">
                            <a target="_top" href="javascript:void(0)" onclick="window.open(\'pinIt.php?username='.$username.'&pin_id='.$row['pin_id'].'\', \'Open Link\', \'toolbar=no, location=no, resizable=no, copyhistory=yes, height=380, width=380\')">Pin It!</a>
                        </div>
                    </div>';
                }

                $result2 = $mysqli->prepare("SELECT repin.pin_id, pin_name, image,repin.repin_id FROM repin, pin WHERE pin.pin_id = repin.pin_id AND repin.pinboard_id = ?");
                $result2->bind_param('s', $pinboard_id);
                $result2->execute();
                $boards = $result2->get_result();

                foreach($boards as $row){
                    echo '
                    <div class = "icon">
                        <a target="_top" href="javascript:void(0)" onclick="window.open(\'pin.php?username='.$username.'&pin_id='.$row['pin_id'].'&repin_id='.$row['repin_id'].'\', \'Open Link\', \'toolbar=no, location=no, resizable=no, copyhistory=yes, height=700, width=800\')">
                        <div class="top">'.$row['pin_name'].'</div>
                        <div class="middle">
                            <img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" height="250" width="200" />
                        </div>
                        </a>
                        <div class="bottom">
                            <a target="_top" href="javascript:void(0)" onclick="window.open(\'pinIt.php?username='.$username.'&pin_id='.$row['pin_id'].'\', \'Open Link\', \'toolbar=no, location=no, resizable=no, copyhistory=yes, height=380, width=380\')">Pin It!</a>
                        </div>
                    </div>';
                }
                ?>
            </div>
		</div>		
	</div>
</body>
</html>