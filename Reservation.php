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
            margin: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
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
            $dateError3 = 'In diesem Zeitraum liegt bereits eine Reservierung vor';
        } elseif (empty($_POST['start-date']) || empty($_POST['end-date'])) {
            $dateError = 'Bitte wählen Sie sowohl das Startdatum als auch das Enddatum aus.';
        } elseif ($_POST['start-date'] > $_POST['end-date']) {
            $dateError2 = 'Das Startdatum muss vor dem Enddatum liegen.';


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





















<main class="container" style="display: flex;">
    



    <!-- Card Section -->
    <div class="card-section" style="flex: 1; margin-right: 20px;">
    <h1 class="custom-heading">
        Reservieren
    </h1>


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
                $imageURL = 'https://www.betten.at/magazin/wp-content/uploads/kingsize-boxspringbett-galicia-wildeiche.jpg'; // Replace with your image URL
                $cardTitle = 'Standard mit Kingsize-Bett';
                $cardText = 'Erleben Sie Komfort und Raum in unserem Standardzimmer mit einem luxuriösen Kingsize-Bett, ideal für einen entspannten Aufenthalt.';
    
                break;
            case 'Deluxe mit Kingsize-Bett':
                $imageURL = 'https://as1.ftcdn.net/v2/jpg/01/28/70/64/1000_F_128706446_5wlTHAPqyYdnoyP5BVtMACk6sT0N56Y1.jpg';
                $cardTitle = 'Deluxe mit Kingsize-Bett';
                $cardText = 'Genießen Sie Eleganz und Raffinesse in unserem Deluxe-Zimmer, ausgestattet mit einem geräumigen Kingsize-Bett für einen luxuriösen Rückzugsort.';
    
                break;
    
            case 'Standard mit Queensize-Bett':
                $imageURL = 'https://www.atlantic-hotels.de/fileadmin/AHS/Zimmer/Kategorie_2/atlantic-hotel-sail-city-bremerhaven-zimmer-comfort-queensize-zimmer.jpg'; // Replace with your image URL
                $cardTitle = 'Standard mit Queensize-Bett';
                $cardText = 'Genießen Sie einen gemütlichen Aufenthalt in unserem Standardzimmer mit einem bequemen Queensize-Bett für eine erholsame Ruhe.';
    
                break;
            case 'Deluxe mit Queensize-Bett':
                $imageURL = 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/496645457.jpg?k=540cc876a71dbafea8722ef2ec999bb54614bf875a315f6655028e39ff23c0b2&o=&hp=1'; // Replace with your image URL
                $cardTitle = 'Deluxe mit Queensize-Bett';
                $cardText = 'Erleben Sie Luxus und Stil in unserem Deluxe-Zimmer, das mit einem flauschigen Queensize-Bett für ein wirklich komfortables Erlebnis ausgestattet ist.';
    
                break;
            case 'Executive Suite':
                $imageURL = 'https://www.raffel.at/wp-content/uploads/Raffel-Zimmer-Landhaus-2021-109.jpg'; // Replace with your image URL
                $cardTitle = 'Executive Suite';
                $cardText = 'Ein anspruchsvoller Raum für Komfort und Produktivität, ideal für Geschäftsreisende, die nach Raffinesse suchen.';
    
                break;
            case 'Premier Suite':
                $imageURL = 'https://www.dilly.at/images/content/99550_11664_1_C_2500_992_2175_1884801/mk-03582.jpg'; // Replace with your image URL
                $cardTitle = 'Premier Suite';
                $cardText = 'Eine exklusive Unterkunft mit Premium-Annehmlichkeiten und einem gehobenen Erlebnis für anspruchsvolle Gäste.';
    
                break;
            case 'Signature Suite':
                $imageURL = 'https://storage.kempinski.com/cdn-cgi/image/w=1920,f=auto,g=auto,fit=scale-down/ki-cms-prod/images/8/6/5/7/197568-1-eng-GB/0a74f06e09c7-73661321_4K.jpg'; // Replace with your image URL
                $cardTitle = 'Signature Suite';
                $cardText = 'Eine unverwechselbare und individuell gestaltete Suite, die einzigartige Designelemente und luxuriöse Akzente präsentiert.';
    
                break;
            case 'Deluxe Suite':
                $imageURL = 'https://www.dasgerstl.com/fileadmin/_processed_/5/0/csm_2020_Loft_Suite_Bad_und_Wohnbereich_c9865dc9f5.jpg'; // Replace with your image URL
                $cardTitle = 'Deluxe Suite';
                $cardText = 'Eine geräumige und komfortable Suite, die einen luxuriösen Aufenthalt mit erweiterten Annehmlichkeiten und Stil bietet.';
    
                break;
            default:
                $imageURL = 'https://www.betten.at/magazin/wp-content/uploads/kingsize-boxspringbett-galicia-wildeiche.jpg'; // Replace with your image URL
                $cardTitle = 'Standard mit Kingsize-Bett';
                $cardText = 'Erleben Sie Komfort und Raum in unserem Standardzimmer mit einem luxuriösen Kingsize-Bett, ideal für einen entspannten Aufenthalt.';
    
                break;
        }

        echo '<div class="card">
                <img src="' . $imageURL . '" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">' . $cardTitle . '</h5>
                    <p class="card-text">' . $cardText . '</p>
                    <form method="get" action="">
                        <input type="hidden" name="room-type" value="' . $type . '">
                        <button type="submit" class="btn btn-primary" name="room-selected">Zimmer auswählen</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p2 class="custom-price">' . $cardPrice . '€ pro Nacht</p2>
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
                <div class="mb-3">
                    <label for="start-date" class="form-label">Startdatum</label>
                    <input type="date" class="form-control" id="start-date" name="start-date" value="<?php echo isset($_POST['start-date']) ? $_POST['start-date'] : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="end-date" class="form-label">Enddatum</label>
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
                    <label for="breakfast" class="form-label">Frühstückspension</label>
                    <span class="price-container"><?php echo "(".$breakfastPrice. "€ pro Nacht)"; ?></span>
                    <select class="form-select" id="breakfast" name="breakfast">
                        <option value="yes" <?php echo (isset($_POST['breakfast']) && $_POST['breakfast'] === 'yes') ? 'selected' : ''; ?>>Ja</option>
                        <option value="no" <?php echo (isset($_POST['breakfast']) && $_POST['breakfast'] === 'no') ? 'selected' : ''; ?>>Nein</option>
                    </select>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="yes" id="pets" name="pets" <?php echo (isset($_POST['pets']) && $_POST['pets'] === 'yes') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="pets">Haustiere <span class="price-container"><?php echo "(".$petsPrice. "€ pro Nacht)"; ?></span></label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="yes" id="parking" name="parking" <?php echo (isset($_POST['parking']) && $_POST['parking'] === 'yes') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="parking">Parkplatzreservierung <span class="price-container"><?php echo "(".$parkingPrice. "€ pro Nacht)"; ?></span></label>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <!-- Button to calculate price -->
                <button type="submit" class="btn btn-primary" name="calculate-price">Preis berechnen</button>


                <!-- Display total price -->
                <?php if (isset($_POST['calculate-price'])) : ?>
                    <div class="total-price">
                        <?php
                        if ((isset($_POST['calculate-price'])) && empty($dateError) && empty($dateError2) && empty($dateError3)) {

                            echo 'Gesamtpreis: ' . number_format($totalPrice, 2) . ' Euro';
                        } else {
                            echo 'Gesamtpreis: ';
                        }
                        ?>








                    </div>
                <?php endif; ?>


                <div class="total-price">
                    <?php
                    if(!isset($_POST['calculate-price'])) {
                        echo'Gesamtpreis:';
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
        <a class="btn btn-secondary text-white" href="mybookings.php" role="button">Meine Buchungen</a>
        </div>



    </div>

    <br>
    <br>

</main>

<footer>
    <?php include("includes/Footer.php") ?>
</footer>






</html>
