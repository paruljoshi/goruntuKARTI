<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href=".\css\editProfile.css" type="text/css" />
    <title>goruntuKarti</title>
</head>
<body>
<?php
session_start();
require_once("dbconnect.php");
$username=$_POST['username'];
$email=$_POST['useremail'];
$mysqli = dbconnect();
?>
<div class="pageContainer">
    <div class="header">
        <div class ="leftHeader">
            goruntu<i>Karti</i>
        </div>
        <div class="rightHeader">
            <form action="index.php" method="post">
                <div class="username">
                    <h1>Welcome</h1>
                </div>
                <div class="password">

                    <br>
                </div>
                <div class="login">
                    <br>
                    <nav>
                        <ul>
                            <li><a href="#">&nbsp; &nbsp; &#9660; &nbsp;  </a>
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </form>
        </div>
    </div>

    <div class="editProfile">
        <h1>Update Your Profile </h1>

            <?php
            if($username=='adele488' && $email=='adele488@gmail.com'){
                header("location:home.php?username=".$_POST[username]);

            }else{
                header("location:incorrectUsername.php");
            }
            ?>

    </div>
</div>
</body>
</html>