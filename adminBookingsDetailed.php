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
    <?php include("includes/head.php") ?>
    <?php include("includes/Navbar.php") ?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Booking Detailed</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
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

        .navigation {
            margin-bottom: 20px;
            text-align: center;
        }

        .navigation a {
            margin-right: 10px;
        }


        .status-dropdown {
            margin-top: 10px; /* Adjust this value as needed */
        }

        

        

    </style>




</head>



<body>

<main class="form-signin">

    <div class="container text-center">
        <h1 class="custom-heading">
            Reservierung (ID: <?php echo $row['id']; ?>)
        </h1>


        <a href="allBookings.php" class="btn btn-primary text-white">Zurück zu den gesamten Buchungen</a>

        <br>
        <br>





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
                                    <td>
                            <select name="status" class="form-select mb-3">
                                <option value="new" <?php echo ($row['status'] === 'new') ? 'selected' : ''; ?>>New</option>
                                <option value="confirmed" <?php echo ($row['status'] === 'confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                                <option value="canceled" <?php echo ($row['status'] === 'canceled') ? 'selected' : ''; ?>>Canceled</option>
                            </select>
                        </td>
                        <td><?php echo $row['date_reservation']; ?></td>
                        <td><?php echo $row['totalprice']; ?></td>
                        <td><a href="adminBookingsDetailed.php?id=<?php echo $row['id']; ?>">Details anzeigen</a></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Speichern</button>
        </form>
    </div>
</main>

<footer>
    <?php include("includes/footer.php") ?>
</footer>

<script src="bootstrap.bundle.min.js"></script>
</body>
