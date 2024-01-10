<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/head.php") ?>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Reservation Form</title>

    <style>
        .container-reservation {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .heading-section {
            margin-bottom: 30px;
        }

        .content-section {
            display: flex;
        }

        .card-section {
            display: flex;
            flex-wrap: wrap;
            /* Erlaubt das Umfließen der Karten, falls der Bildschirm zu klein ist */
            justify-content: flex-start;
            /* Richtet die Karten am Anfang des Containers aus */
            gap: 20px;
            /* Fügt Abstand zwischen den Karten hinzu */
        }

        .card {
            flex: 1 1 calc(50% - 20px);
            /* Passt die Breite jeder Karte an, um zwei Karten nebeneinander zu ermöglichen, berücksichtigt den Abstand */
            margin-bottom: 20px;
            /* Abstand nach unten für jede Karte */
        }

        .card img.card-img-top {
            width: 100%;
            /* Stellt sicher, dass das Bild die gesamte Breite der Karte einnimmt */
            height: auto;
            /* Behält das Seitenverhältnis des Bildes bei */
        }

        .reservation-form {
            width: 100%;
            max-width: 450px;
            padding: 20px;
            max-height: 1000px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            flex: 0 0 300px;
            margin-left: 100px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control,
        .form-select {
            width: 100%;
            margin-bottom: 1rem;
            padding: 0.375rem 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .form-check-input {
            width: 1.2rem;
            height: 1.2rem;
            margin-right: 0.5rem;
        }

        .btn {
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }

        .btn-primary {
            width: 50%;
            padding: 0.5rem 0.5rem;
            border-radius: 0.25rem;
            margin: auto;
            display: block;
        }

        .btn-primary:hover {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .center-elements {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .total-price {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .price-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .custom-price {
            font-size: 1rem;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<?php include("includes/navbar.php") ?>



<?php
require_once("databaseScript/dbaccess.php");




// Default room type if nothing is selected
$defaultRoomType = 'Standard mit Kingsize-Bett';

// Use the default room type if 'room-type' is not set
$roomType = isset($_GET['room-type']) ? $_GET['room-type'] : $defaultRoomType;





// SQL Query: Retrieve all details related to a specific room type from the "rooms" table
$query = "SELECT * FROM rooms WHERE room = ?";

// Prepare and execute the query, bind results to variables
$stmt = $db->prepare($query);
$stmt->bind_param("s", $roomType);
$stmt->execute();
$stmt->bind_result($roomId, $roomType, $roomStatus, $cardPrice, $breakfastPrice, $petsPrice, $parkingPrice);
$stmt->fetch();
$stmt->close();

// Prepare error variables for date validation
$dateError = '';
$dateError2 = '';
$dateError3 = '';

// Check if the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if either "calculate-price" or "submit-form" are set, and if start/end dates and breakfast are provided
    if ((isset($_POST['calculate-price']) || (isset($_POST['submit-form']))) && isset($_POST["start-date"]) && isset($_POST["end-date"]) && isset($_POST["breakfast"])) {

        // SQL Query to check if the room is available for the provided dates
        $query = "SELECT * FROM reservations WHERE room_id = ? AND NOT (date_end <= ? OR date_start >= ?)";
        $stmt = $db->prepare($query);

        // Bind parameters for the SQL query
        $stmt->bind_param("iss", $roomId, $start_date, $end_date);
        $start_date = $_POST["start-date"];
        $end_date = $_POST["end-date"];

        // Execute the query
        $stmt->execute();
        $stmt->store_result();

        // Count the number of rows returned by the query
        $numRows = $stmt->num_rows;
        $stmt->close();

        // Check if the room is unavailable for the selected dates
        if ($numRows > 0) {
            // Room is not available for the selected dates
            // Handle the unavailability scenario here
            // Example: Display an error message
            $dateError3 = 'Room not available during the selected dates. Please try other dates or another room';
        } elseif (empty($_POST['start-date']) || empty($_POST['end-date'])) {
            // Error if check-in or check-out dates are not selected
            $dateError = 'Select a Check-in and Check-out date';
        } elseif ($_POST['start-date'] > $_POST['end-date']) {
            // Error if check-in is after check-out
            $dateError2 = 'Check-in must be before Check-out';
        }
    }
}





// Additional services selected by the user
$breakfastSelected = isset($_POST['breakfast']) && $_POST['breakfast'] === 'yes';
$petsSelected = isset($_POST['pets']) && $_POST['pets'] === 'yes';
$parkingSelected = isset($_POST['parking']) && $_POST['parking'] === 'yes';


// Calculate reservation price based on selected room type and reservation duration
$pricePerDay = isset($cardPrice) ? $cardPrice : 0; // Default price if room type not found
$startDate = isset($_POST['start-date']) ? strtotime($_POST['start-date']) : time();
$endDate = isset($_POST['end-date']) ? strtotime($_POST['end-date']) : time();
$daysDiff = ($endDate - $startDate) / (60 * 60 * 24); // Calculate days difference

//calculated total Price
$totalPrice = $daysDiff * $pricePerDay;



// Calculate additional prices based on user selection
$additionalPrice = 0;
if ($breakfastSelected) {
    $additionalPrice += $breakfastPrice;
}
if ($petsSelected) {
    $additionalPrice += $petsPrice;
}
if ($parkingSelected) {
    $additionalPrice += $parkingPrice;
}

if (!isset($totalPrice)) {
    $totalPrice = 0;
}

// Calculate total price including additional services
$totalPrice = $totalPrice + $additionalPrice;



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form has been submitted via POST and if required fields are set and error variables are empty
    if (isset($_POST["submit-form"]) && isset($_POST["start-date"]) && isset($_POST["end-date"]) && isset($_POST["breakfast"]) && empty($dateError) && empty($dateError2) && empty($dateError3)) {
        // SQL query to insert reservation details into the 'reservations' table
        $query = "INSERT INTO reservations (user_id, room_id, date_start, date_end, status, date_reservation, breakfast, parkingspot, pet, totalprice) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);

        // Bind parameters to the SQL query
        $stmt->bind_param("iisssssssi", $userId, $roomId, $start_date, $end_date, $status, $date_reservation, $breakfast, $parkingspot, $pet, $totalPrice);

        // Set values for parameters
        $userId = $_SESSION["userid"];
        $start_date = $_POST["start-date"];
        $end_date = $_POST["end-date"];
        $status = "new";
        $date_reservation = date('Y-m-d');
        $breakfast = isset($_POST['breakfast']) && $_POST['breakfast'] === 'yes' ? 'yes' : 'no';
        $parkingspot = isset($_POST['parking']) && $_POST['parking'] === 'yes' ? 'yes' : 'no';
        $pet = isset($_POST['pets']) && $_POST['pets'] === 'yes' ? 'yes' : 'no';

        // Calculate total price based on selected dates and additional services
        $pricePerDay = isset($cardPrice) ? $cardPrice : 0; // Default price if room type not found
        $startDate = isset($_POST['start-date']) ? strtotime($_POST['start-date']) : time();
        $endDate = isset($_POST['end-date']) ? strtotime($_POST['end-date']) : time();
        $daysDiff = ($endDate - $startDate) / (60 * 60 * 24); // Calculate days difference
        $totalPrice = $daysDiff * $pricePerDay; // Calculate total price for the reservation

        $totalPrice = $totalPrice + $additionalPrice; // Add additional service prices

        // Execute the prepared statement to insert the reservation into the database
        $stmt->execute();
        $stmt->close();
    }
}
?>













<!-- Main container for the reservation section -->
<main class="container-reservation">

    <!-- Heading section with a centered heading -->
    <div class="heading-section text-center">
        <h1 class="custom-heading">
            Reservation
        </h1>
    </div>

    <!-- Content section displayed as a flex container -->
    <div class="content-section" style="display: flex;">
        <!-- Card Section -->
        <div class="card-section"
            style="flex-grow: 2; display: flex; flex-wrap: wrap; justify-content: flex-start; margin-right: 20px;">


            <?php
            // Fetch room types from the database
            $query = "SELECT DISTINCT room FROM rooms"; // Adapt the query to your database structure
            $stmt = $db->prepare($query);
            $stmt->execute();
            $stmt->bind_result($roomType);

            // Store room types in an array
            $roomTypes = [];
            while ($stmt->fetch()) {
                $roomTypes[] = $roomType;
            }
            $stmt->close();

            foreach ($roomTypes as $type) {
                // Fetch room details including price from the database for each room type
                $query = "SELECT * FROM rooms WHERE room = ?";
                $stmt = $db->prepare($query);
                $stmt->bind_param("s", $type);
                $stmt->execute();
                $stmt->bind_result($roomId, $roomType, $roomStatus, $cardPrice, $breakfastPrice, $petsPrice, $parkingPrice);
                $stmt->fetch();
                $stmt->close();




                switch ($type) {
                    case 'Standard mit Kingsize-Bett':
                        $imageURL = 'Images/HotelRoom1.jpeg';
                        $cardTitle = 'Standard with King-size Bed';
                        $cardText = 'Experience comfort and space in our standard room with a luxurious king-size bed, ideal for a relaxed stay.';
                        break;
                    case 'Deluxe mit Kingsize-Bett':
                        $imageURL = 'Images/HotelRoom2.jpeg';
                        $cardTitle = 'Deluxe with King-size Bed';
                        $cardText = 'Enjoy elegance and sophistication in our deluxe room, equipped with a spacious king-size bed for a luxurious retreat.';
                        break;
                    case 'Standard mit Queensize-Bett':
                        $imageURL = 'Images/HotelRoom3.jpeg';
                        $cardTitle = 'Standard with Queen-size Bed';
                        $cardText = 'Enjoy a cozy stay in our standard room with a comfortable queen-size bed for a restful sleep.';
                        break;
                    case 'Deluxe mit Queensize-Bett':
                        $imageURL = 'Images/HotelRoom4.jpeg';
                        $cardTitle = 'Deluxe with Queen-size Bed';
                        $cardText = 'Experience luxury and style in our deluxe room, furnished with a plush queen-size bed for a truly comfortable experience.';
                        break;
                    case 'Executive Suite':
                        $imageURL = 'Images/HotelRoom4.jpeg';
                        $cardTitle = 'Executive Suite';
                        $cardText = 'A sophisticated space for comfort and productivity, ideal for business travelers seeking refinement.';
                        break;
                    case 'Premier Suite':
                        $imageURL = 'Images/HotelRoom6.jpeg';
                        $cardTitle = 'Premier Suite';
                        $cardText = 'An exclusive accommodation with premium amenities and an elevated experience for discerning guests.';
                        break;
                    case 'Signature Suite':
                        $imageURL = 'Images/HotelRoom7.jpeg';
                        $cardTitle = 'Signature Suite';
                        $cardText = 'A distinctive and individually designed suite showcasing unique design elements and luxurious accents.';
                        break;
                    default:
                        $imageURL = 'Images/HotelRoom1.jpeg';
                        $cardTitle = 'Standard with King-size Bed';
                        $cardText = 'Experience comfort and space in our standard room with a luxurious king-size bed, ideal for a relaxed stay.';
                        break;
                }

                echo '<div class="card">
    <img src="' . $imageURL . '" class="card-img-top" alt="..."> <!-- Room image -->
    <div class="card-body">
        <h5 class="card-title">' . $cardTitle . '</h5> <!-- Room title -->
        <p class="card-text">' . $cardText . '</p> <!-- Description of the room -->
        <form method="get" action="">
            <p2 class="custom-price">' . $cardPrice . '€ per night</p2> <!-- Display room price -->
        </form>
    </div>
    <div class="card-footer text-center">
        <form method="get" action="">
            <input type="hidden" name="room-type" value="' . $type . '"> <!-- Hidden input for room type -->
            <input type="hidden" name="card-title" value="' . $cardTitle . '"> <!-- Hidden input for card title -->
            <button type="submit" class="btn btn-primary" name="room-selected">Select room</button>
            <!-- Button to select the room -->
        </form>
    </div>
</div>';


            }
            ?>


            <input type="hidden" name="selected-room-id" value="<?php echo $roomId; ?>">
            <input type="hidden" name="selected-room-type" value="<?php echo $roomType; ?>">
            <input type="hidden" name="selected-card-price" value="<?php echo $cardPrice; ?>">
            <!-- Other hidden fields for additional prices if needed -->


        </div>












        <!-- Filter Section -->
        <br>
        <br>

        <div class="reservation-form" style="flex-grow: 1;">
            <!-- Reservation Form -->
            <form method="post" action="">
                <div class="center-elements">
                    <h5 class="card-title">Complete your reservation</h5>
                    <br></br>

                    <?php
                    // Check if 'card-title' parameter is set in the URL
                    if (isset($_GET['card-title'])) {
                        $selectedCardTitle = $_GET['card-title'];
                        // Display selected room title
                        echo ' <label class="form-label">Selected Room</label>';
                        echo "$selectedCardTitle <br></br>";
                    }
                    ?>

                    <div class="mb-3">
                        <label for="start-date" class="form-label">Check-in</label>
                        <!-- Input field for Check-in date -->
                        <input type="date" class="form-control" id="start-date" name="start-date"
                            value="<?php echo isset($_POST['start-date']) ? $_POST['start-date'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="end-date" class="form-label">Check-out</label>
                        <!-- Input field for Check-out date -->
                        <input type="date" class="form-control" id="end-date" name="end-date"
                            value="<?php echo isset($_POST['end-date']) ? $_POST['end-date'] : ''; ?>">
                    </div>

                    <?php if (!empty($dateError)): ?>
                        <!-- Display error message if $dateError is not empty -->
                        <div class="alert alert-danger" role="alert">
                            <?php echo $dateError; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($dateError2)): ?>
                        <!-- Display error message if $dateError2 is not empty -->
                        <div class="alert alert-danger" role="alert">
                            <?php echo $dateError2; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($dateError3)): ?>
                        <!-- Display error message if $dateError3 is not empty -->
                        <div class="alert alert-danger" role="alert">
                            <?php echo $dateError3; ?>
                        </div>
                    <?php endif; ?>




                    <!-- Checkbox for Breakfast option -->
<div class="mb-3">
    <div class="form-check">
        <!-- Input checkbox for Breakfast -->
        <input class="form-check-input" type="checkbox" value="yes" id="breakfast" name="breakfast"
            <?php echo (isset($_POST['breakfast']) && $_POST['breakfast'] === 'yes') ? 'checked' : ''; ?>>
        <!-- Label for Breakfast -->
        <label class="form-check-label" for="breakfast">Breakfast
            <!-- Display Breakfast price -->
            <span class="price-container">
                <?php echo "(" . $breakfastPrice . "€ per night)"; ?>
            </span>
        </label>
    </div>
</div>

<!-- Checkbox for Pets option -->
<div class="mb-3">
    <div class="form-check">
        <!-- Input checkbox for Pets -->
        <input class="form-check-input" type="checkbox" value="yes" id="pets" name="pets" 
            <?php echo (isset($_POST['pets']) && $_POST['pets'] === 'yes') ? 'checked' : ''; ?>>
        <!-- Label for Pets -->
        <label class="form-check-label" for="pets">Pets
            <!-- Display Pets price -->
            <span class="price-container">
                <?php echo "(" . $petsPrice . "€ per night)"; ?>
            </span>
        </label>
    </div>
</div>

<!-- Checkbox for Parking option -->
<div class="mb-3">
    <div class="form-check">
        <!-- Input checkbox for Parking -->
        <input class="form-check-input" type="checkbox" value="yes" id="parking" name="parking"
            <?php echo (isset($_POST['parking']) && $_POST['parking'] === 'yes') ? 'checked' : ''; ?>>
        <!-- Label for Parking -->
        <label class="form-check-label" for="parking">Parking
            <!-- Display Parking price -->
            <span class="price-container">
                <?php echo "(" . $parkingPrice . "€ per night)"; ?>
            </span>
        </label>
    </div>
</div>

                </div>


                <br></br>
                <div class="text-center">
    <!-- Button to calculate price -->
    <button type="submit" class="btn btn-primary" name="calculate-price">Calculate total price</button>

    <!-- Display total price -->
    <?php if (isset($_POST['calculate-price'])): ?>
        <!-- Container for displaying total price -->
        <div class="total-price">
            <?php
            // Display total price if no date errors and form submitted
            if ((isset($_POST['calculate-price'])) && empty($dateError) && empty($dateError2) && empty($dateError3)) {
                echo 'total price: ' . number_format($totalPrice, 2) . ' €'; // Show formatted total price
            } else {
                echo 'total price: '; // Display text indicating no total price due to errors
            }
            ?>
        </div>
    <?php endif; ?>

    <br>

    <?php
    // Check if user is logged in
    if (isset($_SESSION["active"])) { ?>
        <!-- Button to reserve room -->
        <button type="submit" class="btn btn-primary" name="submit-form">Reserve room</button>
    <?php } else { ?>
        <!-- Display message for users not logged in -->
        <p class="text-danger">You have to be logged in to reserve a room</p>
    <?php } ?>
</div>

            </form>
        </div>
    </div>
</main>

<?php include("includes/footer.php") ?>
<?php include("includes/scripts.php") ?>

</html>