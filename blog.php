<?php
require_once("dbaccess.php");
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <?php include("includes/head.php") ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="stylee.css">
    <title>Blog</title>
    <style>

        .blog-entry img {
            width: 200px;
            height: auto;
            display: inline-block;
            margin-bottom: 5px;
        }



        .form-signin {
            width: 100%;
            max-width: 850px;
            padding: 15px;
            margin: auto;
        }




        .card-img-top {
            width: 100%;
            height: auto;
            max-width: 300px;
            max-height: 300px;
        }









    </style>
</head>
<body class="text-center">
<header>



<?php include("includes/Navbar.php") ?>

</header>

<div class="container">
    <main class="form-signin">
        <h1 class="custom-heading">Blog</h1>
        <br>
        <br>
        <div class="row">
            <?php
            

            // Display blog entries
            $sql = "SELECT * FROM news ORDER BY date DESC";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($id, $bild_url, $title, $text, $date);

            while ($stmt->fetch()) {
                echo "<div class='col-md-12 mb-4'>"; // Display one post per row
                echo "<div class='card shadow-sm'>";
                echo "<a href='$bild_url'><img src='$bild_url' class='card-img-top' alt='picture'></a>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>$title</h5>";
                echo "<p class='card-text'>$text</p>";
                echo "<p class='card-text'><small class='text-muted'>$date</small></p>";
                echo "</div></div></div>";
                echo "<hr>";
            }

            $stmt->close();
            $db->close();
            ?>
        </div>
    </main>
</div>

<footer>

    <?php include("includes/footer.php") ?>
    <?php include("includes/scripts.php") ?>

</footer>


<script src="bootstrap.bundle.min.js"></script>
</body>
</html>
