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

                                    <?php
                                    // Include your database connection file here
                                    // Replace placeholders with actual database credentials
                                    $db_host = "localhost"; // Change this if your MySQL server is on a different host
                                    $db_username = "admin"; // Replace with the username you created
                                    $db_password = "Asdfg12345"; // Replace with the password you set
                                    $db_name = "hotellogin"; // Replace with the name of the database you created

                                    // Establish a connection to the database
                                    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

                                    // Check the connection
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    // Check if the form is submitted
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        $username = $_POST["username"];
                                        $password = $_POST["password"];

                                        // Perform server-side validation
                                        // Add code to check the user's credentials in the database
                                        $checkUserQuery = "SELECT * FROM users WHERE username = '$username'";
                                        $result = $conn->query($checkUserQuery);

                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $hashedPassword = $row["password"];

                                            // Verify the password
                                            if (password_verify($password, $hashedPassword)) {
                                                // Password is correct, redirect to a success page
                                                header("Location: success.php");
                                                exit();
                                            } else {
                                                echo "<p style='color: red;'>Incorrect password. Please try again.</p>";
                                            }
                                        } else {
                                            echo "<p style='color: red;'>Username not found. Please check your username.</p>";
                                        }
                                    }
                                    ?>

                                    <form method="post">
                                        <p>Please login to your account</p>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control"
                                                placeholder="Enter your Username" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Enter your password" required />
                                        </div>

                                        <div class="text-center pt-1 mb-3 pb-1">
                                            <button class="btn btn-primary fa-lg gradient-custom-2"
                                                type="submit" style="width: 100%;">Log in</button>
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

    <?php include("includes/Footer.php")?>

    <?php include("includes/scripts.php")?>
</body>

</html>