<!DOCTYPE html>
<?php
    session_start();
    if (isset($_SESSION["admin"])) {
        if ($_SESSION["admin"] < 1) {
            header("Location: index.php");
        }
    } else {
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
                <input type="text" name="addUsername" value="Username"><br />
                <input type="text" name="addPassword" value="Password"><br />
                <p>Admin: 
                <input type="checkbox" name="admin" value="Admin"><br /></p>
                <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>