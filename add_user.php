<!DOCTYPE html>
<?php
    session_start();
    require('utils/php/user_check.php');
?>
<html>
    <head>
        <title>Login</title>
        <script src="utils/js/validation.js"></script>
        <link rel="stylesheet" type="text/css" href="utils/css/style.css">
        <link rel="stylesheet" type="text/css" href="utils/css/responsive_style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
    <div id="navigation">
            <div class="company_logo">
                <img class="company_img" src="img/logo.png" height="110" width="200">
            </div>
            <ul class="inv_nav_left">
                <li><a href="index.php">Home</a></li>
                <li><?php echo $loggedIn; ?></li>
                <li><?php echo $admin; ?></li>
            </ul>
        </div>
        <div id="form">
            <form name="loginForm" action="utils/php/user_database.php" method="POST" onsubmit="return validateLogin()">
                <input class="field" type="text" name="username" placeholder="Username"><br />
                <input class="field" type="password" name="password" placeholder="Password"><br />
                <p>Admin: 
                <input type="checkbox" name="admin" value="Admin"><br /></p>
                <input class="button" type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>