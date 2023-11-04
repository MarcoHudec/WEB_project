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
                                        <img src="Images/Logo2.png"
                                            style="width: 100px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Registration</h4>
                                    </div>

                                    <form id="registrationForm">
                                        <p>Please fill in the registration details</p>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example11">Salutation</label>
                                            <select id="form2Example11" class="form-select" required>
                                                <option value="">Select</option>
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example22">First Name</label>
                                            <input type="text" id="form2Example22" class="form-control" placeholder="First Name" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example33">Last Name</label>
                                            <input type="text" id="form2Example33" class="form-control" placeholder="Last Name" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example44">E-Mail-Adress</label>
                                            <input type="email" id="form2Example44" class="form-control" placeholder="E-Mail-Adress" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example55">Username</label>
                                            <input type="text" id="form2Example55" class="form-control" placeholder="Username" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example66">Password</label>
                                            <input type="password" id="form2Example66" class="form-control" placeholder="Password" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example77">Confirm Password</label>
                                            <input type="password" id="form2Example77" class="form-control" placeholder="Password" required />
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
                                    <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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