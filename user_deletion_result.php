<?php
    session_start();

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

    if (isset($_SESSION["deleted_user"])) {
        $deleted = $_SESSION["deleted_user"];
        $message = "<p>Successfully deleted staff member <b>" . $deleted . "</b></p>";
        unset($_SESSION["deleted_user"]);
    } else {
        if (isset($_SESSION["failed_username"])) {
            $failed = $_SESSION["failed_username"];
            $message = "<p>Couldn't find staff member <b>" . $failed . "</b></p>";
            unset($_SESSION["failed_username"]);
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Staff Deletion</title>
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
            <?php echo $message; ?>
        </div>
    </body>
</html>