<?php
//GENDER
/*
$gender_valid = $gender_error = $gender = "";

if (isset($_GET['genderErr']) && !empty($_GET['genderErr'])) {
  $gender_valid = "is-invalid";
  $gender_error = $_GET['genderErr'];
} elseif (isset($_GET['genderErr'])) {
  $gender_valid = "is-valid";
}

if (isset($_GET["gender"])) {
  $gender = $_GET["gender"];
}
*/
//FNAME
$fname_valid = $fname_error = $fname = "";
if (isset($_GET['fnameErr']) && !empty($_GET['fnameErr'])) {
  $fname_valid = "is-invalid";
  $fname_error = $_GET['fnameErr'];
} elseif (isset($_GET['fnameErr'])) {
  $fname_valid = "is-valid";
}

if (isset($_GET["fname"])) {
  $fname = $_GET["fname"];
}

//LNAME
$lname_valid = $lname_error = $lname = "";

if (isset($_GET['lnameErr']) && !empty($_GET['lnameErr'])) {
  $lname_valid = "is-invalid";
  $lname_error = $_GET['lnameErr'];
} elseif (isset($_GET['lnameErr'])) {
  $lname_valid = "is-valid";
}

if (isset($_GET["lname"])) {
  $lname = $_GET["lname"];
}

//UNAME
$uname_valid = $uname_error = $uname = "";

if (isset($_GET['unameErr']) && !empty($_GET['unameErr'])) {
  $uname_valid = "is-invalid";
  $uname_error = $_GET['unameErr'];
} elseif (isset($_GET['unameErr'])) {
  $uname_valid = "is-valid";
}

if (isset($_GET["uname"])) {
  $uname = $_GET["uname"];
}

//MAIL
$mail_valid = $mail_error = $mail = "";

if (isset($_GET['mailErr'])) {
    if (!empty($_GET['mailErr'])) {
        $mail_valid = "is-invalid";
        $mail_error = $_GET['mailErr'];
    } elseif (isset($_GET['mailErr'])) {
        $mail_valid = "is-valid";
    }
}

if (isset($_GET["mail"])) {
    $mail = $_GET["mail"];
}

// PASSWORD
$pw_valid = $pw_error = $pw = "";

if (isset($_GET['pwErr'])) {
    if (!empty($_GET['pwErr'])) {
        $pw_valid = "is-invalid";
        $pw_error = $_GET['pwErr'];
    } elseif (isset($_GET['pwErr'])) {
        $pw_valid = "is-valid";
    }

}

if (isset($_GET["pw"])) {
  $pw = $_GET["pw"];
}

// REPEAT PASSWORD
$re_pw_valid = $re_pw_error = $re_pw = "";

if (isset($_GET['re_pwErr'])) {
    if (!empty($_GET['re_pwErr'])) {
        $re_pw_valid = "is-invalid";
        $re_pw_error = $_GET['re_pwErr'];
    } elseif (empty($_GET['re_pwErr'])){
      $re_pw_valid = "";
    }else {
      $re_pw_valid = "is-valid";
    }
}

if (isset($_GET["re_pw"])) {
  $re_pw = $_GET["re_pw"];
}
?>