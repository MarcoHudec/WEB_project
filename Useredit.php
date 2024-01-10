<?php

require_once("databaseScript/dbaccess.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["search"]) && (isset($_POST["sid"]))) {

        // Check if the ID field is not empty and get users informations.
        if (($_POST["sid"]) != null) {
            $query = "SELECT * FROM users WHERE id = ?";
            $stmt = $db->prepare($query);
            $suserid = $_POST["sid"];
            $stmt->bind_param("i", $suserid);
            $stmt->execute(); 
            $stmt->bind_result($suserid, $susername, $suserpassword, $suseremail, $suserfirstname, $suserlastname, $susersalutation, $suserrole, $suserstatus);
            $stmt->fetch();


            $stmt->close();
        } 

    }
    // Check if update button was clicked and an ID is set.
    if (isset($_POST["update"]) && isset($_POST["sid"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["firstname"]) && !empty($_POST["lastname"])) { 

        // Check if password is set and not empty.
        if (isset($_POST["password"]) && !empty($_POST["password"])) {

            // Prepare an SQL query to update all user fields including password.
            $query = "UPDATE users SET username=?, password=?, email=?, firstname=?, lastname=?, salutation=?, role=?, status=? WHERE id=?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("ssssssssi", $username, $userpassword, $useremail, $userfirstname, $userlastname, $usersalutation, $userrole, $userstatus, $userid);

            // Prepare an SQL query to update all user fields except password.
        } else {
            $query = "UPDATE users SET username=?, email=?, firstname=?, lastname=?, salutation=?, role=?, status=? WHERE id=?";
            $stmt = $db->prepare($query);
            $stmt->bind_param("sssssssi", $username, $useremail, $userfirstname, $userlastname, $usersalutation, $userrole, $userstatus, $userid);

            // Retrieve and assign form data to variables.
        }
        if (isset($_POST["username"])) {
            $username = $_POST["username"];
        }
        if (isset($_POST["password"])) {
            $userpassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
        }

        if (isset($_POST["email"])) {
            $useremail = $_POST["email"];
        }

        if (isset($_POST["firstname"])) {
            $userfirstname = $_POST["firstname"];
        }

        if (isset($_POST["lastname"])) {
            $userlastname = $_POST["lastname"];
        }

        if (isset($_POST["salutation"])) {
            $usersalutation = $_POST["salutation"];
        }

        if (isset($_POST["role"])) {
            $userrole = $_POST["role"];
        }

        if (isset($_POST["status"])) {
            $userstatus = $_POST["status"];
        }

        if (isset($_POST["sid"])) {
            $userid = $_POST["sid"];
        }

        

        $stmt->execute();
        $stmt->close();
        //$db->close();

        header("Refresh:0");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ("includes/adminhead.php") ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1">
    <title>User Editing</title>

    <style>
        .form-signin {
            max-width: 850px;
            padding: 15px;
            margin: auto;
        }
    </style>
    
</head>

<body>
    <?php include ("includes/navbaradmin.php") ?>

    <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <div class="container">
            <main class="form-signin">

                <h1 class="text-center">
                    Edit User
                </h1>
                <!-- ID to search User-->
                <form method="post">
                    <div style="text-align: center;">
                        <div style="display: inline-block; width: 20%;"> 
                            <div class="form-floating">
                                <input type="text" class="form-control" id="sid" name="sid" placeholder="ID"
                                    value="<?php if(isset($suserid)) {echo $suserid;} elseif(isset($_POST['edit_user_id'])) {echo $suserid=$_POST['edit_user_id'];} ?>">
                                <label for="sid">ID</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-signin">
                        <button class="w-100 btn btn-lg btn-primary" name="search" type="submit">Search by ID</button>
                    </div>
                    <!-- Users data is shown and can be changed -->
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" aria-label="Default select example" id ="salutation" name="salutation">
                                        <option value="male" <?php if (isset($susersalutation)){if ($susersalutation=='male' ) {
                                            echo 'selected' ; } else { echo "" ;}} elseif(isset($_POST['usersalutation']) && ($_POST['usersalutation']=='male')) {echo 'selected';} else{"";} ?>>Mr</option>
                                        <option value="female" <?php if(isset($susersalutation)){if ($susersalutation=='female' ) {
                                            echo 'selected' ; } else { echo "" ;}} elseif(isset($_POST['usersalutation']) && ($_POST['usersalutation']=='female')) {echo 'selected';} else{"";} ?>>Mrs</option>
                                        <option value="divers" <?php if(isset($susersalutation)){if ($susersalutation=='divers' )
                                            {echo 'selected' ; } else { echo "" ;}} elseif(isset($_POST['usersalutation']) && ($_POST['usersalutation']=='divers')) {echo 'selected';} else{"";} ?>>Divers</option>
                                    </select>
                                    <label for="salutation">Salutation</label>
                                </div>
                            </div>
                        
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="username" name="username" 
                                        value="<?php if(isset($susername)) {echo $susername;} elseif(isset($_POST['username'])) {echo $susername=$_POST['username'];}?>">
                                    <label for="username">Username</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        value="<?php if(isset($suserfirstname)) {echo $suserfirstname;} elseif(isset($_POST['userfirstname'])) {echo $userfirstname=$_POST['userfirstname'];}?>">
                                    <label for="firstname">Firstname</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        value="<?php if(isset($suserlastname)) {echo $suserlastname;} elseif(isset($_POST['userlastname'])) {echo $suserlastname=$_POST['userlastname'];}?>">
                                    <label for="lastname">Lastname</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" 
                                        value="<?php if(isset($suseremail)) {echo $suseremail;} elseif(isset($_POST['useremail'])) {echo $suseremail=$_POST['useremail'];}?>">
                                    <label for="email">E-Mail</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" name="password" value="">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" aria-label="Default
                                        select example" name="role">
                                        <option value="user" <?php if (isset($suserrole)){if ($suserrole=='user' ) {
                                            echo 'selected' ; } else { echo "" ;}} elseif(isset($_POST['userrole']) && ($_POST['userrole']=='user')) {echo 'selected';} else{"";}?>>User</option>
                                        <option value="admin" <?php if (isset($suserrole)){if ($suserrole=='admin' ) {
                                            echo 'selected' ; } else { echo "" ;}} elseif(isset($_POST['userrole']) && ($_POST['userrole']=='admin')) {echo 'selected';} else{"";}?>>Admin</option>
                                    </select>
                                    <label for="role">Role</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" aria-label="Default select example" name="status">
                                        <option value="active" <?php if (isset($suserstatus)){if ($suserstatus=='active' ) {
                                            echo 'selected' ; } else { echo "" ;}} elseif(isset($_POST['userstatus']) && ($_POST['userstatus']=='active')) {echo 'selected';} else{"";}?>>Active</option>
                                        <option value="inactive" <?php if (isset($suserstatus)){if ($suserstatus=='inactive' ) {
                                            echo 'selected' ; } else { echo "" ;}} elseif(isset($_POST['userstatus']) && ($_POST['userstatus']=='inactive')) {echo 'selected';} else{"";}?>>Inactive</option>
                                    </select>
                                    <label for="status">Status</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-signin">
                        <button class="w-100 btn btn-lg btn-primary" name="update" type="submit">Safe</button>
                    </div>
                    
                </form>
            </main>
        </div>
    </div>
</body>
<?php include("includes/scripts.php") ?>
</html>

<?php
    exit();
?>