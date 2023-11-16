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
session_start();
$_SESSION["role"]="";
$validity=TRUE;
$firstname=$lastname=$email=$username=$password=$repassword="";
$fnameErr= $lnameErr= $emailErr= $useErr= $passErr= $repassErr="";
$fname_val= $lnameval= $emailval= $useval= $passval= $repassval="valid";

$firstname=$_POST["fname"];
//if($_SERVER["REQUEST_METHOD"]=="POST"){
  if (empty($_POST["fname"])) {
      $fnameErr = "First name is required";
      $fname_val="invalid";
    } else {
      $firstname = test_input($_POST["fname"]);
      if(!preg_match("/^[a-zA-Z-']*$/",$firstname)){
        $fnameErr="Only letters and white spaces allowed";
        $fname_val="invalid";
        $validity=FALSE;
      }
    }

  $lastname=$_POST["lname"];
  if (empty($_POST["fname"])) {
    $lastnameErr = "First name is required";
    $validity=FALSE;
    $lnameval="invalid";
  } else {
    $lastname = test_input($_POST["lname"]);
    if(!preg_match("/^[a-zA-Z-']*$/",$lastname)){
      $fnameErr="Only letters and white spaces allowed";
      $lnameval="invalid";
    }
  }

  $email=$_POST["email"];
  if (empty($_POST["email"])) {
      $emailErr = "Email is required";
      $emailval="invalid";
    } else {
      $email = test_input($_POST["email"]);
      }
    
  $username=$_POST["username"];
  if (empty($_POST["username"])) {
     $useErr = "Username is required";
     $useval="invalid";
   } else {
      $username = test_input($_POST["username"]);
      if(test_length($username)===FALSE){
        $useval="invalid";
        $useErr="Username Has to be at least 6 long";
      }
    }

  $password =$_POST["password"];
  if (empty($_POST["password"])) {
      $nameErr = "Password is required";
      $passval="invalid";
    } else {
      $password = test_input($_POST["password"],);
      if(test_length($password)===FALSE){
        $passval="invalid";
        $passErr="password Has to be at least 6 long";
      }
      if(!preg_match('/[0-9]/',$password)){
        $passErr="Enter at least one number in your password";
        $passval="invalid";
      }
   }

  $repassword=$_POST["reenteredpassword"];
  if (empty($_POST["reenteredpassword"])) {
      $repassErr = "Password is required";
      $repassval="invalid";
    } else {
      $repassword = test_input($_POST["reenteredpassword"]);
      if(test_length($repassword)===FALSE){
        $repassval="invalid";
        $repassErr="reenteredpassword Has to be at least 6 long";
      }
      if($repassword===$password){

      }else{
          $repassval="invalid";
          $repassErr="passwords have to match";
      }
  }
  if($fnameval=="invalid"|| $lnameval=="invalid"|| $emailval=="invalid"|| $useval=="invalid"|| $passval=="invalid"|| $repassval =="invalid"){
    header("Location: ../loginform.php?&fnamevalid=".$fname_val."&firstname=".$firstname."&firstnameErr=".$fnameErr.
    "&lnamevalid=".$lnameval."&lastname=".$lastname."&lastnameErr=".$lnameErr.
    "&emailval=".$emailval."&email=".$email."&emailErr=".$emailErr.
    "&usernameval=".$useval."&username=".$username."&usernameErr=".$useErr.
    "&passwordval=".$passval."&password=".$password."&passwordErr=".$passErr.
    "&repasswordval=".$repassval."&repassword=".$repassword."&repasswordErr=".$repassErr);
  }else{
    header("Location: ../home.php");
    //$_SESSION["role"]=;
  }


function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function test_length($data){
  if(strlen($data)<6){
    $validity=false;
  }
  return $validity;
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
                                            <label class="form-label" for="firstname">First Name</label>
                                            <input type="text" name="firstName" id="firstname" class="form-control" placeholder="First Name" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="lastname">Last Name</label>
                                            <input type="text" name="lastName" id="lastname" class="form-control" placeholder="Last Name" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="email">E-Mail-Adress</label>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="E-Mail-Adress" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="conpassword">Confirm Password</label>
                                            <input type="password" name="confirmPassword" id="conpassword" class="form-control" placeholder="Password" required />
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

    <?php include("includes/Footer.php")?>

    <?php include("includes/scripts.php")?>
</body>

</html>