<?php
session_start();
?>

<?php
if(!isset($_SESSION["admin"])): {
    header("Location: index.php");
}
?>

<?php endif; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/adminhead.php") ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Specific User Booking</title>
    <link rel="stylesheet" href="CSS/common.css">
    <!-- Include necessary CSS or Bootstrap for styling -->

    <style>
        .reservation-card {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
        }

        .fixed-width-table {
            width: 100%;
            /* Setzt die Breite der Tabelle auf 100% des Elternelements */
            table-layout: fixed;
            /* Ermöglicht gleichmäßige Spaltenbreiten */
            word-wrap: break-word;
            /* Stellt sicher, dass lange Wörter innerhalb der Zelle umgebrochen werden */
            overflow: hidden;
            /* Verhindert, dass Inhalt aus der Zelle herausragt */
            text-align: center;
            /* Ausrichtung des Textess */
        }
    </style>

</head>



<body>
    <?php include("includes/navbaradmin.php") ?> <!-- Including the admin navbar -->
    <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <div class="container">
            <div class="row">
                <h1 class="text-center">Bookings List</h1>
                <div class="col-lg-12">
                    <?php
                    // Include database connection file
                    require_once("databaseScript/dbaccess.php");

                    // Check if user_id is set in the URL
                    if (isset($_GET['user_id'])) {
                        $selected_user_id = $_GET['user_id'];

                        // Fetch bookings for the specific user from the 'reservations' table
                        $query = "SELECT * FROM reservations WHERE user_id = '$selected_user_id'";
                        $result = $db->query($query);

                        // Check if bookings are found for the specified user
                        if ($result->num_rows > 0) {
                            ?>
                            <!-- Display table of bookings for the user -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="reservation-card">
                                        <table class="table fixed-width-table">
                                            <thead>
                                                <tr>
                                                    <!-- Table header columns -->
                                                    <th>ID</th>
                                                    <th>User ID</th>
                                                    <th>Room ID</th>
                                                    <th>Date Start</th>
                                                    <th>Date End</th>
                                                    <th>Status</th>
                                                    <th>Date Reservation</th>
                                                    <th>Total Price</th>
                                                    <th>Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Display each booking's details in table rows
                                                while ($row = $result->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <!-- Booking details displayed in table cells -->
                                                        <td><?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['user_id']; ?></td>
                                                        <td><?php echo $row['room_id']; ?></td>
                                                        <td><?php echo $row['date_start']; ?></td>
                                                        <td><?php echo $row['date_end']; ?></td>
                                                        <td><?php echo $row['status']; ?></td>
                                                        <td><?php echo $row['date_reservation']; ?></td>
                                                        <td><?php echo $row['totalprice'] . ' €'; ?></td>
                                                        <td><a href="adminBookingsDetailed.php?id=<?php echo $row['id']; ?>">Details anzeigen</a></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            echo "No results found for this user ID."; // Display message if no bookings found for the user
                        }
                    } else {
                        echo "User ID not provided in the URL."; // Display message if user ID is not in the URL
                    }

                    // Close database connection
                    $db->close();
                    ?>

                    <!-- Include necessary scripts -->
                    <?php include("includes/scripts.php") ?> <!-- Including scripts -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>