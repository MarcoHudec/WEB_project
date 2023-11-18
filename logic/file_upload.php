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




