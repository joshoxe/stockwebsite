<?php
    session_start();

    require('utils/php/user_check.php');
    
    $message = "";

    if (isset($_SESSION["added_username"])) {
        $added = $_SESSION["added_username"];
        $message = "<p>Successfully added staff member <b>" . $added . "</b></p>";
        unset($_SESSION["added_username"]);
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
                        header("Location: add_user.php");
                    }

                ?>
            </div>
        </div>
    </body>
</html>