
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
    </style>

    <style>
        /* Additional CSS for the Navbar */
        .navbar.bg-scroll {
            transition: background 0.5s;
        }
    </style>

</head>
 
<body>

    <?php include("includes/Navbar.php")?>
    <?php
        $error = "";
        $_username = "";

        if (isset($_SESSION["error"])) {
         $error = $_SESSION["error"];
        unset($_SESSION["error"]); // Fehlermeldung aus der Session entfernen
        }

        if (isset($_SESSION["username"])) {
            $_username = $_SESSION["username"];
        unset($_SESSION["username"]);
        }
    ?>   
    
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

                                    <form method="post" action="logic/loginvalidation.php">
                                        <p>Please login to your account</p>

                                        <div class="form-outline mb-4" >
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter your Username" />
                                            
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password"  />
                                        </div>

                                        <div class="text-center pt-1 mb-3 pb-1">
                                            <button class="btn btn-primary fa-lg gradient-custom-2" type="submit" style="width: 100%;">Log in</button>
                                        </div>
                                        <?php if ($error): ?>
                                            <p class="text-center" style="color: red;"><?php echo $error; ?></p>
                                        <?php endif; ?>                            
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

    <?php include("includes/Footer.php")?>

    <?php include("includes/scripts.php")?>
</body>

</html>