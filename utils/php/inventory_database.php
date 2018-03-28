<?php
// Database related function for inventory management
    session_start();

    // Start the db connection and bring in the game class
    require('connection.php');
    require_once('game.php');

    if (isset($_POST["searchValue"])) {
        // Search for an item in the inventory
        $value = "%" . htmlentities($_POST["searchValue"]) . "%";
        $system = htmlentities($_POST["searchConsole"]);

        listInventory($value, $system);
    }

    if (isset($_POST['updateId'])) {
        // If updateId has been sent, then update a record
        $id = htmlentities($_POST['updateId']);
        $name = htmlentities($_POST['updateName']);
        $console = htmlentities($_POST['updateConsole']);
        $qty = htmlentities($_POST['updateQty']);
        $price = htmlentities($_POST['updatePrice']);

        updateRecord($conn, $id, $name, $console, $qty, $price);
    }

    if (isset($_POST["removeName"])) {
        $item = htmlentities($_POST["removeName"]);

        removeItem($conn, $item);
    }

    if (isset($_POST["addItemName"])) {
        // This is a request to add an item
        // not all fields necessary

        $name = htmlentities($_POST["addItemName"]);
        $console = "";
        $stock = "";
        $price = "";

        if (isset($_POST["addItemConsole"])) {
            $console = htmlentities($_POST["addItemConsole"]);
        }

        if (isset($_POST["addItemStock"])) {
            $stock = htmlentities($_POST["addItemStock"]);
        }

        if (isset($_POST["addItemPrice"])) {
            $price = htmlentities($_POST["addItemPrice"]);
        }

        addItem($conn, $name, $console, $stock, $price);
    }

    function removeItem($conn, $item) {
        $sql = $conn->prepare("SELECT COUNT(id) FROM inventory WHERE name = ?");
        $sql->bind_param('s', $item);
        $sql->bind_result($count);
        $sql->execute();
        $sql->store_result();

        while($sql->fetch()) {
            if ($count > 0) {
                $sql = $conn->prepare("DELETE FROM inventory WHERE name = ?");
                $sql->bind_param("s", $item);
                $sql->execute();
                $_SESSION["deleted_item"] = $item;
            } else {
                $_SESSION["failed_item"] = $item;
            }
        }

        header("Location: ../../remove_item_result.php");

    }

    function addItem($conn, $name, $console, $stock, $price) {
        $sql = "INSERT INTO inventory (name, console, qty, price) VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $console, $stock, $price);

        if(!$stmt->execute()) {
            $_SESSION["failed_item"] = $name;
            echo $sql->error;
            header("Location: ../../item_add_result.php");
        }

        $_SESSION["added_item"] = $name;
        header("Location: ../../item_add_result.php");
    }

    function systemList() {
        // Get a list of all game systems in the database
        global $conn;
        $systems = array();
        $sql = $conn->query("SELECT console FROM inventory");

        if ($sql->num_rows > 0) {
            while ($row = $sql->fetch_assoc()){
                if (!in_array($row['console'], $systems)) {
                    array_push($systems, $row['console']);
                }
            }
        }

        return $systems;
    }

    function listInventory($value = "", $system = "All") {
        // Return a list of the inventory filtered by name
        // if no name present, just return all
        global $conn;
        $inventory = array();
        $sql = "SELECT * FROM inventory";

        if ($value != "") {
            $sql.= " WHERE name LIKE ?";

            if ($system != "All") {
                $sql.= " AND console = ?";
            }
        } else {
            if ($system != "All") {
                $sql.= " WHERE console = ?";
            }
        }

        $stmt = $conn->prepare($sql);
        if ($value != "" && $system != "All") {
            $stmt->bind_param("ss", $value, $system);
        } else if ($value != "") {
            $stmt->bind_param("s", $value);
        } else if ($system != "All") {
            $stmt->bind_param("s", $system);
        }

        $stmt->bind_result($dbId, $dbName, $dbConsole, $dbQty, $dbPrice);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                $inventory[] = new Game($dbId, $dbName, $dbConsole, $dbQty, $dbPrice);
            }
        }

        $outputInv = "";

        foreach ($inventory as $item) {
            $outputInv.= "<tr>";
            $outputInv.= "<td name='name', item='".  $item->get_id() ."'>" . $item->get_name() . "</td>" .
            "<td name='console', item='".  $item->get_id() ."'>" . $item->get_console() . "</td>" .
            "<td name='qty', item='".  $item->get_id() ."'>" . $item->get_qty() . "</td>" .
            "<td name='price', item='".  $item->get_id() ."'>" . $item->get_price() . "</td>";
            $outputInv.= "</tr>";
        }
        
        echo $outputInv;
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