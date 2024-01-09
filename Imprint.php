<!DOCTYPE html>
<html lang="en">
<head>
<title>Imprint</title>
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
            border: 1px solid #333;
            background-color: #eee;
        }
        body {
            background-color: #eee; /* Dunkle Hintergrundfarbe (z.B., #333 für Schwarz) */
            color: #333; /* Weiße Textfarbe für den Kontrast */
        }
    </style>
</head>


<body>

<?php include("includes/navbar.php")?>


<div class="container mt-5">
        <h1 class="text-center">Imprint</h1>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <p>
                    <strong>Hotel Zadar</strong><br>
                    Hochstädtlplatz 29<br>
                    A-1200 Wien
                </p>
                <p>
                    <strong>Contact:</strong><br>
                    Phone: +49 123 456789<br>
                    E-Mail: info@zadarhotel.at
                </p>
                <p>
                <strong>Commercial Register:</strong><br>
                    Court of Registration: Zadar<br>
                    Registration Number: 75235
                </p>
                <p>
                    <strong>Competent Supervisory Authority:</strong><br>
                    Zadar Tourism Office
                </p>
                <p>
                    <strong>Disclaimer:</strong><br>
                    We do not assume liability for the content of external links. The operators of the linked pages are solely responsible for their content.
                </p>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="ceo-card">
                            <img src="Images/CEO1.jpg" class="circle-image img-fluid" alt="CEO 1">
                            <h5 class="mt-3">Marcel Ivanić</h5>
                            <p>CEO</p>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ceo-card">
                            <img src="Images/CEO2.jpg" class="circle-image img-fluid" alt="CEO 2">
                            <h5 class="mt-3">Marco Hudec</h5>
                            <p>CEO</p>
                            
                        </div>
                    </div>
                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/footer.php")?>

    <?php include("includes/scripts.php")?>
</body>

</html>