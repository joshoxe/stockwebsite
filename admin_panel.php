<?php
    session_start();
    if (isset($_SESSION["admin"])) {
        if ($_SESSION["admin"] == 0) {
            header("Location: index.php");
        }
    } else {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Administrator Panel</title>
    </head>

    <body>
    <div class="company_logo">
            <img class="company_img" src="img/logo.png" height="110" width="200">
        </div>
        <div class="admin_navigation">
            <ul class="admin_nav">
                <li><a href="add_user.php">Add New Staff Member</a></li>
                <li><a href="remove_user.php">Remove Staff Member</a></li>
                <li><a href="list_users.php">List Staff Members</a></li>
            </ul>

        </div>

        <div class="admin_content">

        </div>
    </body>
</html>