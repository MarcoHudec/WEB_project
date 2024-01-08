<?php
require_once("databaseScript/dbaccess.php");



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newStatus = $_POST['status'];
    $reservationId = $_POST['id'];

    $query = "UPDATE reservations SET status = ? WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("si", $newStatus, $reservationId);
    $stmt->execute();
    header("Location: {$_SERVER['PHP_SELF']}?id={$reservationId}");
    exit();

    // Redirect or display success message
    // header("Location: success.php");
    // exit();

}


//if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET['id'])) {
        $reservationId = $_GET['id'];

        $query = "SELECT id, user_id, room_id, date_start, date_end, status, date_reservation, breakfast, parkingspot, pet, totalprice FROM reservations WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $reservationId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
        } else {
            echo "Reservation not found.";
            exit();
        }
    } else {
        echo "Invalid request.";
        exit();
    }
//}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/adminhead.php") ?>
        
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Booking Detailed</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
   
    
    <style>
        .user-card {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
        }
        .fixed-width-table {
            width: 100%; /* Setzt die Breite der Tabelle auf 100% des Elternelements */
            table-layout: fixed; /* Ermöglicht gleichmäßige Spaltenbreiten */
            word-wrap: break-word; /* Stellt sicher, dass lange Wörter innerhalb der Zelle umgebrochen werden */
            overflow: hidden; /* Verhindert, dass Inhalt aus der Zelle herausragt */
            text-align: center; /* Ausrichtung des Textess */
        }
    </style>
</head>



<body>
<?php include("includes/navbaradmin.php") ?>

<div class="col-lg-10 ms-auto p-4 overflow-hidden">
    <div class="container">
        <h1 class="custom-heading text-center">
            Reservation (ID: <?php echo $row['id']; ?>)
        </h1>

        <div style="text-align: center;">
            <a href="allBookings.php" class="btn btn-primary text-white">Back to all Bookings</a>
        </div>

        <br>
        <div class="col-md-12">
            <div class="user-card">
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <table class="table fixed-width-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User ID</th>
                                <th>Room ID</th>
                                <th>Date Start</th>
                                <th>Date End</th>
                                <th>Status</th>
                                <th>Date Reservation</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $row['room_id']; ?></td>
                                <td><?php echo $row['date_start']; ?></td>
                                <td><?php echo $row['date_end']; ?></td>
                                <td>
                                    <select name="status" class="form-select mb-3">
                                        <option value="new" <?php echo ($row['status'] === 'new') ? 'selected' : ''; ?>>New</option>
                                        <option value="confirmed" <?php echo ($row['status'] === 'confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                                        <option value="canceled" <?php echo ($row['status'] === 'canceled') ? 'selected' : ''; ?>>Canceled</option>
                                    </select>
                                </td>
                                <td><?php echo $row['date_reservation']; ?></td>
                                <td><?php echo $row['totalprice']; ?>€</td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-primary">Safe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include("includes/scripts.php") ?>
</body>
