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
        <li class="nav-item mx-2">
          <a class="text-white nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item mx-2">
          <a class="text-white nav-link" href="reservation.php">Reservation</a>
        </li>
        <li class="nav-item mx-2">
          <a class="text-white nav-link" href="blog.php">Blog</a>
        </li>
        <?php if(!isset($_SESSION["active"])): ?>
        <li class="nav-item mx-2">
          <a class="text-white nav-link" href="login.php">Sign in</a>
        </li>
        <li class="nav-item mx-2">
          <a class="text-white nav-link" href="register.php">Register</a>
        </li>
        <?php endif; ?>
        <?php if(isset($_SESSION["active"])): ?>
          <?php if(isset($_SESSION["admin"])): ?>
            <li class="nav-item mx-2">
            <a class="nav-link text-white" href="allBookings.php">Administration</a>
          </li>
          <?php endif; ?>
          <li class="nav-item dropdown mx-2">
              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown2" role="button"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  Profile
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                  <li><a class="dropdown-item" href="mybookings.php">My Bookings</a></li>
              </ul>
          </li>
          <li class="nav-item mx-2">
            <a class="nav-link text-white" href="logic/logout.php">Logout</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>