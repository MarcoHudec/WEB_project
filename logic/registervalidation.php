<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //$invalidEmail = $invalidPassword = false;

    if (isset($_POST["firstname"]))
    {
        $firstname = $_POST["firstname"];
        if (strlen($firstname) == 0) {
            $invalidFirstnameMessage = "Please enter your first name";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
            $invalidFirstnameMessage = "Please do not use special characters or numbers";
       }

        }

    if (isset($_POST["lastname"]))
    {
        $lastname = $_POST["lastname"];
        if (strlen($lastname) == 0) {
            $invalidLastnameMessage = "Please enter your last name";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
            $invalidLastnameMessage = "Please do not use special characters or numbers";
        }

    }


    if (isset($_POST["salutation"]))
    {
        $salutation = $_POST["salutation"];
        if ($salutation == null) {
            $invalidSalutationMessage = "Please give a salutation";
        }

    }







    if (isset($_POST["username"]))
    {
        $username = $_POST["username"];
        if (strlen($username) == 0) {
            $invalidUsernameMessage = "Please enter a username";
        } elseif (preg_match('@[^\w]@', $username)) {
            $invalidUsernameMessage = "Please do not use special characters";
        }

    }

    if (isset($_POST["email"]))
    {
        $email = $_POST["email"];
        if (strlen($email) == 0) {
            $invalidEmailMessage = "Please enter your email address";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $invalidEmailMessage = "Please provide correct email address";
        }

    }

    if (isset($_POST["password"]))
    {
        $password = $_POST["password"];
        if (strlen($password) == 0) {
            $invalidPasswordMessage = "Please enter a password";
        } elseif (strlen($password) < 8 || !preg_match('@[A-Z]@',$password) || !preg_match('@[a-z]@',$password) || !preg_match('@[0-9]@',$password) || !preg_match('@[^\w]@',$password)) {
            $invalidPasswordMessage = "Password requires at least 8 characters and each of the following elements: uppercase letter, lowercase letter, number, special character";
        }


    }

    if (isset($_POST["passwordcheck"]))
    {
        $passwordcheck = $_POST["passwordcheck"];
        if (strlen($passwordcheck) == 0) {
            $invalidPasswordcheckMessage = "Please re-enter your password";
        } elseif ($passwordcheck != $password) {
            $invalidPasswordcheckMessage = "Passwords do not match";
        } elseif (strlen($password) < 8 || !preg_match('@[A-Z]@',$password) || !preg_match('@[a-z]@',$password) || !preg_match('@[0-9]@',$password) || !preg_match('@[^\w]@',$password)) {
            $invalidPasswordcheckMessage = "Password requires at least 8 characters and each of the following elements: uppercase letter, lowercase letter, number, special character";
        }


    }

    }


if (!isset($invalidFirstnameMessage) && !isset($invalidLastnameMessage) && !isset($invalidSalutationMessage) && !isset($invalidUsernameMessage) && !isset($invalidEmailMessage) && !isset($invalidPasswordMessage) && !isset($invalidPasswordcheckMessage)) {

    require_once("../databaseScript/dbaccess.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["register"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["salutation"]) && isset($_POST["passwordcheck"]) && (($_POST["password"])==($_POST["passwordcheck"]))) {
        // TODO

        $query = "INSERT INTO users (username, password, email, firstname, lastname, salutation, role, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);

        $stmt->bind_param("ssssssss", $username, $userpassword, $useremail, $userfirstname, $userlastname, $usersalutation, $userrole, $userstatus);

        $username = $_POST["username"];
        $userpassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $useremail = $_POST["email"];
        $userfirstname = $_POST["firstname"];
        $userlastname = $_POST["lastname"];
        $usersalutation = $_POST["salutation"];
        $userrole = "user";
        $userstatus="active";

        $stmt->execute();
        $stmt->close();
        //$db->close();

    }
}



    session_start();
    $_SESSION["eingeloggt"] = true;
    $_SESSION["username"] = $username;


    $query = "SELECT users.id FROM users WHERE username = ?";
    $stmt = $db->prepare($query);

    $stmt->bind_param("s", $username); //bind_param id ins ? reingeben //i = integer
    $stmt->execute(); //datenbank anfrage: liefert nur text!
    $stmt->bind_result( $userid);
    $stmt->fetch();
    $stmt->close();
    //$db->close()


    $_SESSION["userid"] = $userid;





    header("Location: ../index.php");
    exit();
}










header("Location: ../ourregister.php?".
    "&invalidFirstnameMessage=".$invalidFirstnameMessage."&firstname=".$firstname.
    "&invalidLastnameMessage=".$invalidLastnameMessage."&lastname=".$lastname.
    "&invalidSalutationMessage=".$invalidSalutationMessage."&salutation=".$salutation.
    "&invalidUsernameMessage=".$invalidUsernameMessage."&username=".$username.
    "&invalidEmailMessage=".$invalidEmailMessage."&email=".$email.
    "&invalidPasswordMessage=".$invalidPasswordMessage."&password=".$password.
    "&invalidPasswordcheckMessage=".$invalidPasswordcheckMessage."&passwordcheck=".$passwordcheck);


?>