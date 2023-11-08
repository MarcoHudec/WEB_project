<?php
session_start();
if (
$_POST["username"] === "admin"
&& $_POST["password"] === "123"
) {
$_SESSION["username"] = $_POST["username"];
}
?> 