<!DOCTYPE html>
<?php
    session_start();
    require('utils/php/user_check.php');
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
            <ul class="inv_nav_left">
                <li><a href="index.php">Home</a></li>
                <li><?php echo $loggedIn; ?></li>
                <li><?php echo $admin; ?></li>
            </ul>
        </div>
        <div id="form">
            <p>Add a new item</p>
            <form name="loginForm" action="utils/php/inventory_database.php" method="POST" onsubmit="return validateLogin()">
                <input class="field" type="text" name="addItemName" placeholder="Name"><br />
                <input class="field" type="text" name="addItemConsole" placeholder="Console"><br />
                <input class="field" type="text" name="addItemStock" placeholder="Stock"><br />
                <input class="field" type="text" name="addItemPrice" placeholder="Price"><br />
                <input class="button" type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>