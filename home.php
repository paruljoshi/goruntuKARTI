<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href=".\css\home.css" type="text/css" />
	<title>goruntuKarti</title>
</head>
<body>
    <?php
    session_start();
    require_once("dbconnect.php");
    $username=$_GET['username'];
    $mysqli =dbconnect();
    $waiting = $mysqli->prepare("SELECT requester_username FROM add_friend WHERE requestee_username=? AND status='waiting' ");
    $waiting->bind_param('s', $username);
    $waiting->execute();
    $waiting->bind_result($requester);
    $count=0;
    while($waiting->fetch()){
            $count++;
        }
    ?>

	<div class="pageContainer">
		<div class="header">
			<div class ="leftHeader">
				goruntu<i>Karti</i>
			</div>
			<div class="rightHeader">
				<form action="index.php" method="post">
                <div class="username">
                    <h1> <?php
                    if($count==0){
                        echo"<a>(".$count.")</a>";
                    }else{
                        echo"<a href='respondFriendRequest.php?username=" . $username . " '>";
                        echo"(".$count.")";
                        echo "</a>";
                    }
                    ?>
                   Welcome </h1>
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

        <div class ="home">
            <div class="searchBar">
                <form id="search-form" action="searchTag.php?username=<?php echo $username?>" method="post">
                    <input type="text" name="tag" placeholder="Search images.."/>
                    <input type="submit" value="search" name="search"/>
                </form>
            </div>
		</div>


        <div class="followStream">

            <?php
            $mysqli = dbconnect();
            $result = $mysqli->prepare("SELECT pin_id,pin_name,image FROM pin AS p,follows AS f WHERE username=? AND p.pinboard_id=f.pinboard_id ORDER BY pinned_time DESC");
            $result->bind_param('s', $username);
            $result->execute();
            $pins = $result->get_result();
            foreach($pins as $row){
                //echo $row['pin_name'];
                echo '
                    <div class = "friendBox">
                        <a target="_top" href="javascript:void(0)" onclick="window.open(\'pin.php?username='.$username.'&pin_id='.$row['pin_id'].'\', \'Open Link\', \'toolbar=no, location=no, resizable=no, copyhistory=yes, height=700, width=800\')">
                        <div class="top">'.$row['pin_name'].'</div>
                        <div class="middle">
                            <img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" height="250" width="250" />
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
</body>
</html>