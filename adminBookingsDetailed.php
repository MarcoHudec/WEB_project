<?php
require_once("databaseScript/dbaccess.php");

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the new status and reservation ID from the form
    $newStatus = $_POST['status'];
    $reservationId = $_POST['id'];

    // Update the status of the reservation in the database
    $query = "UPDATE reservations SET status = ? WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("si", $newStatus, $reservationId);
    $stmt->execute();

    // Redirect back to the current page with the reservation ID in the URL
    header("Location: {$_SERVER['PHP_SELF']}?id={$reservationId}");
    exit();
}

// Fetch the reservation details based on the ID provided in the GET parameters
if (isset($_GET['id'])) {
    $reservationId = $_GET['id'];

    // Query to retrieve the reservation details from the database
    $query = "SELECT id, user_id, room_id, date_start, date_end, status, date_reservation, breakfast, parkingspot, pet, totalprice FROM reservations WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $reservationId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a single reservation is found
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc(); // Fetch reservation details
    } else {
        echo "Reservation not found."; // Display message if reservation not found
        exit();
    }
} else {
    echo "Invalid request."; // Display message for an invalid request (no ID provided)
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/adminhead.php") ?>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Detailed Bookings</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />


    <style>
        .user-card {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
        }

        .fixed-width-table {
            width: 100%;
            /* Setzt die Breite der Tabelle auf 100% des Elternelements */

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

    <!-- Reservation details section -->
    <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <div class="container">
            <h1 class="custom-heading text-center">
                Reservation (ID:
                <?php echo $row['id']; ?>) <!-- Displaying Reservation ID -->
            </h1>

            <!-- Back button to all bookings -->
            <div style="text-align: center;">
                <a href="allBookings.php" class="btn btn-primary text-white">Back to all Bookings</a>
            </div>

            <br>

            <!-- Form to edit reservation details -->
            <div class="col-md-12">
                <div class="user-card">
                    <form action="" method="post">
                        <!-- Hidden input field to store reservation ID -->
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                        <!-- Table displaying reservation details for editing -->
                        <table class="table fixed-width-table">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Room ID</th>
                                    <th>Date Start</th>
                                    <th>Date End</th>
                                    <th>Status</th>
                                    <th>Reservation Date</th>
                                    <th>Breakfast</th>
                                    <th>Parking</th>
                                    <th>Pets</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <!-- Displaying each reservation detail -->
                                    <td>
                                        <?php echo $row['user_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['room_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['date_start']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['date_end']; ?>
                                    </td>
                                    <!-- Dropdown to select and update reservation status -->
                                    <td>
                                        <select name="status" class="form-select mb-3">
                                            <option value="new" <?php echo ($row['status'] === 'new') ? 'selected' : ''; ?>>New</option>
                                            <option value="confirmed" <?php echo ($row['status'] === 'confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                                            <option value="canceled" <?php echo ($row['status'] === 'canceled') ? 'selected' : ''; ?>>Canceled</option>
                                        </select>
                                    </td>
                                    <td>
                                        <?php echo $row['date_reservation']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['breakfast']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['parkingspot']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['pet']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['totalprice']; ?>€
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Save button to submit changes -->
                        <div style="text-align: center;">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/scripts.php") ?> <!-- Including necessary scripts -->
</body>

</html>