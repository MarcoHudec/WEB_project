<?php
require_once("databaseScript/dbaccess.php");

// Fetch all bookings from the 'reservations' table
$query = "SELECT * FROM reservations ORDER BY id DESC";

if (isset($_GET['statusFilter'])) {
    $statusFilter = $_GET['statusFilter'];
    // If a filter is selected, modify the query to include the status filter
    if ($statusFilter !== 'All') {
        $query = "SELECT * FROM reservations WHERE status = '$statusFilter' ORDER BY id DESC";
    }
}

$result = $db->query($query);


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

        .form-select{
            max-width: 150px;
            margin-bottom: 10px;
            margin-top:10px;
        }

    </style>

</head>



<body>
<?php include("includes/navbaradmin.php") ?>
<!-- Navbar and container structure -->
<div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <div class="container">
            <h1 class="custom-heading text-center">Bookings List</h1>
            <br>

            <!-- Filter form -->
            <form method="GET">
            <label for="statusFilter">Filter by Status:</label>
            <select class="form-select" name="statusFilter" id="statusFilter">
                <option value="All">All</option>
                <option value="new">New</option>
                <option value="canceled">Canceled</option>
                <option value="confirmed">Confirmed</option>
            </select>
                <button type="submit" class="btn btn-primary" name="filter-form">Filter</button>
            </form>
            <br>

            <?php
            // Check if the $result variable is set and not null before fetching data
            if ($result !== null && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Display bookings based on the fetched data
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
    <!-- Additional scripts -->
</body>
</html>
