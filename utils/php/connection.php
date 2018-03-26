<?php
    $address = "localhost";
    $username = "root";
    $password = "";
    $database = "stock_site";

    $conn = new mysqli($address, $username, $password, $database);
    if ($conn->connect_error) {
        die($conn->connect_error);
    }
?>