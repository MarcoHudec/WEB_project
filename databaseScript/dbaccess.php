<?php

// TODO

$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "hoteldb";

mysqli_report(MYSQLI_REPORT_ERROR ^ MYSQLI_REPORT_STRICT); //später optional auskommentierbar
$db = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
$db->set_charset("utf8");

if($db->connect_error) {
    echo "Connection error" . $db->connect_error;
    exit();
}
