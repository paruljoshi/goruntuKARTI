<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href=".\css\editProfile.css" type="text/css" />
    <title>goruntuKarti</title>
</head>
<body>


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
                    <h1></h1>
                    <br>
                </div>
                <div class="login">
                    <br>
                    <nav>
                        <ul>
                            <li><a href="#">&nbsp; &nbsp; &#9660; &nbsp;  </a>
                                <ul>
                                    <li><a href="home.php">Home</a></li>

                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </form>
        </div>
    </div>

    <div class="editProfile">
        <h1>Forgot Your Password ?? </h1>
        Please Enter your unique Username And Useremail !!
        <form action="checkUsernameAndEmail.php" method="post">
             Unique Username : <input id="textbox" type="text" placeholder="Name" name="username"  > <br><br>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; User Email :  <input id="textbox" type="text" placeholder="Email" name="useremail"  > <br><br>

            <input id="signUp" type="submit" name="submit" value="Check">
        </form>
    </div>
</div>
</body>
</html>