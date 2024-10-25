<?php
session_start();

$timeout_duration = 900;

if (isset($_SESSION['LAST_ACTIVITY'])) {
    $elapsed_time = time() - $_SESSION['LAST_ACTIVITY'];

    if ($elapsed_time > $timeout_duration) {
        // LOG OUT IF EXCEEDS GIVEN TIME
        session_unset(); // UNSET SESSION
        session_destroy();
        header('Location: login.php?session_expired=1');
        exit();
    }
}

$_SESSION['LAST_ACTIVITY'] = time();

if(isset($_SESSION['username'])) { // CHECK IF USER IS LOGGED IN
    header('Location: adminmenu.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://unpkg.com/mvp.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Document</title>
</head>
<body>

    <nav class="navbar custom-navbar sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="assets/logo.png" width="45" height="45" class="d-inline-block align-middle me-2">
            Grab my Garbage
            </a>
            <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav">
            <li nav-item col-6 col-lg-auto>
                <a class="navbar-brand d-flex align-items-center" href="#request">Request Pickup</a>
            </li>
            <li nav-item col-6 col-lg-auto>
                <a class="navbar-brand d-flex align-items-center" href="login.php">Admin Menu</a>
            </li>
        </div>
    </nav>

    <div class = "container">
        <h1>Login</h1>

        <!-- LOGIN FORM -->
        <form action="loginprocess.php" method="post">

        <input type="text" class="form-control" name="username" placeholder="Enter username: " required>
        <input type="password" class="form-control" name="password" placeholder="Enter password: " required>
        <input type="text" class="form-control" name="admincode" placeholder="Enter admin code: " required>
        <input type="submit" value="Login" name="submit">

        <?php
            // ERROR MESSAGE
                if (isset($_GET["error_msgform"])) {
                    $error_msgform = $_GET["error_msgform"];
                    echo "<div class='error-message'>$error_msgform</div>";
                }

                if (isset($_GET['session_expired']) && $_GET['session_expired'] == 1) {
                    echo "<div class='error-message'>Your session has expired. Please log in again.</div>";
                }
    
            ?>

        </form>

        <p>Don't have an account? <a href="register.php">Go register</a></p>

        <form action="index.php" method="post">
            <button type="submit">Redirect to Menu</button>
        </form>
    </div>
</body>
</html>