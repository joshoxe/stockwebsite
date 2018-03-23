<?php
    session_start();
    $address = "localhost";
    $username = "root";
    $password = "";
    $database = "stock_site";
    // TO DO: Re-arrange all of this to avoid endless if statements. Call the function some other way (in POST)?

    if (isset($_POST["addUsername"]) && isset($_POST["addPassword"])) {
        $user = htmlentities($_POST["addUsername"]);
        $pass = htmlentities($_POST["addPassword"]);

        addUser($user, $pass, 1);
    }

    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $user = htmlentities($_POST["username"]);
        $pass = htmlentities($_POST["password"]);

        authUser($user, $pass);
    }

    function addUser($user, $pass, $priv) {
        global $address;
        global $username;
        global $password;
        global $database;
        $conn = new mysqli($address, $username, $password, $database);
        if ($conn->connect_error) {
            die($conn->connect_error);
        } else {
            $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);
            $sql = $conn->prepare("INSERT INTO users (username, password, admin) VALUES (?, ?, ?)");
            $sql->bind_param("sss", $user, $hashed_pass, $priv);
            $sql->execute();
            mysqli_close($conn);
        }
    }

    function authUser($user, $pass) {
        global $address;
        global $username;
        global $password;
        global $database;
        $conn = new mysqli($address, $username, $password, $database);
        if ($conn->connect_error) {
            die($conn->connect_error);
        } else {
            $sql = $conn->prepare("SELECT username, password, admin FROM users WHERE username = ?");
            $sql->bind_param("s", $user);
            $sql->bind_result($dbUser, $dbPass, $dbAdmin);
            $sql->execute();
            $sql->store_result();

            if ($sql->num_rows > 0) {

                while($sql->fetch()) {
                    if (password_verify($pass, $dbPass)) {
                        $_SESSION['user'] = $dbUser;
                        $_SESSION["admin"] = $dbAdmin;
                        header("Location: ../../index.php");
                    } else {
                        header("Location: ../../login.php");
                    }
                }
            } else {
                header("Location: ../../login.php");
            }
        }
    }
?>