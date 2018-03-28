<!DOCTYPE html>
<?php
    session_start();
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
<html>
    <head>
        <title>Remove Item</title>
        <script src="utils/js/validation.js"></script>
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
        <div id="form">
        <p>Remove an item</p>
            <form name="deleteForm" action="utils/php/inventory_database.php" method="POST" onsubmit="return validateDelete()">
                <input class="field" type="text" name="removeName" placeholder="Item name"><br />
                <input class="button" type="submit" value="Confirm">
            </form>
        </div>
    </body>
</html>