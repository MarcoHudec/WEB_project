<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registration Page</title>
    <?php include("includes/head.php")?>
    <link href="bootstrap.min.css" rel="stylesheet">

    <style>
        .gradient-custom-2 {
            background: #fccb90;
            background: -webkit-linear-gradient(to right, #007BFF, #6EC1E4, #20C997, #17C671);
            background: linear-gradient(to right, #007BFF, #6EC1E4, #20C997, #17C671);
        }
        
    </style>

</head>

<body>
    <?php include("includes/Navbar.php")?>

    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <img src="Images/Logo.png" style="width: 100px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Registration</h4>
                                    </div>

                                    <form action="logic/registervalidation.php" method="post">
                                    <p>Please fill in the registration details</p>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="salutation">Salutation</label>
                                        <select class="form-select <?php if (!empty($_GET["invalidSalutationMessage"])) {
                                            if (isset($_GET["salutation"])) {
                                                echo 'is-invalid';
                                            } else {
                                                echo "";
                                            }
                                        } else if (isset($_GET["salutation"])) {
                                            echo 'is-valid';
                                        } else {
                                            echo '';
                                        } ?>" aria-label="Default select example" name="salutation">
                                            <option value="" <?php if (!empty($_GET["salutation"])) { echo 'selected'; } else { echo "";} ?>>Select</option>
                                            <option value="male" <?php if (!empty($_GET["salutation"])) {
                                                if ($_GET["salutation"] =="male") { echo 'selected'; } else { echo "";}} ?>>Mr</option>
                                            <option value="female" <?php if (!empty($_GET["salutation"])) {
                                                if ($_GET["salutation"] =="female") { echo 'selected'; } else { echo "";}} ?>>Mrs</option>
                                            <option value="divers" <?php if (!empty($_GET["salutation"])) {
                                            if ($_GET["salutation"] =="divers") { echo 'selected'; } else { echo "";}} ?>>Divers</option>
                                        </select>
                                    </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="firstname">First Name</label>
                                            <input type="text" class="form-control <?php if (!empty($_GET["invalidFirstnameMessage"])) {
                                                if (isset($_GET["firstname"])) {
                                                    echo 'is-invalid';
                                                } else {
                                                    echo "";
                                                }
                                            } else if (isset($_GET["firstname"])) {
                                                echo 'is-valid';
                                            } else {
                                                echo '';
                                            } ?>" id="firstname" name="firstname" placeholder="First Name"
                                                value="<?= !empty($_GET["firstname"]) ? ($_GET["firstname"]) : '' ?>">
                                            <?= !empty($_GET["invalidFirstnameMessage"]) ? '<div class="invalid-feedback is-invalid">' . $_GET["invalidFirstnameMessage"] . '</div>' : '' ?>
                                        </div>
                                        
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="lastname">Last Name</label>
                                            <input type="text" class="form-control <?php if (!empty($_GET["invalidLastnameMessage"])) {
                                                if (isset($_GET["lastname"])) {
                                                    echo 'is-invalid';
                                                } else {
                                                    echo "";
                                                }
                                            } else if (isset($_GET["lastname"])) {
                                                echo 'is-valid';
                                            } else {
                                                echo '';
                                            } ?>" id="lastname" name="lastname" placeholder="Last Name"
                                                value="<?= !empty($_GET["lastname"]) ? ($_GET["lastname"]) : '' ?>">
                                            <?= !empty($_GET["invalidLastnameMessage"]) ? '<div class="invalid-feedback is-invalid">' . $_GET["invalidLastnameMessage"] . '</div>' : '' ?>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" class="form-control <?php if (!empty($_GET["invalidUsernameMessage"])) {
                                                if (isset($_GET["username"])) {
                                                    echo 'is-invalid';
                                                } else {
                                                    echo "";
                                                }
                                            } else if (isset($_GET["username"])) {
                                                echo 'is-valid';
                                            } else {
                                                echo '';
                                            } ?>" id="username" name="username" placeholder="Username"
                                                value="<?= !empty($_GET["username"]) ? ($_GET["username"]) : '' ?>">
                                            <?= !empty($_GET["invalidUsernameMessage"]) ? '<div class="invalid-feedback is-invalid">' . $_GET["invalidUsernameMessage"] . '</div>' : '' ?>
                                        </div>
                                        
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="email">E-Mail-Adress</label>
                                            <input type="text" class="form-control <?php if (!empty($_GET["invalidEmailMessage"])) {
                                                if (isset($_GET["email"])) {
                                                    echo 'is-invalid';
                                                } else {
                                                    echo "";
                                                }
                                            } else if (isset($_GET["email"])) {
                                                echo 'is-valid';
                                            } else {
                                                echo '';
                                            } ?>" id="email" name="email" placeholder="E-Mail-Adress"
                                                value="<?= !empty($_GET["email"]) ? ($_GET["email"]) : '' ?>">
                                            <?= !empty($_GET["invalidEmailMessage"]) ? '<div class="invalid-feedback is-invalid">' . $_GET["invalidEmailMessage"] . '</div>' : '' ?>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" class="form-control <?php if (!empty($_GET["invalidPasswordMessage"])) {
                                                if (isset($_GET["password"])) {
                                                    echo 'is-invalid';
                                                } else {
                                                    echo "";
                                                }
                                            } else if (isset($_GET["password"])) {
                                                echo 'is-valid';
                                            } else {
                                                echo '';
                                            } ?>" id="password" name="password"
                                                placeholder="Passwort"
                                                value="<?= !empty($_GET["password"]) ? ($_GET["password"]) : '' ?>">
                                            <?= !empty($_GET["invalidPasswordMessage"]) ? '<div class="invalid-feedback is-invalid">' . $_GET["invalidPasswordMessage"] . '</div>' : '' ?>
                                        </div>

                                        <div class="form-outline mb-4">
                                        <label class="form-label" for="passwordcheck">Confirm Password</label>
                                            <input type="password" class="form-control <?php if (!empty($_GET["invalidPasswordcheckMessage"])) {
                                                if (isset($_GET["passwordcheck"])) {
                                                    echo 'is-invalid';
                                                } else {
                                                    echo "";
                                                }
                                            } else if (isset($_GET["passwordcheck"])) {
                                                echo 'is-valid';
                                            } else {
                                                echo '';
                                            } ?>" id="passwordcheck" name="passwordcheck"
                                                placeholder="Passwort wiederholen"
                                                value="<?= !empty($_GET["passwordcheck"]) ? ($_GET["passwordcheck"]) : '' ?>">
                                            <?= !empty($_GET["invalidPasswordcheckMessage"]) ? '<div class="invalid-feedback is-invalid">' . $_GET["invalidPasswordcheckMessage"] . '</div>' : '' ?>
                                        </div>
                                        
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" name="register" type="submit" style="width: 100%;">Register</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4 text-center">Hotel Zadar</h4>
                                    <p class="small mb-0">Register for our experience and make use of our booking service!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("includes/Footer.php")?>

    <?php include("includes/scripts.php")?>
    <script src="bootstrap.bundle.min.js"></script>
</body>

</html>