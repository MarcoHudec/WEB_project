<?php

    require_once("../databaseScript/dbaccess.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Validate username input
        if (isset($_POST["username"])) {
            $username = $_POST["username"];
            // Check for empty username and character restrictions
            // Set error messages accordingly
            if (strlen($username) == 0) {
                $invalidUsernameMessage = "Please enter a username";
            } elseif (preg_match('@[^\w]@', $username)) {
                $invalidUsernameMessage = "Please do not use special characters";
            }
        }

        // Validate password input
        if (isset($_POST["password"])) {
            $password = $_POST["password"];
            // Check for empty password, length, and character complexity
            // Set error messages accordingly
            if (strlen($password) == 0) {
                $invalidPasswordMessage = "Please enter a password";
            } elseif (strlen($password) < 8 || !preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password) || !preg_match('@[^\w]@', $password)) {
                $invalidPasswordMessage = "Password requires at least 8 characters and each of the following elements: uppercase letter, lowercase letter, number, special character";
            }
        }

        
        session_start();
        // Proceed only if there are no validation errors
        if (empty($invalidUsernameMessage) && empty($invalidPasswordMessage)) {
            
                // Prepare SQL query to retrieve user information from the database
                $query = "SELECT users.id, users.username, users.password, users.role, users.status FROM users WHERE username = ?";
                $stmt = $db->prepare($query);

                $stmt->bind_param("s", $username); 
                $stmt->execute(); 
                $stmt->bind_result( $userid, $username, $userpassword, $userrole, $userstatus);
                $stmt->fetch();


                // Verify the password
                if (password_verify($_POST["password"], $userpassword)) {

                    // Check if the user account is active
                    if ($userstatus=="active") {


                        // Set session variables
                        $_SESSION["active"] = true;
                        $_SESSION["username"] = $username;
                        $_SESSION["userid"] = $userid;
                        // Check if user is an admin
                        if ($userrole == "admin") {
                            $_SESSION["admin"] = true;
                        }


                        if (!empty($_POST["remember"])) {
                            setcookie("username", $_POST["username"], time() + 3600);
                            setcookie("password", $_POST["password"], time() + 3600);
                        }

                        if (empty($_POST["remember"])) {
                            setcookie("username", $_POST["username"], time() - 3600);
                            setcookie("password", $_POST["password"], time() - 3600);
                        }

                        // Redirect to the homepage after successful login
                        header("Location: ../index.php");
                        $stmt->close();
                        exit();

                    } else {
                        // Handle inactive account scenario
                        $inactiveMessage = true;
                        header("Location: ../login.php?".
                            "&inactiveMessage=".$inactiveMessage);
                        exit();


                    }
                } else {
                    // Handle incorrect password scenario
                    $invalidPasswordMessage = "Username or Password is false";
                    $stmt->close();
                }
        }
        // Redirect back to the login page with error messages if validation fails
        header("Location: ../login.php?".
            "&invalidUsernameMessage=".$invalidUsernameMessage."&username=".$username.
            "&invalidPasswordMessage=".$invalidPasswordMessage."&password=".$password);
        exit();
    }
?>