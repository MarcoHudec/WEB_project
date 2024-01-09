<?php
require_once("databaseScript/dbaccess.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php include("includes/head.php")?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>My Bookings - Hotel Zadar</title>
    
    
    <style>
        .form-signin {
            width: 100%;
            max-width: 850px;
            padding: 15px;
            margin: auto;
        }

        .col-md-4 {
            padding-bottom: 10px;
        }

        .user-card {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .custom-heading {
            padding-bottom: 30px;
            padding-top: 30px;
            font-size: 30px;
        }

    </style>
</head>

<body>
<header>
    <?php include("includes/navbar.php") ?>
</header>

<main class="form-signin">
    <div class="container">
        <h1 class="custom-heading">
            My Bookings
        </h1>

        <?php
        $userId = $_SESSION["userid"];
        $query = "SELECT * FROM reservations WHERE user_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="user-card">
                            <p>Suite: <?php if ($row['room_id'] ==1) {echo 'Standard mit Kingsize-Bett';} else if ($row['room_id'] ==2) {echo 'Standard mit Queensize-Bett';} else if ($row['room_id'] ==3) {echo 'Deluxe mit Kingsize-Bett';} else if ($row['room_id'] ==4) {echo 'Deluxe mit Queensize-Bett';} else if ($row['room_id'] ==5) {echo 'Executive Suite';} else if ($row['room_id'] ==6) {echo 'Premier Suite';} else if ($row['room_id'] ==7) {echo 'Signature Suite';} else if ($row['room_id'] ==8) {echo 'Deluxe Suite';}?></p>
                            <p>Arrival: <?php echo $row['date_start']; ?></p>
                            <p>Departure: <?php echo $row['date_end']; ?></p>
                            <p>Status: <?php if ($row['status'] =='new') {echo 'Neu';} elseif ($row['status'] == 'confirmed') {echo 'Bestätigt';} elseif ($row['status'] =='canceled') {echo 'Storniert';}?></p>
                            <p>Price: <?php echo $row['totalprice'];?>€</p>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<p>No bookings found.</p>';
        }
        $stmt->close();
        ?>
    </div>
</main>


<?php include("includes/footer.php") ?>
<?php include("includes/scripts.php") ?>


</body>

</html>

<?php
exit();
?>
