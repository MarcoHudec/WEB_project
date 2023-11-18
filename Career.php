<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Career Page</title>
    <?php include("includes/head.php")?>
</head>

<body>
    
<?php include("includes/Navbar.php")?>

    <h1>Upload Images</h1>

    <!-- Form for file upload -->
    <form action="logic/file_upload.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            
            <input type="file" name="file" accept="image/*">
        </div>
        <button type="submit" name="submit">Upload Image</button>
    </form>

    <h2>Uploaded Images</h2>
    <div class="image-gallery">
        <?php
        // Display uploaded images
        $directory = 'news/'; // Relative path to the directory
        $images = scandir($directory);

        foreach ($images as $image) {
            if ($image != "." && $image != "..") {
                echo '<img src="' . $directory . $image . '" alt="' . $image . '" style="width: 200px; height: 150px; margin: 10px;">';
            }
        }
        ?>
    </div>

    <?php include("includes/Footer.php")?>

    <?php include("includes/scripts.php")?>

</body>

</html>
