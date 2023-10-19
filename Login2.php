<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>





    <div class="header">

        <header class="primary-header">
            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid">
                  <a class="navbar-brand" href="#">
                    <img src="/Images/Logo2.png" alt="Logo" width="60" height="50" class="d-inline-block align-text-top">
                    Hotel Zack and Cody
                  </a>
                </div>
              </nav>
        </header> <span class="downarrow">
            <a href="#welcome" tabindex="0">
                <i class="fa-solid fa-chevron-down fa-beat fa-2x" style="--fa-animation-duration: 2.5s;"></i>
            </a>
        </span>
    </div>







    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Login</h2>
                        <form>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter your username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password"
                                    placeholder="Enter your password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" bis_skin_checked="1">
        <footer class="footer fixed-bottom py-3 my-4">
          <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Gallery</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Impressum</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Help</a></li>
          </ul>
          <p class="text-center text-muted">© 2023 Hotel Zack and Cody, Inc</p>
        </footer>
      </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>