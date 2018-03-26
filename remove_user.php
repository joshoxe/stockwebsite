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
        <title>Remove Staff</title>
        <script src="utils/js/script.js"></script>
    </head>

    <body>
        <div class="login">
            <form name="loginForm" action="utils/php/user_database.php" method="POST" onsubmit="return checkDelete()">
                <input type="text" name="removeUsername" value="Username"><br />
                <input type="submit" value="Confirm">
            </form>
        </div>
    </body>
</html>