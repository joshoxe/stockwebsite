<?php
    require('utils/php/inventory_database.php');

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

    // Build console list for search filter
    $systems = systemList();
    $outputSys = "<option value='All'>All</option>";

    foreach ($systems as $system) {
        $outputSys.= "<option value='" . $system . "'>".$system."</option>";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Company Inventory</title>
        <script src="utils/js/inventory.js"></script>
        <link rel="stylesheet" type="text/css" href="utils/css/style.css">
        <link rel="stylesheet" type="text/css" href="utils/css/responsive_style.css">
        <meta name="viewport" content="width=device-width,initial-scale=1">
    </head>
    
    <body onload="addEventListeners()">
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
            <div id="inventory_search">
                <input type="text" value="Search" id="inv_search_box">
                <select id="system_select">
                    <?php echo $outputSys; ?>
                </select>
            </div>
           <div id='table'>
           <table id='inventory_table'>
            <a href="add_item.php"><span class="inventory_button">Add New Item</span></a>
            <a href="remove_item.php"><span class="inventory_button">Remove Item</span></a>
            <tr>
                <th>Name</th>
                <th>System</th>
                <th>Stock</th>
                <th>Price</th>
            </tr>
            <?php listInventory(); ?>
            </table>
           </div>
        </div>
    </body>
</html>