<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION["user"])) {
        header("Location: index.php");
    }
?>
<html>
    <head>
        <title>Login</title>
        <script src="utils/js/script.js"></script>
        <link rel="stylesheet" type="text/css" href="utils/css/style.css">
        <link rel="stylesheet" type="text/css" href="utils/css/responsive_style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
    <div id="navigation">
            <div class="company_logo">
                <img class="company_img" src="img/logo.png" height="110" width="200">
            </div>
    </div>
        <div id="form">
            <p>Login</p>
            <form name="loginForm" action="utils/php/user_database.php" method="POST" onsubmit="return validateLogin()">
                <input class="field" type="text" name="username" placeholder="Username"><br />
                <input class="field" type="password" name="password" placeholder="Password"><br />
                <input class="button" type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>