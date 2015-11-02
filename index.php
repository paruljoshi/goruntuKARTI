<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href=".\css\index.css" type="text/css" />
    <title>goruntuKarti</title>
</head>
<body>
<div class="pageContainer">
    <div class="header">
        <div class ="leftHeader">
            goruntu<i>Karti</i>
        </div>
        <div class="rightHeader">
            <form action="login.php" method="post">
                <div class="username">
                    <br>
                    <input type="text"  placeholder="Username" name="username">
                </div>
                <div class="password">
                    <br>
                    <input type="password"  placeholder="Password" name="password"> <br>
                    <a href="forgotPassword.php?"><font color="white">Forgot Your Password</font></a>
                </div>
                <div class="login">
                    <br>
                    <input type="submit" name="submit" value="Log In">
                </div>
            </form>
        </div>
    </div>

    <div class="description">
        <br>
        <p><h2>Welcome!!</h2>
            goruntuKARTI is an interactive image sharing platform.
            As soon as you set up your free account,
            you are granted access to a universe of the best images the internet has to offer,
            neatly sorted into useful category and boards.<br><br>
            Thats not all !!<br><br>
            You are encouraged to share your favourite images with the goruntuKARTI world.
            Interaction is at the heart of our world, and frequent communication amongst members makes for a warm and productive environment,
            suitable for either work or play.

        </p>

    </div>
    <div class="signUp">
        <h1>Wanna Share?</h1>
        <form action="checkIfUserExists.php" method="post">
        <input id="textbox" type="text" placeholder="Name" name="name"> <br><br>
        <input id="textbox" type="text" placeholder="Unique Username" name="username"><br><br>
        <input id="textbox" type="text" placeholder="Email" name="useremail"><br><br>
        <input id="textbox" type="password" placeholder="password" name="password"><br><br>
        <input id="textbox" type="password" placeholder="Re-enter password" name="samePassword"><br><br>
        <input id="signUp" type="submit" name="submit" value="Sign Up">
        </form>
    </div>
</div>
</body>
</html>