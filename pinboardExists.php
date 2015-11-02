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
$username=$_GET['username'];
?>

<div class="pageContainer">
    <div class="header">
        <div class ="leftHeader">
            goruntu<i>Karti</i>
        </div>
        <div class="rightHeader">
            <form action="index.php" method="post">
                <div class="username">
                    <h1>username</h1>
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
            <form id="search-form" action="searchTag.php">
                <input type="text" name="tag"/>
                <input type="submit" value="search" name="search"/>

            </form>
        </div>
        Sorry !! you have created this pinboard already ..
        <form action="checkifBoardExist.php?username=<?php echo $username?>" method="post" id="create_pinboard_form">
            <span class="heading"><u>CREATE PINBOARD</u></span> <br><br><br>
            <div class="title">Name</div>
            <input type="text" name="boardName"/>
            <br><br>
            <div class="title">Description</div>
            <textarea name="boardDescription"></textarea>
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
            <input type="checkbox" name="friends" value="yes"> <br><br>
            <input type="submit" name="createBoard" value="Create Pinboard">
        </form>
    </div>
</div>
</body>
</html>





