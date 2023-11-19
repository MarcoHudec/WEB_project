<?php
if (isset($_POST["submit"])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'docx');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 102400) {
                $directory = '../news/';
                $fileNameNew = 'profile_picture.' . $fileActualExt;
                $fileDestination = $directory . $fileNameNew;

                // Delete existing file
                if (file_exists($fileDestination)) {
                    unlink($fileDestination);
                }

                // Move uploaded file to the destination
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: ../Profile.php?uploadsuccess");
            } else {
                echo "Your file is too big";
            }
        } else {
            echo "There was an error uploading your file";
        }
    } else {
        echo "You cannot upload files of this type";
    }
}
?>




