<?php 
session_start();
?>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark transparent-navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="Images/Logo.png" height="30" class="d-inline-block align-text-top">
      Hotel Zadar
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item mx-3">
          <a class="text-white nav-link" href="Help.php">About Us</a>
        </li>
        <?php if(!isset($_SESSION["username"])): ?>
        <li class="nav-item mx-3">
          <a class="text-white nav-link" href="Login.php">Sign in</a>
        </li>
        <li class="nav-item mx-3">
          <a class="text-white nav-link" href="Registration.php">Register</a>
        </li>
        <?php endif; ?>
        <?php if(isset($_SESSION["username"])): ?>
          <li class="nav-item">
            <a class="nav-link text-white" href="Profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="logic/logout.php">Logout</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>