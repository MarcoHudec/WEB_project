<!DOCTYPE html>
<html lang="en">
<head>
<title>Impressum</title>
    <?php include("includes/head.php")?>
    <style>
        .circle-image {
            border-radius: 50%;
            max-width: 100%;
            max-height: 200px;
            height: auto;
        }
        .ceo-card {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ccc;
        }
        body {
            background-color: #f5f5f5; /* Dunkle Hintergrundfarbe (z.B., #333 für Schwarz) */
            color: #333; /* Weiße Textfarbe für den Kontrast */
        }
    </style>
</head>


<body>

<?php include("includes/Navbar.php")?>


<div class="container mt-5">
        <h1 class="text-center">Impressum</h1>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <p>
                    <strong>Hotel Zadar</strong><br>
                    Hochstädtlplatz 29<br>
                    A-1200 Wien
                </p>
                <p>
                    <strong>Contact:</strong><br>
                    Telefon: +49 123 456789<br>
                    E-Mail: info@zadarhotel.hr
                </p>
                <p>
                    <strong>Handelsregister:</strong><br>
                    Registergericht: Zadar<br>
                    Registernummer: 75235
                </p>
                <p>
                    <strong>Zuständige Aufsichtsbehörde:</strong><br>
                    Zadar Tourismusamt
                </p>
                <p>
                    <strong>Haftungsausschluss:</strong><br>
                    Wir übernehmen keine Haftung für die Inhalte externer Links. Für den Inhalt der verlinkten Seiten sind ausschließlich deren Betreiber verantwortlich.
                </p>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="ceo-card">
                            <img src="Images/CEO1.jpg" class="circle-image img-fluid" alt="CEO 1">
                            <h5 class="mt-3">Marcel Ivanić</h5>
                            <p>Geschäftsführer</p>
                            <p>Der Boss.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ceo-card">
                            <img src="Images/CEO2.jpg" class="circle-image img-fluid" alt="CEO 2">
                            <h5 class="mt-3">Marco Hudec</h5>
                            <p>Geschäftsführer</p>
                            <p>Der Andere.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/Footer.php")?>

    <?php include("includes/scripts.php")?>
</body>

</html>