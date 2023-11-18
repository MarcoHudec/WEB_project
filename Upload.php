<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Header-Inhalte hier einfügen -->
</head>
<body>

<div class="container">
    <h1>News Page</h1>

    <!-- Formular für Bild-Upload -->
    <?php include('logic/file_upload.php'); ?>
    <form action="logic/file_upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*">
        <input type="submit" value="Upload Image" name="submit">
    </form>

    <!-- Anzeige der hochgeladenen Bilder als Thumbnails -->
    <div class="row">
        <?php
        // Verzeichnis mit Thumbnails auslesen und anzeigen
        $thumbnails = glob('thumbnails/*');
        foreach ($thumbnails as $thumbnail) {
            echo '<div class="col-md-3">';
            echo '<img src="' . $thumbnail . '" class="img-fluid" alt="Thumbnail">';
            echo '</div>';
        }
        ?>
    </div>
</div>

<!-- Weitere Inhalte und Skripte hier einfügen -->

</body>
</html>
