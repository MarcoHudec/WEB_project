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
                                        <img src="Images/Logo.png" style="width: 100px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Registration</h4>
                                    </div>

                                    <form id="registrationForm" action="logic/validatecheck.php" method="post">

                                    <?php require("logic/validate.php")?>
                                        <p>Please fill in the registration details</p>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="gender">Salutation</label>
                                            <select name="gender" id="gender" class="form-select <?php echo $gender_valid?> <?php echo 'value='.$gender?>" >
                                                <option selected>Select</option>
                                                <option <?php if($gender === "1") echo 'selected' ?> value="1"> Mr</option>
                                                <option <?php if($gender === "2") echo 'selected' ?> value="2">Mrs</option>
                                                <option <?php if($gender === "3") echo 'selected' ?> value="3">Other</option>
                                            </select>
                                            <div class="invalid-feedback"><?php echo $gender_error; ?></div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="fname">First Name</label>
                                            <input type="text" name="fname" id="fname" class="form-control <?php echo $fname_valid?>" <?php echo 'value="'.$fname.'"' ?> placeholder="First Name"  />
                                            <div class="invalid-feedback" ><?php echo $fname_error ?></div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="lname">Last Name</label>
                                            <input type="text" name="lname" id="lname" class="form-control <?php echo $lname_valid?>" <?php echo 'value="'.$lname.'"' ?> placeholder="Last Name"  />
                                            <div class="invalid-feedback" ><?php echo $lname_error ?></div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="mail">E-Mail-Adress</label>
                                            <input type="email" name="mail" id="mail" class="form-control <?php echo $mail_valid?>" <?php echo 'value="'.$mail.'"' ?> placeholder="E-Mail-Adress"  />
                                            <div class="invalid-feedback" ><?php echo $mail_error ?></div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="uname">Username</label>
                                            
                                            <input type="text" name="uname" id="uname" class="form-control <?php echo $uname_valid?>" <?php echo 'value="'.$uname.'"' ?> placeholder="Username"  />
                                            <div class="valid-feedback" >Looks good!</div>
                                            <div class="invalid-feedback" ><?php echo $uname_error ?></div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="pw">Password</label>
                                            <input type="password" name="pw" id="pw" class="form-control <?php echo $pw_valid?>" <?php echo 'value="'.$pw.'"' ?> placeholder="Password"  />
                                            <div class="invalid-feedback" ><?php echo $pw_error ?></div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="re_pw">Confirm Password</label>
                                            <input type="password" name="re_pw" id="re_pw" class="form-control <?php echo $re_pw_valid?>" <?php echo 'value="'.$fname.'"' ?> placeholder="Password"  />
                                            <div class="invalid-feedback" ><?php echo $re_pw_error ?></div>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" style="width: 100%;">Register</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4 text-center">Hotel Zadar</h4>
                                    <p class="small mb-0">Sign up for our experience and make use of our booking service!
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
</body>

</html>