<?php

require_once("dbaccess.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["search"]) && (isset($_POST["sid"]))) {

        if (($_POST["sid"]) != null) {
            $query = "SELECT * FROM users WHERE id = ?";
            $stmt = $db->prepare($query);
            $suserid = $_POST["sid"];
            $stmt->bind_param("i", $suserid);
            $stmt->execute(); //datenbank anfrage: liefert nur text!
            $stmt->bind_result($suserid, $susername, $suserpassword, $suseremail, $suserfirstname, $suserlastname, $susersalutation, $suserrole, $suserstatus);
            $stmt->fetch();


            $stmt->close();
            //$db->close();
        } 

    }

    if (isset($_POST["update"]) && isset($_POST["sid"])) {
        // TODO

        if (isset($_POST["password"])) {

            $query = "UPDATE users SET username=?, password=?, email=?, firstname=?, lastname=?, salutation=?, role=?, status=? WHERE id=?";
            $stmt = $db->prepare($query);

            $stmt->bind_param("ssssssssi", $username, $userpassword, $useremail, $userfirstname, $userlastname, $usersalutation, $userrole, $userstatus, $userid);

        } else {
            $query = "UPDATE users SET username=?, email=?, firstname=?, lastname=?, salutation=?, role=?, status=? WHERE id=?";
            $stmt = $db->prepare($query);

            $stmt->bind_param("sssssssi", $username, $useremail, $userfirstname, $userlastname, $usersalutation, $userrole, $userstatus, $userid);

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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/stylee.css">
    <title>Benutzer-Bearbeitung</title>

    <style>
        .form-floating,
        .form-select {
            margin: 10px;
        }


        .form-select {
            width: 96% !important;
            height: 74%;
        }




        .form-signin {
            width: 100%;
            max-width: 850px;
            padding: 15px;
            margin: auto;
        }


        .col-md-4 {
            padding-bottom: 10px;
        }
    </style>
    <?php include ("includes/adminhead.php") ?>
</head>

<body>



    <?php include ("includes/navbaradmin.php") ?>


    <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <div class="container">
            <main class="form-signin">


                <h1 class="custom-heading text-center">

                    Edit User

                </h1>




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
                        <button class="w-100 btn btn-lg btn-primary" name="search" type="submit">Suchen</button>
                    </div>



                    <div class="row">
                        <div class="col-md-6">


                            <div class="form-floating">
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Username"
                                    value="<?php if(isset($susername)) {echo $susername;} elseif(isset($_POST['username'])) {echo $susername=$_POST['username'];}?>">
                                <label for="username">Username</label>
                            </div>
                        </div>
                        <div class="col-md-6">


                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" value="">
                                <label for="password">Password</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail"
                                    value="<?php if(isset($suseremail)) {echo $suseremail;} elseif(isset($_POST['useremail'])) {echo $suseremail=$_POST['useremail'];}?>">
                                <label for="email">E-Mail</label>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-floating">
                                <input type="text" class="form-control" id="firstname" name="firstname"
                                    placeholder="Firstname"
                                    value="<?php if(isset($suserfirstname)) {echo $suserfirstname;} elseif(isset($_POST['userfirstname'])) {echo $userfirstname=$_POST['userfirstname'];}?>">
                                <label for="firstname">Firstname</label>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-floating">
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                    placeholder="Lastname"
                                    value="<?php if(isset($suserlastname)) {echo $suserlastname;} elseif(isset($_POST['userlastname'])) {echo $suserlastname=$_POST['userlastname'];}?>">
                                <label for="lastname">Lastname</label>
                            </div>
                        </div>
                        <div class="col-md-6">



                            <select class="form-select <?php if (!empty($_GET["invalidsalutationMessage"])) { if
                                (isset($_GET["salutation"])) { echo 'is-invalid' ; } else { echo "" ; } } else if
                                (isset($_GET["salutation"])) { echo 'is-valid' ; } else { echo '' ; } ?>"
                                aria-label="Default select example" name="salutation">
                                <option value="" <?php if (!isset($susersalutation)) { echo 'selected' ; } else { echo "" ;}
                                    ?>>Select</option>
                                <option value="male" <?php if (isset($susersalutation)){if ($susersalutation=='male' ) {
                                    echo 'selected' ; } else { echo "" ;}} ?>>Mr</option>
                                <option value="female" <?php if(isset($susersalutation)){if ($susersalutation=='female' ) {
                                    echo 'selected' ; } else { echo "" ;}} ?>>Mrs</option>
                                <option value="divers" <?php if(isset($susersalutation)){if ($susersalutation=='divers' )
                                    {echo 'selected' ; } else { echo "" ;}} ?>>Divers</option>

                            </select>
                        </div>


                        <div class="col-md-6">

                            <select class="form-select <?php if (!empty($_GET[" invalidRoleMessage"])) { if
                                (isset($_GET["role"])) { echo 'is-invalid' ; } else { echo "" ; } } else if
                                (isset($_GET["role"])) { echo 'is-valid' ; } else { echo '' ; } ?>" aria-label="Default
                                select example" name="role">
                                <option value="" <?php if (!isset($suserrole)) {echo 'selected' ; } else { echo "" ;} ?>
                                    >Rolle wählen:</option>
                                <option value="user" <?php if (isset($suserrole)){if ($suserrole=='user' ) {
                                    echo 'selected' ; } else { echo "" ;}} ?>>User</option>
                                <option value="admin" <?php if (isset($suserrole)){if ($suserrole=='admin' ) {
                                    echo 'selected' ; } else { echo "" ;}} ?>>Admin</option>
                            </select>
                        </div>
                        <div class="col-md-6">



                            <select class="form-select" aria-label="Default select example" name="status">
                                <option value="" <?php if (!isset($suserstatus)) {echo 'selected' ; } else { echo "" ;}
                                    ?>>Status wählen:</option>
                                <option value="active" <?php if (isset($suserstatus)){if ($suserstatus=='active' ) {
                                    echo 'selected' ; } else { echo "" ;}} ?>>Aktiv</option>
                                <option value="inactive" <?php if (isset($suserstatus)){if ($suserstatus=='inactive' ) {
                                    echo 'selected' ; } else { echo "" ;}} ?>>Inaktiv</option>
                            </select>
                        </div>

                        <div class="form-signin">
                            <button class="w-100 btn btn-lg btn-primary" name="update" type="submit">Speichern</button>
                        </div>

                </form>




            </main>
        </div>
    </div>

    <footer>

        <?php include("includes/scripts.php") ?>

    </footer>


</body>

</html>



<?php

    exit();

    ?>