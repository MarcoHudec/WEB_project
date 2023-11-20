<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/head.php")?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Reservation - Hotel Zadar</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #ff5733;
        }
        .capacity {
            font-size: 0.9rem;
            color: #777;
        }
        .description {
            font-size: 0.95rem;
        }
    </style>
</head>

<body>
    <?php
    // Include the navbar from Navbar.php
    include('includes/Navbar.php');
    ?>

    <section class="container my-5">
        <h2 class="mb-4">Available Rooms for Booking</h2>

        <ul class="list-group">
            <li class="list-group-item">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <img src="Images/HotelRoom1.jpeg" class="img-fluid" alt="Room 1">
                    </div>
                    <div class="col-md-9">
                        
                        <h5>Single Deluxe Room with sea view</h5>
                        <p class="capacity">Capacity: 2 adults + 1 child</p>
                        <p class="price">120€ per night</p>
                        
                        <p class="description">Enjoy breathtaking views from this single deluxe room overlooking the sea.</p>
                        <a href="#" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <img src="Images/HotelRoom2.jpeg" class="img-fluid" alt="Room 2">
                    </div>
                    <div class="col-md-9">
                        
                        <h5>Family Deluxe Room with sea view</h5>
                        <p class="capacity">Capacity: 2 adults</p>
                        <p class="price">160€ per night</p>
                        
                        <p class="description">Spacious family deluxe room with a stunning view of the sea.</p>
                        <a href="#" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <img src="Images/HotelRoom3.jpeg" class="img-fluid" alt="Room 3">
                    </div>
                    <div class="col-md-9">
                        
                        <h5>Presidential suite with sea view and complementary butler</h5>
                        <p class="capacity">Capacity: 4 adults + 2 children</p>
                        <p class="price">699€ per night</p>
                        
                        <p class="description">Luxurious presidential suite offering stunning sea views and personalized butler service.</p>
                        <a href="#" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </li>
            <!-- Repeat the structure for other rooms -->
        </ul>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>

    <?php include("includes/Footer.php")?>
    <?php include("includes/scripts.php")?>
</body>

</html>
