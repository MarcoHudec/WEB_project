<?php
if (isset($_POST["submit"])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName );
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'docx');

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0) 
            {
                if($fileSize < 102400){
                    $fileNameNew= uniqid('', true).".".$fileActualExt;
                    $fileDestination = '../news/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: ../Career.php?uploadsuccess");
                }
                else{
                    echo "Your File is too big";
                }
        }
        else{
            echo "There was an error uploading your file";
        }
    }
    else{
        echo "You cannot upload files of this type";
    }

} ?>



<?php
session_start();
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<body>
    <h1>Upload Images</h1>

    <!-- Form for file upload -->
    <form action="logic/file_upload.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="file" class="form-label">File</label>
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
</body>
