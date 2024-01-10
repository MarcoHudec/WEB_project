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
    <!-- Header section including a navigation bar -->
    <header>
        <?php include("includes/navbar.php") ?> <!-- Including a navigation bar -->
    </header>

    <!-- Main content section with a form-signin class -->
    <main class="form-signin">
        <div class="container">
            <h1 class="custom-heading">
                My Bookings
            </h1>

            <?php
            // Retrieving user's bookings from the database based on user ID
            $userId = $_SESSION["userid"];
            $query = "SELECT * FROM reservations WHERE user_id = ? ORDER BY date_start";
            $stmt = $db->prepare($query);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            // Displaying user's bookings if found
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <!-- Displaying individual booking details -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="user-card">
                                <p>Suite:
                                    <?php
                                    // Displaying the booked suite based on room ID
                                    if ($row['room_id'] == 1) {
                                        echo 'Standard with King-size Bed';
                                    } else if ($row['room_id'] == 2) {
                                        echo 'Standard with Queen-size Bed';
                                    } else if ($row['room_id'] == 3) {
                                        echo 'Deluxe with King-size Bed';
                                    } else if ($row['room_id'] == 4) {
                                        echo 'Deluxe with Queen-size Bed';
                                    } else if ($row['room_id'] == 5) {
                                        echo 'Executive Suite';
                                    } else if ($row['room_id'] == 6) {
                                        echo 'Premier Suite';
                                    } else if ($row['room_id'] == 7) {
                                        echo 'Signature Suite';
                                    } else if ($row['room_id'] == 8) {
                                        echo 'Deluxe Suite';
                                    }
                                    ?>
                                </p>
                                <p>Arrival: <?php echo $row['date_start']; ?></p>
                                <p>Departure: <?php echo $row['date_end']; ?></p>
                                <p>Status:
                                    <?php
                                    // Displaying booking status
                                    if ($row['status'] == 'new') {
                                        echo 'New';
                                    } elseif ($row['status'] == 'confirmed') {
                                        echo 'Confirmed';
                                    } elseif ($row['status'] == 'canceled') {
                                        echo 'Canceled';
                                    }
                                    ?>
                                </p>
                                <p>Price: <?php echo $row['totalprice']; ?>€</p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p>No bookings found.</p>'; // Displaying a message if no bookings found
            }
            $stmt->close(); // Closing the prepared statement
            ?>
        </div>
    </main>

    <!-- Including footer and scripts -->
    <?php include("includes/footer.php") ?> <!-- Including footer -->
    <?php include("includes/scripts.php") ?> <!-- Including scripts -->
</body>


</html>

<?php
exit();
?>
