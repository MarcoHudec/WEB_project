<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/head.php") ?>
    <?php include("includes/Navbar.php") ?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Reservation Form</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <style>
        /* Add more styling to improve the form's appearance */


        /* Add a class to hide/show elements */

        p2 {
            font-size: 20px;
        }

        .hidden {
            display: none;
        }

        .reservation-form {
            width: 100%;
            max-width: 450px;
            padding: 15px;
            max-height: 1000px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            flex: 0 0 300px;
            margin-top: 50px; 
            
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            margin-bottom: 1rem;
            padding: 0.375rem 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

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
            padding: 0.75rem 1rem; /* Change the padding to adjust the button size */
            font-size: 1rem; /* Adjust the font size */
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

        .card {
            max-width: 500px; /* Adjust the max-width to your preferred width */
            margin: 50px; /* Center the card horizontally */
            
        }

        img.card-img-top {
            width: 50%;
            height: auto;
            max-width: 100%; /* Allow the image to resize within the card */
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .custom-heading {
            padding-bottom: 30px;
            padding-top: 30px;
            font-size: 30px;
            position: center;
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





<?php

require_once("databaseScript/dbaccess.php");




// Default room type if nothing is selected
$defaultRoomType = 'Standard mit Kingsize-Bett';

// Use the default room type if 'room-type' is not set
$roomType = isset($_GET['room-type']) ? $_GET['room-type'] : $defaultRoomType;

// Rest of your code remains the same...


//if ($_SERVER["REQUEST_METHOD"] == "POST") {


$query = "SELECT * FROM rooms WHERE room = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $roomType);
$stmt->execute();
$stmt->bind_result($roomId, $roomType, $roomStatus, $cardPrice, $breakfastPrice, $petsPrice, $parkingPrice);

$stmt->fetch();


$stmt->close();

//}
$dateError = '';
$dateError2 = '';
$dateError3 = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ((isset($_POST['calculate-price']) || (isset($_POST['submit-form']))) && isset($_POST["start-date"]) && isset($_POST["end-date"]) && isset($_POST["breakfast"])) {
        $query = "SELECT * FROM reservations WHERE room_id = ? AND NOT (date_end <= ? OR date_start >= ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("iss", $roomId, $start_date, $end_date);
        $start_date = $_POST["start-date"];
        $end_date = $_POST["end-date"];
        $stmt->execute();
        $stmt->store_result();
        $numRows = $stmt->num_rows;
        $stmt->close();

        if ($numRows > 0) {
            // Room is not available for the selected dates
            // Handle the unavailability scenario here
            // Example: Display an error message
            $dateError3 = 'Room not availibe in during the selected dates. Please try other dates or another room';
        } elseif (empty($_POST['start-date']) || empty($_POST['end-date'])) {
            $dateError = 'Select a Check-in and Check-out date';
        } elseif ($_POST['start-date'] > $_POST['end-date']) {
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

$totalPrice = $daysDiff * $pricePerDay;

// Calculate total price based on selected dates and room type
// ... (existing logic for price calculation)

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

if(!isset($totalPrice)) {
    $totalPrice=0;
}

// Calculate total price including additional services
$totalPrice = $totalPrice + $additionalPrice;



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["submit-form"]) && isset($_POST["start-date"]) && isset($_POST["end-date"]) && isset($_POST["breakfast"]) && empty($dateError) && empty($dateError2) && empty($dateError3)) {





            $query = "INSERT INTO reservations (user_id, room_id, date_start, date_end, status, date_reservation, breakfast, parkingspot, pet, totalprice) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);

            $stmt->bind_param("iisssssssi", $userId, $roomId, $start_date, $end_date, $status, $date_reservation, $breakfast, $parkingspot, $pet, $totalPrice);

            $userId = $_SESSION["userid"];
            $start_date = $_POST["start-date"];
            $end_date = $_POST["end-date"];
            $status = "new";
            $date_reservation = date('Y-m-d');
            $breakfast = isset($_POST['breakfast']) && $_POST['breakfast'] === 'yes' ? 'yes' : 'no';
            $parkingspot = isset($_POST['parking']) && $_POST['parking'] === 'yes' ? 'yes' : 'no';
            $pet = isset($_POST['pets']) && $_POST['pets'] === 'yes' ? 'yes' : 'no';

            $pricePerDay = isset($cardPrice) ? $cardPrice : 0; // Default price if room type not found
            $startDate = isset($_POST['start-date']) ? strtotime($_POST['start-date']) : time();
            $endDate = isset($_POST['end-date']) ? strtotime($_POST['end-date']) : time();
            $daysDiff = ($endDate - $startDate) / (60 * 60 * 24); // Calculate days difference

            $totalPrice = $daysDiff * $pricePerDay;

            $totalPrice = $totalPrice + $additionalPrice;

            $stmt->execute();
            $stmt->close();
            //$db->close();
        }









}







?>





















<main class="container" style="display: flex; flex-wrap: wrap;">
    

    <h1 class="custom-heading">
        Reservation
    </h1>


    <!-- Card Section -->
    <div class="card-section" style="flex-basis: 50%; margin-right: 20px;">
    

    <?php
    // Fetch room types from the database
    $query = "SELECT DISTINCT room FROM rooms"; // Change the query to fit your database schema
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
            case 'Standard mit Queensize-Bett':
                $imageURL = 'Images/HotelRoom4.jpeg';
                $cardTitle = 'Standard with Queen-size Bed';
                $cardText = 'Enjoy a cozy stay in our standard room with a comfortable queen-size bed for a restful sleep.';
                break;
            case 'Deluxe mit Kingsize-Bett':
                $imageURL = 'Images/HotelRoom2.jpeg';
                $cardTitle = 'Deluxe with King-size Bed';
                $cardText = 'Enjoy elegance and sophistication in our deluxe room, equipped with a spacious king-size bed for a luxurious retreat.';
                break;    
            case 'Deluxe mit Queensize-Bett':
                $imageURL = 'Images/HotelRoom4.jpeg';
                $cardTitle = 'Deluxe with Queen-size Bed';
                $cardText = 'Experience luxury and style in our deluxe room, furnished with a plush queen-size bed for a truly comfortable experience.';
                break;
            case 'Executive Suite':
                $imageURL = 'Images/HotelRoom3.jpeg';
                $cardTitle = 'Executive Suite';
                $cardText = 'A sophisticated space for comfort and productivity, ideal for business travelers seeking refinement.';
                break;
            case 'Premier Suite':
                $imageURL = 'Images/HotelRoom6.jpeg';
                $cardTitle = 'Premier Suite';
                $cardText = 'An exclusive accommodation with premium amenities and an elevated experience for discerning guests.';
                break;

            default:
                $imageURL = 'Images/HotelRoom1.jpeg';
                $cardTitle = 'Standard with King-size Bed';
                $cardText = 'Experience comfort and space in our standard room with a luxurious king-size bed, ideal for a relaxed stay.';
                break;
        }
        

        echo '<div class="card">
                <img src="' . $imageURL . '" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">' . $cardTitle . '</h5>
                    <p class="card-text">' . $cardText . '</p>
                    <form method="get" action="">
                        <p2 class="custom-price">' . $cardPrice . '€ per night</p2>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <input type="hidden" name="room-type" value="' . $type . '">
                    <button type="submit" class="btn btn-primary" name="room-selected">Select room</button>
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

    <!-- Form Section -->
    
    
    <div class="reservation-form" style="flex: 0 0 300px;">
        <form method="post" action="">
            <div class="center-elements">
                <h5 class="card-title">Complete your reservation</h5>
                <br></br>

                <?php
if (isset($_GET['room-selected-btn'])) {
    $selectedRoom = $_GET['room-selected'];
    echo '<div class="text-center">';
    echo '<h3>You selected: ' . $selectedRoom . '</h3>';
    echo '</div>';
}
?>


                <div class="mb-3">
                    <label for="start-date" class="form-label">Check-in</label>
                    <input type="date" class="form-control" id="start-date" name="start-date" value="<?php echo isset($_POST['start-date']) ? $_POST['start-date'] : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="end-date" class="form-label">Check-out</label>
                    <input type="date" class="form-control" id="end-date" name="end-date" value="<?php echo isset($_POST['end-date']) ? $_POST['end-date'] : ''; ?>">
                </div>


                <?php if (!empty($dateError)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $dateError; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($dateError2)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $dateError2; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($dateError3)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $dateError3; ?>
                    </div>
                <?php endif; ?>


                <div class="mb-3">
                    <label for="breakfast" class="form-label">Board option</label>
                    <span class="price-container"><?php echo "(".$breakfastPrice. "€ pro Nacht)"; ?></span>
                    <select class="form-select" id="breakfast" name="breakfast">
                        <option value="yes" <?php echo (isset($_POST['breakfast']) && $_POST['breakfast'] === 'yes') ? 'selected' : ''; ?>>Yes</option>
                        <option value="no" <?php echo (isset($_POST['breakfast']) && $_POST['breakfast'] === 'no') ? 'selected' : ''; ?>>No</option>
                    </select>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="yes" id="pets" name="pets" <?php echo (isset($_POST['pets']) && $_POST['pets'] === 'yes') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="pets">Pets <span class="price-container"><?php echo "(".$petsPrice. "€ per night)"; ?></span></label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="yes" id="parking" name="parking" <?php echo (isset($_POST['parking']) && $_POST['parking'] === 'yes') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="parking">Parking<span class="price-container"><?php echo "(".$parkingPrice. "€ per night)"; ?></span></label>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <!-- Button to calculate price -->
                <button type="submit" class="btn btn-primary" name="calculate-price">Calculate total price</button>


                <!-- Display total price -->
                <?php if (isset($_POST['calculate-price'])) : ?>
                    <div class="total-price">
                        <?php
                        if ((isset($_POST['calculate-price'])) && empty($dateError) && empty($dateError2) && empty($dateError3)) {

                            echo 'total price: ' . number_format($totalPrice, 2) . ' Euro';
                        } else {
                            echo 'total price: ';
                        }
                        ?>








                    </div>
                <?php endif; ?>


                <div class="total-price">
                    <?php
                    if(!isset($_POST['calculate-price'])) {
                        echo'Total:';
                    }
                    ?>
                </div>


                <!-- Button to submit the form -->
                <button type="submit" class="btn btn-primary" name="submit-form">Reservieren</button>
            </div>
        </form>

        <br>
        <br>

        <div class="text-center">
        <a class="btn btn-secondary text-white" href="mybookings.php" role="button">My bookings</a>
        </div>



    </div>

    <br>
    <br>

</main>

<footer>
    <?php include("includes/Footer.php") ?>
</footer>






</html>
