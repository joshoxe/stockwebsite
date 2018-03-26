<?php
    require('utils/php/user_database.php');
    if (isset($_SESSION["user"])) {
        $loggedIn = '<a href="logout.php">Logout '. $_SESSION["user"].'</a>'; 
    } else {
        header("Location: login.php");
    }

    if (isset($_SESSION["admin"])) {
        if ($_SESSION["admin"] != 0) {
            $admin = '<a href="admin_panel.php">Administrator Panel</a>';
        } else {
            $admin = "";
        }
    }

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
    </head>
    
    <body>
        <div class="company_logo">
            <img class="company_img" src="img/logo.png" height="110" width="200">
        </div>
        <div class="inventory_navigation">
            <ul class="inv_nav_left">
                <li><a href="index.php">Home</a></li>
            </ul>
            <ul class="inv_nav_right">
                <li><?php echo $loggedIn; ?></li>
                <li><?php echo $admin; ?></li>
            </ul>

        </div>

        <div class="main_body">
            <?php echo $output; ?>
        </div>
    </body>
</html>