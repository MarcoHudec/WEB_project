<?php
require_once("databaseScript/dbaccess.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/head.php") ?>
    <title>Profile</title>

</head>

<body>

    <?php include("includes/navbar.php") ?>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

         // Check if update button was clicked and necessary fields are set for updating user info
        if (isset($_POST["update"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["salutation"])) {
            
             // SQL query to update user info
            $query = "UPDATE users SET username=?, email=?, firstname=?, lastname=?, salutation=? WHERE id = ?";// . $_SESSION["userid"];
            $stmt = $db->prepare($query);
            $userid = $_SESSION["userid"];
            $stmt->bind_param("sssssi", $username, $useremail, $userfirstname, $userlastname, $usersalutation, $userid);

            // Retrieve and assign form data to variables
            $username = $_POST["username"];
            $useremail = $_POST["email"];
            $userfirstname = $_POST["firstname"];
            $userlastname = $_POST["lastname"];
            $usersalutation = $_POST["salutation"];

            $stmt->execute();
            $stmt->close();
            $_SESSION["username"] = $username;

        }

        // Check if fields are set for updating password
        if (isset($_POST["update"]) && isset($_POST["oldpassword"]) && isset($_POST["newpassword"]) && isset($_POST["confirmnewpassword"])) {

            // SQL query to select current user password
            $query = "SELECT users.password FROM users WHERE id = ?";
            $stmt = $db->prepare($query);
            $userid = $_SESSION["userid"];
            $stmt->bind_param("i", $userid);
            $stmt->execute();
            $stmt->bind_result($userpassword);

            $stmt->fetch();

            $stmt->close();
    
            // Check if new passwords match and meet criteria
            // Check if old password is correct
            // Update password in database if all conditions are met
            // Redirect with appropriate messages
            if ($_POST["newpassword"] == $_POST["confirmnewpassword"] && $_POST["newpassword"]!= "" && $_POST["confirmnewpassword"]!= "") {
                
                $password = $_POST["newpassword"];
                if (strlen($password) < 8 || !preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password) || !preg_match('@[^\w]@', $password)) {
                    $wrongnewMessage = true;
                    header("Location: profile.php?" .
                    "&oldMessage=" . $oldMessage.
                    "&newMessage=" . $newMessage.
                    "&wrongnewMessage=" . $wrongnewMessage);
                    exit();
                }

                if(password_verify($_POST["oldpassword"], $userpassword)){
                    
                    $query = "UPDATE users SET password=? WHERE id = ?";
                    $stmt = $db->prepare($query);
                    $stmt->bind_param("si", $userpassword, $userid);

                    $userpassword = password_hash($_POST["newpassword"], PASSWORD_DEFAULT);


                    $stmt->execute();
                    $stmt->close();
                    //$db->close();

                    $goodMessage = true;
                    header("Location: profile.php?" .
                        "&goodMessage=" . $goodMessage);
                    exit();
                }

            } else {

                if (!password_verify($_POST["oldpassword"], $userpassword) && $_POST["oldpassword"]!="") {
                    $oldMessage = true;

                }

                if ($_POST["newpassword"] != $_POST["confirmnewpassword"] && (($_POST["newpassword"]!="" &&  $_POST["confirmnewpassword"]=="") || ($_POST["confirmnewpassword"]!="" && $_POST["newpassword"]=="") || ($_POST["newpassword"]!="" && $_POST["confirmnewpassword"]!=""))) {
                    $newMessage = true;
                }
                header("Location: profile.php?" .
                    "&oldMessage=" . $oldMessage.
                    "&newMessage=" . $newMessage.
                    "&wrongnewMessage=" . $wrongnewMessage);
                exit();
            }
        }
   }
    
   // Retrieve user data from database to display in form
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $db->prepare($query);
    $userid = $_SESSION["userid"];
    $stmt->bind_param("i", $userid);
    $stmt->execute(); 
    $stmt->bind_result($userid, $username, $userpassword, $useremail, $userfirstname, $userlastname, $usersalutation, $userrole, $userstatus);
    $stmt->fetch();


    $stmt->close();
    
?>



    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="col">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="text-center">
                                    <h3 class="mt-1 mb-5 pb-1">User Profile</h3>
                                </div>
                                <form action="" method="post">
                                    <!-- Display user data in form fields for editing -->
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <div class="form-floating">
                                                    <select class="form-select" id="salutation" name="salutation">
                                                        <option value="male" <?php if($usersalutation=='male' ){
                                                            echo 'selected' ; } ?>>Mr</option>
                                                        <option value="female" <?php if($usersalutation=='female' ){
                                                            echo 'selected' ; } ?>>Mrs</option>
                                                        <option value="divers" <?php if($usersalutation=='divers' ){
                                                            echo 'selected' ; } ?>>Divers
                                                        </option>
                                                    </select>
                                                    <label for="salutation">Salutation</label>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="username"
                                                        name="username" placeholder="Username"
                                                        value="<?php echo $username ?>">
                                                    <label for="username">Username</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="firstname"
                                                        name="firstname" placeholder="Firstname"
                                                        value="<?php echo $userfirstname ?>">
                                                    <label for="firstname">Firstname</label>
                                                </div>
                                            </div>

                                            <div class="col-6 mb-3">
                                                <div class="form-floating">

                                                    <input type="text" class="form-control" id="lastname"
                                                        name="lastname" placeholder="Lastname"
                                                        value="<?php echo $userlastname ?>">
                                                    <label for="lastname">Lastname</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="E-Mail-Adress" value="<?php echo $useremail ?>">
                                            <label for="email">E-Mail-Adress</label>
                                        </div>
                                    </div>



                                    <hr class="my-4">
                                    <!-- Separation line between personal data and password -->

                                    <h3>Change Password:</h3>
                                    <!-- Section for changing password -->                       
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="oldPassword"
                                                name="oldpassword" placeholder="Old Password">
                                            <label for="oldPassword">Old Password</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="newPassword"
                                                name="newpassword" placeholder="New Password">
                                            <label for="newPassword">New Password</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="confirmNewPassword"
                                                name="confirmnewpassword" placeholder="New Password confirmed">
                                            <label for="confirmNewPassword">New Password confirmed</label>
                                        </div>
                                    </div>

                                    <?php
                                        if(isset($_GET["oldMessage"])) {
                                            if($_GET["oldMessage"]) {
                                                echo '<p class="text-danger text-center">Old password is incorrect!</p>';
                                            }
                                        }

                                        if(isset($_GET["newMessage"])) {
                                        if($_GET["newMessage"]) {
                                            echo '<p class="text-danger text-center">New passwords do not match!</p>';
                                        }
                                        }

                                        if(isset($_GET["wrongnewMessage"])) {
                                            if($_GET["wrongnewMessage"]) {
                                                echo '<p class="text-danger text-center">New password must be at least 8 characters long and contain letters, numbers and special characters!</p>';
                                            }
                                        }


                                        if (isset($_GET["goodMessage"])) {
                                            echo '<p class="text-success text-center">Password has been changed succesfully!</p>';
                                        }
                                    ?>

                                    <div class="mb-4"> 
                                        <div class="d-flex align-items-center justify-content-center">
                                            <input class="btn btn-primary" name="update" type="submit"
                                                value="Save">
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>


<?php include("includes/footer.php") ?>
<?php include("includes/scripts.php")?>


</html>



<?php

exit();

?>