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
                    <input type="text" placeholder="Username" name="username">
                </div>
                <div class="password">
                    <br>
                    <input type="password" placeholder="Password" name="password"> <br>
                    <a>Forgot Your Password</a>
                </div>
                <div class="login">
                    <br>
                    <input type="submit" name="submit" value="Log In">
                </div>
            </form>
        </div>
    </div>

    <div class="description">
        <p>goruntuKarti is a web-based service.<br>
            You can sign up for the service by supplying a
            unique username and password.<br>
            Once they have signed up and log in, they can create one or more
            ‘pinboards’.<br>
            A user can ‘pin’ pictures onto any one of the pinboards they have created. <br>
            The picture a user wishes to pin may be found anywhere on the web, or may be uploaded from the user’s computer.<br>
            A user can also ‘repin’ a picture they find on any pinboard onto another pinboard (they can also repin a picture
            from one pinboard onto the same pinboard, as long as they have created that pinboard).<br> The pinned and
            repinned pictures appear together on the pinboard for other users to view.
        </p>

    </div>
    <div class="signUp">
        Please fill all the required details !!!
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