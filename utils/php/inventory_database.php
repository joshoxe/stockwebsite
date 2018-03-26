<?php
// Database related function for inventory management
    //session_start();

    // Start the db connection and bring in the game class
    require('connection.php');
    require_once('game.php');


    if (isset($_POST['updateId'])) {
        // If updateId has been sent, then update a record
        $id = htmlentities($_POST['updateId']);
        $name = htmlentities($_POST['updateName']);
        $console = htmlentities($_POST['updateConsole']);
        $qty = htmlentities($_POST['updateQty']);
        $price = htmlentities($_POST['updatePrice']);

        updateRecord($conn, $id, $name, $console, $qty, $price);
    }

    function listInventoryByName($search = "") {
        // Return a list of the inventory filtered by name
        // if no name present, just return all
        global $conn;
        $inventory = array();
        $sql = "SELECT * FROM inventory";

        if ($search != "") {
            $sql.= " WHERE name LIKE %?%";
        }

        $stmt = $conn->prepare($sql);
        $stmt->bind_result($dbId, $dbName, $dbConsole, $dbQty, $dbPrice);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                $inventory[] = new Game($dbId, $dbName, $dbConsole, $dbQty, $dbPrice);
            }
        } else {
            echo $sql;
        }

        return $inventory;
    }

    function updateRecord($conn, $id, $name, $console, $qty, $price) {
        // Update a record in the database
        $sql = $conn->prepare("UPDATE inventory SET name = ?, console = ?, qty = ?, price = ? WHERE id = ?");
        $sql->bind_param("sssss", $name, $console, $qty, $price, $id);
        if(!$sql->execute()) {
            echo $sql->error;
        }
    }
?>