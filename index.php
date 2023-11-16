<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/head.php")?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Full Width Pics - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <?php
    // Include the navbar from Navbar.php
    include('includes/Navbar.php');
    ?>

    <header class="py-5">
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExample" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExample" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Images/Hotel1.jpg" class="d-block w-50 mx-auto" alt="Hotel1">
            </div>
            <div class="carousel-item">
                <img src="Images/Hotel2.jpg" class="d-block w-50 mx-auto" alt="Hotel2">
            </div>
            <div class="carousel-item">
                <img src="Images/Hotel3.jpg" class="d-block w-50 mx-auto" alt="Hotel3">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
</header>


    <section class="py-5">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                <h2>Hotel Zadar</h2>
                    <br></br>
                    <p class="lead">Treat yourself with an experience</p>
                    <p class="lead">Discover Mexico's warmest hospitality at our hotel. Immerse yourself in local culture and relax in our elegant facilities. Welcome to an unforgettable experience in the heart of Mexico</p>
                        

                </div>
            </div>
        </div>
    </section>


    <section class="py-5">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2>Our Rooms</h2>
                <p class="lead">We make sure you feel relaxed and have a pleasant stay</p>
                <p class="lead">Experience luxurious comfort in our hotel rooms. Enjoy an array of fun activities, from exploring local markets to relaxing by the pool and savoring Mexican cuisine. Your stay with us promises both relaxation and adventure</p>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-4">
                <img src="Images/HotelRoom1.jpeg" class="img-fluid rounded img-hover" alt="Image 1">
                <p>Single Deluxe Room with sea view</p>
                <a href="#" class="btn btn-primary">Book Now</a>
            </div>
            <div class="col-md-4">
                <img src="Images/HotelRoom2.jpeg" class="img-fluid rounded img-hover" alt="Image 2">
                <p>Family Deluxe Room with sea view</p>
                <a href="#" class="btn btn-primary">Book Now</a>
            </div>
            <div class="col-md-4">
                <img src="Images/HotelRoom3.jpeg" class="img-fluid rounded img-hover" alt="Image 3">
                <p>Pesidential sweet with sea view and complementary butler</p>
                <a href="" class="btn btn-primary">Book Now</a>
            </div>
        </div>
    </div>
</section>


    

    <section class="py-5">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h2>Our facilities</h2>
                    <br></br>
                    <p class="lead">We make sure you feel relaxed and have a pleasant stay</p>
                    <p class="lead">Experience luxurious comfort in our hotel rooms. Enjoy an array of fun activities, from exploring local markets to relaxing by the pool and savoring Mexican cuisine. Your stay with us promises both relaxation and adventure</p>
                </div>
            </div>
        </div>
    

    <div class="container py-5">
    <div class="row">
        <div class="col-md-4">
            <img src="Images/Hotel1.jpg" class="img-fluid rounded img-hover" alt="Image 1">
        </div>
        <div class="col-md-4">
            <img src="Images/Hotel2.jpg" class="img-fluid rounded img-hover" alt="Image 2">
        </div>
        <div class="col-md-4">
            <img src="Images/Hotel3.jpg" class="img-fluid rounded img-hover" alt="Image 3">
        </div>
    </div>
</div>
</section>



    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> 

    <script src="js/scripts.js"></script>

    <?php include("includes/Footer.php")?>

    <?php include("includes/scripts.php")?>
</body>

</html>
