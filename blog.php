<?php
require_once("databaseScript/dbaccess.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/head.php") ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
    <style>

        .blog-entry img {
            width: 200px;
            height: 200px;
            display: inline-block;
            margin-bottom: 5px;
        }



        .form-signin {
            width: 100%;
            max-width: 850px;
            padding: 15px;
            margin: auto;
        }




        .card-img-top, .blog-entry img {
                max-width: 100%;
                height: auto;
            }

        .blog-image {
            width: 300px;
            height: 300px;
            object-fit: cover; /* Dies sorgt dafür, dass das Bild richtig zugeschnitten wird, ohne verzerrt zu werden */
        }

/* Für kleinere Bildschirme */
@media (max-width: 768px) {
    .blog-image {
        max-width: 100%;
        max-height: 300px; /* Begrenzt die Höhe auf maximal 300px */
    }
}









    </style>
</head>
<body class="text-center">
<header>



<?php include("includes/navbar.php") ?>

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
                echo "<div class='card-head'>";
                echo "<img src='$bild_url' class='card-img-top img-fluid blog-image' alt='picture' ></a>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>$title</h5>";
                echo "<p class='card-text' style='text-align: left;'>$text</p>";
                echo "<p class='card-date'><small class='text-muted'>$date</small></p>";
                echo "</div></div></div></div>";
                echo "<hr>";
            }

            $stmt->close();
            $db->close();
            ?>
        </div>
    </main>
</div>



    <?php include("includes/footer.php") ?>
    <?php include("includes/scripts.php") ?>





</body>
</html>
