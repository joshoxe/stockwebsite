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
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Company Inventory</title>
    </head>
    
    <body>
        <div class="company_logo">
            <img class="company_img" src="img/logo.png" height="110" width="200">
        </div>
        <div class="inventory_navigation">
            <ul class="inv_nav">
                <li><?php echo $loggedIn; ?></li>
                <li><?php echo $admin; ?></li>
            </ul>

        </div>

        <div class="inventory_content">

        </div>
    </body>
</html>