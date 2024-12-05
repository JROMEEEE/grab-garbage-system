<?php
session_start();
require_once('../dbconnect.php');

$timeout_duration = 900;

if (isset($_SESSION['LAST_ACTIVITY'])) {
    $elapsed_time = time() - $_SESSION['LAST_ACTIVITY'];

    if ($elapsed_time > $timeout_duration) {
        session_unset(); // UNSET SESSION
        session_destroy();
        header('Location: login.php?session_expired=1');
        exit();
    }
}

$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_SESSION['username'])) { // CHECK IF USER IS LOGGED IN
    header('Location: adminmenu.php');
    exit;
}

$db = new Database();
$connection = $db->getConnect();

if (isset($_POST['submit'])) {
    // GET DETAILS
    $username = $_POST['username'];
    $password = $_POST['password'];
    $admincode = $_POST['admincode'];

    // CHECK IF CREDS ARE CORRECT
    $sqlquery = "SELECT * FROM adminacc_detail WHERE username = :username AND admincode = :admincode";
    $stmt = $connection->prepare($sqlquery);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':admincode', $admincode);
    
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $hashed_password = $user['password'];

        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['admincode'] = $user['admincode'];
            $_SESSION['adminid'] = $user['adminid'];
            header('Location: adminmenu.php');
            exit;
        } else {
            header('Location: login.php?error_msgform=Invalid details, please try again.');
            exit;
        }
    } else {
        header('Location: login.php?error_msgform=Invalid details, please try again.');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles.css">
    <title>Login</title>
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
    <h1 class="display-2 text-center mb-5">Login</h1>

    <!-- LOGIN FORM -->
    <form action="" method="post">
        <input type="text" class="form-control mb-3" name="username" placeholder="Enter username:" required>
        <input type="password" class="form-control mb-3" name="password" placeholder="Enter password:" required>
        <input type="text" class="form-control mb-3" name="admincode" placeholder="Enter admin code:" required>
        <input type="submit" class="btn btn-primary" value="Login" name="submit">

        <?php
        if (isset($_GET["error_msgform"])) {
            echo "<div class='lead error-message mb-3'>{$_GET["error_msgform"]}</div>";
        }

        if (isset($_GET['session_expired']) && $_GET['session_expired'] == 1) {
            echo "<div class='lead error-message mb-3'>Your session has expired. Please log in again.</div>";
        }
        ?>
    </form>

    <div class="container text-center mt-3">
        <p class="lead">Don't have an account? <a href="register.php">Go register</a></p>
    </div>

    <form action="../index.php" method="post">
        <div class="container text-center mt-4">
            <button type="submit" class="btn btn-primary">Redirect to Menu</button>
        </div>
    </form>
</div>
</body>
</html>