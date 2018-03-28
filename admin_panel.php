<?php
    session_start();
    require('utils/php/user_check.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Administrator Panel</title>
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
        <div class="main_body">
            <div class="admin_buttons">
            <a href="add_user.php"><span class="admin_item">Add New Staff Member</span></a>
            <a href="add_item.php"><span class="admin_item">Add New Item</span></a>
            <a href="remove_user.php"><span class="admin_item">Remove Staff Member</span></a>
            <a href="list_users.php"><span class="admin_item">List Staff Members</span></a>
            </div>
        </div>
    </body>
</html>