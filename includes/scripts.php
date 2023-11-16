<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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



