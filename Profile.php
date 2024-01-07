<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Profile</title>
    <?php include("includes/head.php")?>

</head>

<body>
    <?php include("includes/Navbar.php")?>

    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <h4 class="mt-1 mb-5 pb-1">User Profile</h4>
                                    </div>

                                    <form id="profileForm" action="logic/file_upload.php" method="post" enctype="multipart/form-data">


                                    <div class="profile-picture">
                                    <label class="form-label" for="userName">Profile Picture</label><br></br>
                                    <?php
                                        // Display uploaded images
                                        $directory = 'news/'; // Relative path to the directory
                                        $images = scandir($directory);

                                            foreach ($images as $image) {
                                                if ($image != "." && $image != "..") {
                                                    echo '<img src="' . $directory . $image . '" alt="' . $image . '" style="width: 200px; height: 200px; margin: 10px;">';
                                                }
                                            }
                                            ?>
                                    </div>
                                    

                                        <!-- Profile Picture Upload -->
                                        <form action="logic/file_upload.php" method="POST" enctype="multipart/form-data">
                                        
                                        <div class="mb-3">
                                            <label for="fileInput" class="form-label">Choose File</label>
                                            <input type="file" name="file" class="form-control" id="fileInput" accept="image/*">
                                        </div>
                                        
                                            <button type="submit" name="submit" class="btn btn-primary">Upload Image</button>
                                        </form>


                                        

                                        <!-- Display user information fetched from session variables -->
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="userName">Username</label>
                                            <input type="text" name="userName" id="userName" class="form-control" value="<?php echo htmlspecialchars($_SESSION['username']); ?>">
                                        </div>



                                        <!-- DAS FUNKTIONERT ERST WENN EMAIL USW AUCH GEGEBEN!!!!!!
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="userEmail">Email</label>
                                            <input type="email" name="userEmail" id="userEmail" class="form-control" value="<?php echo htmlspecialchars($_SESSION['userEmail']); ?>">
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="userRole">Role</label>
                                            <input type="text" name="userRole" id="userRole" class="form-control" value="<?php echo htmlspecialchars($_SESSION['userRole']); ?>">
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="userPhone">Phone</label>
                                            <input type="text" name="userPhone" id="userPhone" class="form-control" value="<?php echo htmlspecialchars($_SESSION['userPhone']); ?>">
                                        </div>
                                        -->



                                        


                                        
                                        

                                        

                                        <!-- Submit button -->
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" style="width: 100%;">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("includes/Footer.php")?>
    <?php include("includes/scripts.php")?>
</body>

</html>
