<?php
    session_start();
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

    $inventory = listInventoryByName();
    $output = "";

    // Retrieve the inventory from the database and add each item to a table
    foreach ($inventory as $item) {
        $output.= "<tr>";
        $output.= "<td name='name', item='".  $item->get_id() ."'>" . $item->get_name() . "</td>" .
        "<td name='console', item='".  $item->get_id() ."'>" . $item->get_console() . "</td>" .
        "<td name='qty', item='".  $item->get_id() ."'>" . $item->get_qty() . "</td>" .
        "<td name='price', item='".  $item->get_id() ."'>" . $item->get_price() . "</td>";
        $output.= "</tr>";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Company Inventory</title>
        <script src="utils/js/inventory.js"></script>
    </head>
    
    <body onload="addEventListeners()">
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
           <table id='inventory_table'>
            <tr>
                <th>Name</th>
                <th>System</th>
                <th>Stock</th>
                <th>Price</th>
            </tr>
            <?php echo $output; ?>
           </table>
        </div>
    </body>
</html>