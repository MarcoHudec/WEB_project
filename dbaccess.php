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

function findAllNews() {
    global $db;
    
    $sql = "SELECT * FROM news";
    $result = $db->query($sql);

    $news = [];
    while($row = $result->fetch_array()) {
        $news[] = $row;
    }

    return $news;
}

function saveNews($bild_url, $title, $text) {
    global $db;

    $sql = "INSERT INTO `news`(`bild_url`, `title`, `text`) VALUES (?, ?, ?)"; 
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sss",$bild_url, $title, $text);

    $stmt->execute();
}