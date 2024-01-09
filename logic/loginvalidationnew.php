<?php

    require_once("../databaseScript/dbaccess.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //$invalidUsernameMessage = $invalidPasswordMessage = '';
    //$username = $password = '';



    if (isset($_POST["username"])) {
        $username = $_POST["username"];
        if (strlen($username) == 0) {
            $invalidUsernameMessage = "Please enter a username";
        } elseif (preg_match('@[^\w]@', $username)) {
            $invalidUsernameMessage = "Please do not use special characters";
        }
    }

    if (isset($_POST["password"])) {
        $password = $_POST["password"];
        if (strlen($password) == 0) {
            $invalidPasswordMessage = "Please enter a password";
        } elseif (strlen($password) < 8 || !preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password) || !preg_match('@[^\w]@', $password)) {
            $invalidPasswordMessage = "Password requires at least 8 characters and each of the following elements: uppercase letter, lowercase letter, number, special character";
        }
    }

    // Session starten und prüfen, ob Benutzer erfolgreich angemeldet ist
    session_start();
    if (empty($invalidUsernameMessage) && empty($invalidPasswordMessage)) {
        // Hier könnten Sie die Benutzerdaten überprüfen und ggf. die Session setzen
        // Beispielüberprüfung mit statischen Daten

        //username: demo
        //pw: Pass1234.




        //username: demoadmin
        //pw: Pass12345.


            $query = "SELECT users.id, users.username, users.password, users.role, users.status FROM users WHERE username = ?";
            $stmt = $db->prepare($query);

            $stmt->bind_param("s", $username); //bind_param id ins ? reingeben //i = integer
            $stmt->execute(); //datenbank anfrage: liefert nur text!
            $stmt->bind_result( $userid, $username, $userpassword, $userrole, $userstatus);
            $stmt->fetch();



            if (password_verify($_POST["password"], $userpassword)) {


                if ($userstatus=="active") {


                    // Login erfolgreich
                    $_SESSION["eingeloggt"] = true;
                    $_SESSION["username"] = $username;
                    $_SESSION["userid"] = $userid;
                    if ($userrole == "admin") {
                        $_SESSION["admin"] = true;
                    }


                    //Cookie für Remember me

                    if (!empty($_POST["remember"])) {
                        setcookie("username", $_POST["username"], time() + 3600);
                        setcookie("password", $_POST["password"], time() + 3600);
                    }

                    if (empty($_POST["remember"])) {
                        setcookie("username", $_POST["username"], time() - 3600);
                        setcookie("password", $_POST["password"], time() - 3600);
                    }


                    header("Location: ../index.php");
                    $stmt->close();
                    //$db->close()
                    exit();

                } else {
                    $inactiveMessage = true;
                    header("Location: ../ourlogin.php?".
                        "&inactiveMessage=".$inactiveMessage);
                    exit();


                }



            } else {
                // Login fehlgeschlagen
                $invalidPasswordMessage = "Username or Password is false";
                $stmt->close();
                //$db->close()
            }





    }







    header("Location: ../ourlogin.php?".
        "&invalidUsernameMessage=".$invalidUsernameMessage."&username=".$username.
        "&invalidPasswordMessage=".$invalidPasswordMessage."&password=".$password);
    exit();
}



?>