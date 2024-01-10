<?php
require_once("databaseScript/dbaccess.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/head.php") ?>
    <title>Blog</title>
    <style>
        .form-signin {
            /* CSS for form styling */
            width: 100%;
            max-width: 850px;
            padding: 15px;
            margin: auto;
        }
        
        .blog-image {
            /* CSS for blog image styling, including responsive design for smaller screens */
            width: 100%;
            height: 100%;
            max-width: 300px;
            max-height: 300px;
        }

        /* Für kleinere Bildschirme */
        @media (max-width: 768px,) {
            .blog-image {
                max-width: 50%;
                max-height: 50%; 
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
        <div class="row">
            <?php
            // PHP script to display blog entries from the database
            // Retrieves blog posts using SQL query and displays them in a loop
            // Each blog post is shown in a card format with image, title, text, and date
            $sql = "SELECT * FROM news ORDER BY date DESC";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($id, $bild_url, $title, $text, $date);

            while ($stmt->fetch()) {
                echo "<div class='col-md-12 mb-4'>"; 
                echo "<div class='card shadow-sm'>";
                echo "<div class='card-head'>";
                echo "<img src='$bild_url' class=' img-fluid blog-image' alt='picture' ></a>";
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

</body>

<?php include("includes/footer.php") ?>
    <?php include("includes/scripts.php") ?>
</html>
