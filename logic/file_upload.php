<?php
if (isset($_POST["submit"])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    // Set allowed file extensions
    $allowed = array('jpg', 'jpeg', 'png', 'gif');

    // Path to the directory and default image
    $directory = '../news/';
    $defaultImage = 'Images/defaultPB.jpg';

    // Delete the existing image if present
    $images = scandir($directory);
    foreach ($images as $image) {
        if ($image != "." && $image != ".." && in_array(pathinfo($image, PATHINFO_EXTENSION), $allowed)) {
            unlink($directory . $image);
        }
    }

    // Check if an image is uploaded
    if (!empty($fileName)) {
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 302400) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = $directory . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: ../Profile.php?uploadsuccess");
                } else {
                    echo "Your file is too big.";
                }
            } else {
                echo "There was an error uploading your file.";
            }
        } else {
            echo "You cannot upload files of this type.";
        }
    } else {
        // If no image is uploaded, set default profile picture
        copy($defaultImage, $directory . 'defaultPB.jpg');
        header("Location: ../Profile.php?uploadsuccess");
    }
}
?>
