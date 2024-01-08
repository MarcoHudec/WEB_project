<footer class="text-center text-white" style="background-color: #3f51b5">
   
    <div class="container">
     
      <section class="mt-2">
       
        <div class="row text-center d-flex justify-content-center pt-3">
         
          <div class="col-md-2">
            <h6 class="text-uppercase font-weight-bold">
              <a href="index.php" class="text-white nav-link">Home</a>
            </h6>
          </div>
          
          <div class="col-md-2">
            <h6 class="text-uppercase font-weight-bold">
              <a href="Reservation.php" class="text-white nav-link">Reservation</a>
            </h6>
          </div>
          
          <div class="col-md-2">
            <h6 class="text-uppercase font-weight-bold">
              <a href="Imprint.php" class="text-white nav-link">Imprint</a>
            </h6>
          </div>
          
          <div class="col-md-2">
            <h6 class="text-uppercase font-weight-bold">
              <a href="Help.php" class="text-white nav-link">FAQ</a>
            </h6>
          </div>

        </div>
      </section>

      <hr class="my-2 nav-link" />

    </div>

    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
         © 2023 Hotel Zadar, Inc
    </div>
    
  </footer>

  <script>
  // JavaScript, um die Navbar beim Scrollen zu ändern
  window.addEventListener("scroll", function() {
    var navbar = document.querySelector(".navbar");
    if (window.scrollY > 10) {
      navbar.classList.remove("transparent-navbar");
      navbar.style.background = "#3f51b5"; // Hintergrundfarbe ändern
    } else {
      navbar.classList.add("transparent-navbar");
      navbar.style.background = "transparent"; // Zurück zur transparenten Farbe
    }
  });
</script>
  