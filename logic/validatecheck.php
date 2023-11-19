<?php
$genderErr = $fnameErr = $lnameErr = $unameErr = $mailErr = $pwErr = $re_pwErr = "";
$gender = $fname = $lname = $uname = $mail = $pw = $re_pw = "";

$registration_success = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // GENDER
  if ($_POST["gender"] == "Select") {
    $genderErr = "Gender is required";
    $registration_success = false;
  } else {
    $gender = test_input($_POST["gender"]);
  }

  // FNAME
  if (empty($_POST["fname"])) {
    $fnameErr = "First Name is required";
    $registration_success = false;
  } else {
    $fname = test_input($_POST["fname"]);
    if (!preg_match("/^[a-zA-Z-' ]{2,}$/", $fname)) {
      $fnameErr = "Only letters and spaces. Minimum length is 2 characters.";
      $registration_success = false;
    }
  }

  // LNAME
  if (empty($_POST["lname"])) {
    $lnameErr = "Last Name is required";
    $registration_success = false;
  } else {
    $lname = test_input($_POST["lname"]);
    if (!preg_match("/^[a-zA-Z-' ]{2,}$/", $lname)) {
      $lnameErr = "Only letters and spaces. Minimum length is 2 characters.";
      $registration_success = false;
    }
  }

  // USERNAME
  if (empty($_POST["uname"])) {
    $unameErr = "Username is required";
    $registration_success = false;
  } else {
    $uname = test_input($_POST["uname"]);
    if (!preg_match("/^[a-zA-Z-' ]{2,}$/", $uname)) {
      $unameErr = "Only letters and spaces. Minimum length is 2 characters.";
      $registration_success = false;
    }
  }

  // EMAIL
  if (empty($_POST["mail"])) {  // Changed from "email" to "mail"
    $mailErr = "Email is required";
    $registration_success = false;
  } else {
    $mail = test_input($_POST["mail"]);
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $mailErr = "Invalid email format";
      $registration_success = false;
    }
  }

  // PASSWORD
  if (empty($_POST["pw"])) {
    $pwErr = "Please enter a password";
    $registration_success = false;
  } else {
    $pw = test_input($_POST["pw"]);
    if (!check_passwort($pw)) {
      $pwErr = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
      $registration_success = false;
    }
  }

  // RE-PASSWORD
  $re_pw = test_input($_POST["re_pw"]);
  if ($re_pw !== $pw) {
    $re_pwErr = "Password has to be the same";
    $registration_success = false;
  }

  if($registration_success===true){
    header("Location: ../Login.php");
  } else {
  header("Location: ../Registration.php?gender=".$gender."&fname=".$fname."&lname=".$lname."&uname=".$uname."&mail=".$mail."&pw=".$pw."&re_pw=".$re_pw."&genderErr=".$genderErr."&fnameErr=".$fnameErr."&lnameErr=".$lnameErr."&unameErr=".$unameErr."&mailErr=".$mailErr."&pwErr=".$pwErr."&re_pwErr=".$re_pwErr);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function check_passwort($password) {
  $uppercase = preg_match('@[A-Z]@', $password);
  $lowercase = preg_match('@[a-z]@', $password);
  $number    = preg_match('@[0-9]@', $password);
  $specialChars = preg_match('@[^\w]@', $password);
  return ($uppercase && $lowercase && $number && $specialChars && strlen($password) >= 8);
}
?>

