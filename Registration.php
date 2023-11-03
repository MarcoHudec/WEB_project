<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registration Page</title>
    <?php include("includes/head.php")?>

    <style>
       
        
        
    </style>
</head>

<body background="Images/Hotel1.jpg">
    <?php include("includes/Navbar.php")?>
    
    
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6 registration-box">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Registration</h2>
                        <form id="registrationForm">
                            <div class="mb-3">
                                <label for="salutation" class="form-label">Salutation</label>
                                <select class="form-select" id="salutation" required>
                                    <option value="">Select</option>
                                    <option value="Mr.">Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>











    <?php include("includes/Footer.php")?>

    <?php include("includes/scripts.php")?>
</body>

</html>