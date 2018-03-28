<?php
    require('utils/php/user_database.php');
    require('utils/php/user_check.php');

    $users = listUsers();
    $output = "<ul name='user_list'>";

    foreach($users as $user => $user_admin) {
        $output.= "<li>".$user;

        if($user_admin != 0) {
            $output.= " (Admin)";
        }

        $output.= "</li>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Staff Members</title>
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

        <div class="staff_list">
            <?php echo $output; ?>
        </div>
    </body>
</html>