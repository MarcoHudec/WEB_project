<?php
// Database connection configuration
$dbhost = "localhost"; // Hostname where the database is located
$dbuser = "root"; // Username for database access
$dbpassword = ""; // Password for database access
$dbname = "hotelwebsite"; // Name of the database

// Suppressing strict error reporting for mysqli to avoid showing strict mode errors
mysqli_report(MYSQLI_REPORT_ERROR ^ MYSQLI_REPORT_STRICT);

// Creating a new mysql connection
$db = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

// Setting character encoding to UTF-8 for the database connection
$db->set_charset("utf8");

// Checking for connection errors
if ($db->connect_error) {
    echo "Connection error" . $db->connect_error; // Displaying error message if connection fails
    exit(); // Exiting the script if there's a connection error
}
?>
