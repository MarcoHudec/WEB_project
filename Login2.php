<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Page</title>
    <?php include("includes/head.php")?>
</head>

<body>





    <?php include("includes/Navbar.php")?>







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
                            <input type="password" class="form-control" id="password" placeholder="Enter your password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php include("includes/Footer.php")?>

    <?php include("includes/scripts.php")?>
</body>

</html>