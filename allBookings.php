<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/adminhead.php") ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Include necessary CSS or Bootstrap for styling -->

    <style>
        #dashboard-menu {
            /* Set appropriate width and height */
            width: 250px;
            height: 100vh; /* Adjust height as needed */
            overflow-y: auto; /* Add scroll if content overflows */
        }

        /* Adjust the main content area to fit the remaining space */
        .col-lg-10 {
            /* Use calc to ensure the table takes the remaining space */
            width: calc(100% - 250px);
            height: 100vh; /* Adjust height as needed */
            overflow-y: auto; /* Add scroll if content overflows */
        }

        .container {
            display: flex;
            justify-content: center;
        }

        .col-lg-10 {
            /* Add your specific styles for col-lg-10 here */
            /* For centering, you can add margin or padding as needed */
            /* Example: */
            margin: 0 auto; /* This will horizontally center the element */
            
        }

    </style>

</head>



<body>
<?php include("includes/navbaradmin.php") ?>
    <div class="container">
        <div class="row">
        
        <h1>Bookings List</h1>
        
        
        
        
        
        <div class="col-lg-10">
        <?php
        // Include database connection file
        require_once("databaseScript/dbaccess.php");

    
    // Fetch all bookings from the 'reservations' table
    $query = "SELECT * FROM reservations";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        // Display table header
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>User ID</th><th>Room ID</th><th>Date Start</th><th>Date End</th><th>Status</th><th>Date Reservation</th><th>Breakfast</th><th>Parking Spot</th><th>Pet</th><th>Total Price</th><th>Actions</th></tr>";

        // Display data rows
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["room_id"] . "</td>";
            echo "<td>" . $row["date_start"] . "</td>";
            echo "<td>" . $row["date_end"] . "</td>";
            echo "<td>" . $row["status"] . "</td>";
            echo "<td>" . $row["date_reservation"] . "</td>";
            echo "<td>" . $row["breakfast"] . "</td>";
            echo "<td>" . $row["parkingspot"] . "</td>";
            echo "<td>" . $row["pet"] . "</td>";
            echo "<td>" . $row["totalprice"] . "</td>";
            // Add edit/delete buttons or links in the last column
            echo "<td><a href='edit_booking.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete_booking.php?id=" . $row["id"] . "'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No bookings found.";
    }

    // Close database connection
    $db->close();
    ?>

    <!-- Add filter options or search functionality here -->
    <?php include("includes/scripts.php") ?>

        </div>
    </div>
</div>
</body>
</html>
