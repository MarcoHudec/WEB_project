<?php
session_start();

$_validity = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_username = $_POST["username"];
    $_password = $_POST["password"];

    if ($_username === "Marcel" && $_password === "12345") {
        $_SESSION["username"] = $_username;
        $_validity = true;
        header("Location: index.php"); // Weiterleitung, wenn die Anmeldedaten korrekt sind
        exit();
    } else {
        // Fehlermeldung wenn Username oder Passwort falsch
        $_SESSION["error"] = "Falscher Username oder Passwort";
        $_SESSION["username"] = $_username; // Gesendeten Username behalten
        header("Location: Login2.php");
        exit();
    }
} else {
    header("Location: Login2.php");
    exit();
}
?>