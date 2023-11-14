<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registration Page</title>
    <?php include("includes/head.php")?>

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
                                        <img src="Images/Logo2.png" style="width: 100px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Registration</h4>
                                    </div>

                                    <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        // Include your database connection file here
                                        // Replace placeholders with actual database credentials
                                        $db_host = "localhost";
                                        $db_username = "daxact";
                                        $db_password = "Asdfg12345";
                                        $db_name = "register";

                                        // Establish a connection to the database
                                        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

                                        // Check the connection
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        // Validate form data
                                        $salutation = $_POST["salutation"];
                                        $firstName = $_POST["firstName"];
                                        $lastName = $_POST["lastName"];
                                        $email = $_POST["email"];
                                        $username = $_POST["username"];
                                        $password = $_POST["password"];
                                        $confirmPassword = $_POST["confirmPassword"];

                                        // Perform server-side validation
                                        // Add code to check uniqueness of username in the database
                                        $checkUsernameQuery = "SELECT * FROM users WHERE username = '$username'";
                                        $result = $conn->query($checkUsernameQuery);

                                        if ($result->num_rows > 0) {
                                            echo "<p style='color: red;'>Username is already taken. Please choose another one.</p>";
                                        } else {
                                            // Add code to compare passwords
                                            if ($password != $confirmPassword) {
                                                echo "<p style='color: red;'>Passwords do not match. Please try again.</p>";
                                            } else {
                                                // Hash the password for security
                                                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                                                // Insert data into the database
                                                $insertQuery = "INSERT INTO users (salutation, first_name, last_name, email, username, password) VALUES ('$salutation', '$firstName', '$lastName', '$email', '$username', '$hashedPassword')";

                                                if ($conn->query($insertQuery) === TRUE) {
                                                    echo "<p style='color: green;'>Registration successful!</p>";
                                                    // You can redirect the user to a success page if needed
                                                } else {
                                                    echo "<p style='color: red;'>Error: " . $insertQuery . "<br>" . $conn->error . "</p>";
                                                }
                                            }
                                        }

                                        // Close the database connection
                                        $conn->close();
                                    }
                                    ?>

                                    <form id="registrationForm" method="post">
                                        <p>Please fill in the registration details</p>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example11">Salutation</label>
                                            <select name="salutation" id="form2Example11" class="form-select" required>
                                                <option value="">Select</option>
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example22">First Name</label>
                                            <input type="text" name="firstName" id="form2Example22" class="form-control" placeholder="First Name" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example33">Last Name</label>
                                            <input type="text" name="lastName" id="form2Example33" class="form-control" placeholder="Last Name" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example44">E-Mail-Adress</label>
                                            <input type="email" name="email" id="form2Example44" class="form-control" placeholder="E-Mail-Adress" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example55">Username</label>
                                            <input type="text" name="username" id="form2Example55" class="form-control" placeholder="Username" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example66">Password</label>
                                            <input type="password" name="password" id="form2Example66" class="form-control" placeholder="Password" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example77">Confirm Password</label>
                                            <input type="password" name="confirmPassword" id="form2Example77" class="form-control" placeholder="Password" required />
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Register</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">We are more than just a company</h4>
                                    <p class="small mb-0">Sign up for our experience and make
                                        use of our booking service!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>