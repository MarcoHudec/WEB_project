<?php 

$host = "localhost";
$user = "root";
$password = "";
$database = "hotelwebsite";

$db = new mysqli($host, $user, $password, $database);

if($db->connect_error) {
    echo "Connection Error: " . $db -> connect_error;
    exit();
}
