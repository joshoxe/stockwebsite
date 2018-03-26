<?php
        session_start();
        $address = "localhost";
        $username = "root";
        $password = "";
        $database = "stock_site";

        if (isset($_POST["addUsername"]) && isset($_POST["addPassword"])) {
            // Is the request to add a user?

            $user = htmlentities($_POST["addUsername"]);
            $pass = htmlentities($_POST["addPassword"]);

            if (isset($_POST["admin"])) {
                $admin = 1;
            } else {
                $admin = 0;
            }

            addUser($user, $pass, $admin);
        }

        if (isset($_POST["username"]) && isset($_POST["password"])) {
            // Is the request a login request?

            $user = htmlentities($_POST["username"]);
            $pass = htmlentities($_POST["password"]);

            authUser($user, $pass);
        }

        if (isset($_POST["removeUsername"])) {
            // Is the request to remove a user?

            $user = htmlentities($_POST["removeUsername"]);

            removeUser($user);
        }

        function listUsers() {
            // Retrieve all users from the db
            global $address;
            global $username;
            global $password;
            global $database;
            $conn = new mysqli($address, $username, $password, $database);
            if ($conn->connect_error) {
                die($conn->connect_error);
            } else {
                $users = array();

                $sql = $conn->query("SELECT * FROM users");
                echo $conn->error;
                if($sql->num_rows > 0) {
                    while($row = $sql->fetch_assoc()) {
                        $users += [$row["username"] => $row["admin"]];
                    }
                }
                return $users;
            }
        }

        function removeUser($user) {
            // Remove a user from the database
            // This currently isn't working correctly
            global $address;
            global $username;
            global $password;
            global $database;
            $conn = new mysqli($address, $username, $password, $database);
            if ($conn->connect_error) {
                die($conn->connect_error);
            } else {
                $sql = $conn->prepare("SELECT COUNT(id) FROM users WHERE username = ?");
                $sql->bind_param('s', $user);
                $sql->bind_result($count);
                $sql->execute();

                //if(!$sql->execute()) {
                //    $_SESSION["deleted_user"] = trigger_error($sql->error);
                //}

                if ($count > 0) {
                    $sql = $conn->prepare("DELETE FROM users WHERE username = ?");
                    $sql->bind_param("s", $user);
                    $sql->execute();
                $_SESSION["deleted_user"] = $user;
                } else {
                    $_SESSION["failed_username"] = $count;
                }
                
                header("Location: ../../user_deletion_result.php");
            }

        }

        function addUser($user, $pass, $priv) {
            // Add a new user
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
            // Authorise a login attempt
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