<?php
require_once("databaseScript/dbaccess.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/adminhead.php") ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Include necessary CSS or Bootstrap for styling -->

    <style>
        .reservation-card {
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
            Bookings List
        </h1>
        <br></br>
        
        <?php
    // Fetch all bookings from the 'reservations' table
    $query = "SELECT * FROM reservations ORDER BY id ASC";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="reservation-card">
                        <table class="table fixed-width-table">
                            <thead>
                                <tr>
                                    <th>Reservation ID</th>
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
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['user_id']; ?></td>
                                    <td><?php echo $row['room_id']; ?></td>
                                    <td><?php echo $row['date_start']; ?></td>
                                    <td><?php echo $row['date_end']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td><?php echo $row['date_reservation']; ?></td>
                                    <td><?php echo $row['totalprice']; ?>€</td>
                                    <td><a href="adminBookingsDetailed.php?id=<?php echo $row['id']; ?>">Show Details</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "No results found";
    }

    // Close database connection
    $db->close();
    ?>
</div>
</div>
    <!-- Add filter options or search functionality here -->
    <?php include("includes/scripts.php") ?>

    
    
</body>
</html>
