<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

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



