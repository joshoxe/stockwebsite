<?php
if (isset($_SESSION["user"])) {
        // Check if user is logged in
        $loggedIn = '<a href="logout.php">Logout '. $_SESSION["user"].'</a>'; 
    } else {
        header("Location: login.php");
    }

    if (isset($_SESSION["admin"])) {
        // Check if user is admin
        if ($_SESSION["admin"] != 0) {
            $admin = '<a href="admin_panel.php">Administrator Panel</a>';
        } else {
            $admin = "";
        }
    }
?>