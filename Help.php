<!DOCTYPE html>
<html lang="en">

<head>
    <title>Help Page</title>
    <?php include("includes/head.php")?>
    <style>
        body {
            /* CSS style for the body element */
            background-color: #eee; 
            color: #333; 
        }
    </style>
</head>

<body>
    <?php include("includes/navbar.php")?>

    <!-- Header section with title -->
    <header class=" text-black text-center py-4">
        <h1>Help-Page</h1>
    </header>

    <!-- Container for the FAQ section -->
    <div class="container my-4">
        <h2>Frequently Asked Questions</h2>
        <div class="accordion" id="faqAccordion">

            <!-- Accordion items for each question -->
            <!-- Each item has a question as a header and an answer in the body -->

            <!-- Example of an accordion item -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="false" aria-controls="faqCollapse1">
                        How do I sign in?
                    </button>
                </h2>
                <div id="faqCollapse1" class="accordion-collapse collapse" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        To sign in, click the "Sign In" button on top right and enter your login information.
                    </div>
                </div>
            </div>

            <!-- Additional accordion items... -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading2">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                        How do I change my password?
                    </button>
                </h2>
                <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        You can change your password by going into your profile and accessing the settings.
                    </div>
                </div>
            </div>


            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading3">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                        How can I change my data?
                    </button>
                </h2>
                <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Click on the Profile button at the top right. There you can access and edit your profile if you are logged in.
                    </div>
                </div>
            </div>


            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading4">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                        I forgot my password.
                    </button>
                </h2>
                <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Please contact the hotel staff on site.
                    </div>
                </div>
            </div>


            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading5">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                        Where can I find details about the hotel staff?
                    </button>
                </h2>
                <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Details about the hotel staff can be found in <a href="imprint.php">the imprint.</a>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading6">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse6" aria-expanded="false" aria-controls="faqCollapse6">
                        Where can I register?
                    </button>
                </h2>
                <div id="faqCollapse6" class="accordion-collapse collapse" aria-labelledby="faqHeading6" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Click on the Register Button at the top right. There you can create your Account.
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
<?php include("includes/footer.php")?>
<?php include("includes/scripts.php")?>
</html>