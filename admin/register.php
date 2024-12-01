<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles.css">
    <title>Document</title>
</head>
<body>

<nav class="shadow navbar custom-navbar sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="../index.php">
                <img src="../assets/logo.png" width="45" height="45" class="d-inline-block align-middle me-2">
                Grab my Garbage
            </a>
            <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav">
                <li class="nav-item col-6 col-lg-auto">
                    <a class="navbar-brand d-flex align-items-center" href="../index.php#request">Request Pickup</a>
                </li>
                <li class="nav-item col-6 col-lg-auto">
                    <a class="navbar-brand d-flex align-items-center" href="login.php">Volunteer Menu</a>
                </li>
            </ul>
        </div>
</nav>

    <div class="container p-5 w-50">
            <h1 class="display-4 text-center mb-4">Register Volunteer Account</h1>
            <p class="lead mb-2">Volunteer registration guidelines:</p>
            <ul>
            <li class="lead mb-2">To become a volunteer please enter your details below.</li>
            <li class="lead mb-2">We will be notified of your registration, please wait for confirmation within 1-2 business days.</li>
            <li class="lead mb-2">Any concerns please contact us at grabgarbageproj@gmail.com</li>
            </ul>

        <p class="lead"></p>
        <form action="accprocess.php" method = "post">
            <!-- USERNAME -->
            <input type="text" class="form-control mb-3" name="username" placeholder="Enter new username: " required>
            <!-- EMAIL -->
            <input type="text" class="form-control mb-3" name="email" placeholder="Enter email: " required>
            <!-- PASSWORD -->
            <input type="password" class="form-control" name="password" placeholder="Enter new password: " required aria-describedby="helppassword">
            <div id="helppassword" class="mb-3">
                    <small>Password must be at least 8 characters long.</small>
                  </div> 
            <input type="password" class="form-control mb-3" name="repeat_password" placeholder="Repeat new password: " required>

            <?php
            // UPDATE MESSAGE
                if(isset($_GET['update_msgform'])){
                    echo "<h4 class = 'lead'>".$_GET['update_msgform']."</h4>";
                    echo "<h4 class = 'lead'>Click <a href='login.php'>here</a> to login.</h4>";
                }
            ?>

            <?php
            // ERROR MESSAGE
                if (isset($_GET["error_msgform"])) {
                    $error_msgform = $_GET["error_msgform"];
                    echo "<div class='lead error-message'>$error_msgform</div>";
                }
            ?>
            <br>
            <input type="submit" class="btn btn-primary" value="Register" name="submit">    
        </form>
        
        <div class="container text-center mt-3">
        <p class="lead">Do you have an account? <a href="login.php">Go login</a></p>
        </div>
    
        <form action="../index.php" method="post">
            <div class="container text-center mt-4">
                <button type="submit" class="btn btn-primary">Redirect to Menu</button>
            </div>
        </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>