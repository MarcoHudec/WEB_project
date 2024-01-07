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
    <?php include('includes/Navbar.php'); ?>

    <section class="container my-5">
        <h2 class="mb-4">Available Rooms for Booking</h2>

        <ul class="list-group">
            <?php foreach ($rooms as $room): ?>
                <li class="list-group-item">
                    <div class="row align-items-center">
                        <!-- Zimmerbilder und Beschreibung aus den Room-Objekten hinzufügen -->
                        <div class="col-md-3">
                            <img src="Images/HotelRoom<?php echo $room->roomID; ?>.jpeg" class="img-fluid" alt="Room <?php echo $room->roomID; ?>">
                        </div>
                        <div class="col-md-9">
                            <h5><?php echo htmlspecialchars($room->description); ?></h5>
                            <p class="capacity">Capacity: <?php echo htmlspecialchars($room->capacity); ?></p>
                            <p class="price"><?php echo htmlspecialchars($room->pricePerNight); ?>€ per night</p>
                            <a href="#" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <?php include("includes/Footer.php")?>
    <?php include("includes/scripts.php")?>
</body>

</html>
