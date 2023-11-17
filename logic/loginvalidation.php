<?php
session_start();

$_validity = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_mail = $_POST["mail"];
    $_password = $_POST["password"];

    if ($_mail === "username@gmail.com" && $_password === "12345") {
        $_SESSION["mail"] = $_mail;
        $_validity = true;
        header("Location: index.php"); // Weiterleitung, wenn die Anmeldedaten korrekt sind
        exit();
    } else {
        // Fehlermeldung wenn E-Mail oder Passwort falsch
        $_SESSION["error"] = "Falsche Email oder Passwort";
        $_SESSION["mail"] = $_mail; // Gesendete E-Mail behalten
        header("Location: Login2.php");
        exit();
    }
} else {
    header("Location: Login2.php");
    exit();
}
?>