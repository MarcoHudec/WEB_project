<?php
session_start();

$_validity = false;
$_username_global = "Marcel";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_username = $_POST["username"];
    $_password = $_POST["password"];

    if ($_username === $_username_global && $_password === "Marcel12345") {
        $_SESSION["username"] = $_username;
        $_validity = true;
        header("Location: ../index.php"); // Weiterleitung, wenn die Anmeldedaten korrekt sind
        exit();
    } else {
        // Fehlermeldung wenn Username oder Passwort falsch
        $_SESSION["error"] = "False Username or Password";
        
        header("Location: ../Login.php");
        exit();
    }
} else {
    header("Location: ../Login.php");
    exit();
}
?>