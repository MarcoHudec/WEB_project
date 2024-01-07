<?php
require_once("dbaccess.php");
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <?php include("includes/adminhead.php") ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="Admin/common.css">
    <title>Blogbeitrag hinzufügen</title>
    <style>
        .red { color: red; }
        .green { color: green; }
        .blog-entry {
            display: flex;
            justify-content: center;
            align-content: center;
            padding: 10px;
            margin-bottom: 10px;
            width: 200px;
            height: 200px;
        }
        .blog-entry img {
            width: 100%;
            height: 100%;
            display: inline-block;
            margin-bottom: 5px;
        }



        .form-signin {
            width: 100%;
            max-width: 850px;
            padding: 15px;
            margin: auto;
        }

        .btn.btn-primary {
            margin: 10px 5px 5px;
        }









    </style>
    
</head>
<body >
<header>



    <?php include("includes/navbaradmin.php") ?>

</header>

<div class="col-lg-10 ms-auto p-4 overflow-hidden">
<div class="container">

    <main class="form-signin">
        <h1 class="custom-heading text-center">Add Blogpost</h1>


        <form action="" id="ticketform" method="POST" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="title" id="title" placeholder="Headline" value="<?= !empty($_POST["title"]) ? ($_POST["title"]) : '' ?>">
                <label for="title">Headline</label>
            </div>
            <div class="form-floating">
                <div>
                    <textarea class="form-control" name="text" form="ticketform" id="text" rows="6" placeholder="Add Text"><?php echo isset($_POST['text']) ? htmlspecialchars($_POST['text']) : ''; ?></textarea>
                    <label for="text"></label>
                </div>
            </div>




            <input type="file" class="form-control" id="inputGroupFile04" name="picture" required accept="image/jpeg, image/png, image/gif">
            <label for="inputGroupFile04"></label>

            <div class="text-center">
                <input class="btn btn-primary" name="submit" type="submit" value="Upload">
            </div>
        </form>





<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["submit"])) {
        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $target_dir = 'uploads/news/';
        $file = @$_FILES["picture"];
        $picname = explode(".", @$_FILES["picture"]["name"]);
        $target_file = $target_dir . $picname[0] . "_" . $timestamp . "." . end($picname);
        $acceptedtype = ["jpg", "jpeg", "png", "gif"];

        if (isset($_POST["text"]) && !empty($_POST["text"]) && isset($_POST["title"]) && !empty($_POST["title"])) {
            $text = $_POST["text"];
            $title = $_POST["title"];


            // Check type
            $uploadExt = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
            $acceptedtype = ["jpg", "jpeg", "png", "gif"];

            if (!in_array($uploadExt, $acceptedtype)) {
                echo "<div class='red'>Fehler, Datei ist kein Bild!</div>";
            } else {
                $date = new DateTime();
                $timestamp = $date->getTimestamp();
                $target_dir = 'uploads/news/';
                $file = @$_FILES["picture"];
                $picname = explode(".", @$_FILES["picture"]["name"]);
                $target_file = $target_dir . $picname[0] . "_" . $timestamp . "." . end($picname);


                // Move uploaded file
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    // Insert data into the database
                    createDBentry($text, $target_file, $title);
                } else {
                    echo "<div class='red'>Upload fehgeschlagen</div>";
                }
            }
        } else {
            echo "<div class='red'>Bitte alle Felder ausfüllen</div>";
        }

    }
}

function createDBentry($c, $path, $title) {
    global $db;
    $date = date('Y-m-d H:i:s');
    $stmt = $db->prepare("INSERT INTO news (bild_url, title, text, date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $path, $title, $c, $date);


    if ($stmt->execute()) {
        echo "<div class='green'>Upload erfolgreich!</div>";
    } else {
        echo "<div class='red'>Upload fehlgeschlagen</div>";
    }

    $stmt->close();
}
?>


    </main>

</div>
</div>

<?php include("includes/scripts.php") ?>


<script src="bootstrap.bundle.min.js"></script>
</body>
</html>

