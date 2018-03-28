<?php
    session_start();

    require('utils/php/user_check.php');
    
    $message = "";
    foreach($_SESSION as $key => $value) 
{ 
     echo $key . ' = ' . $value; 
}  

    if (isset($_SESSION["added_item"])) {
        $added = $_SESSION["added_item"];
        $message = "<p>Successfully added item <b>" . $added . "</b></p>";
        unset($_SESSION["added_item"]);
    } else {
        if (isset($_SESSION["failed_item"])) {
            $failed = $_SESSION["failed_item"];
            $message = "<p>Couldn't add item <b>" . $failed . "</b></p>";
            unset($_SESSION["failed_item"]);
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Staff Deletion</title>
        <link rel="stylesheet" type="text/css" href="utils/css/style.css">
        <link rel="stylesheet" type="text/css" href="utils/css/responsive_style.css">
        <meta name="viewport" content="width=device-width,initial-scale=1">
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
            <div class="result">
                <?php
                    echo $message;
                    
                    if ($message == "") {
                        header("Location: add_item.php");
                    }

                ?>
            </div>
        </div>
    </body>
</html>