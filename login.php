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
    </head>

    <body>
        <div class="login">
            <form name="loginForm" action="utils/php/user_database.php" method="POST" onsubmit="return validateLogin()">
                <input type="text" name="username" value="Username"><br />
                <input type="text" name="password" value="Password"><br />
                <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>