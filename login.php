<!DOCTYPE html>
<html lang="en">


<head>
    <title>Login Page</title>
    <?php include("includes/head.php")?>
    <style>
        .gradient-custom-2 {
            background: #fccb90;
            background: -webkit-linear-gradient(to right, #007BFF, #6EC1E4, #20C997, #17C671);
            background: linear-gradient(to right, #007BFF, #6EC1E4, #20C997, #17C671);
        }
        
        /* Additional CSS for the Navbar */
        .navbar.bg-scroll {
            transition: background 0.5s;
        }
    </style>

</head>

<body>

    <?php include("includes/navbar.php")?>


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
                                        <h4 class="mt-1 mb-5 pb-1">Login</h4>
                                    </div>

                                    <form method="post" action="logic/loginvalidationnew.php">
                                        <p>Please login to your account</p>

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
                                            } ?>" id="username" name="username" placeholder="Enter your Username" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } else if (!empty($_GET["username"])) { echo $_GET["username"]; } ?>">
                                            <?= !empty($_GET["invalidUsernameMessage"]) ? '<div class="invalid-feedback is-invalid">' . $_GET["invalidUsernameMessage"] . '</div>' : '' ?>
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
                                            } ?>" id="Password" name="password" placeholder="Enter your Password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } else if (!empty($_GET["password"])) { echo ($_GET["password"]); } ?>">
                                            <?= !empty($_GET["invalidPasswordMessage"]) ? '<div class="invalid-feedback is-invalid">' . $_GET["invalidPasswordMessage"] . '</div>' : '' ?>
                                        </div>

                                        <div class="checkbox mb-3">
                                            <label>
                                                <input type="checkbox" value="remember-me" name="remember" <?php if(isset($_COOKIE["password"])) { echo "checked";} ?>> Stay logged in
                                            </label>
                                        </div>

                                        <div class="text-center pt-1 mb-3 pb-1">
                                            <button class="btn btn-primary fa-lg gradient-custom-2" type="submit" style="width: 100%;">Log in</button>
                                        </div>
                                        
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <a class="text-muted" href="#!">Forgot password?</a>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Don't have an account?</p>
                                            <a href="Registration.php" class="btn btn-outline-danger">Create new</a>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4 text-center">Hotel Zadar</h4>
                                    <p class="small mb-0">Sign up for our experience and make use of our booking service!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("includes/footer.php")?>

    <?php include("includes/scripts.php")?>
</body>

</html>