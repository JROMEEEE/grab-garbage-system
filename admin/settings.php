<?php
session_start();
require_once('../dbconnect.php');
require_once('usersession.php');

// CREATE NEW DB INSTANCE AND GET CONNECTION
$db = new Database();
$connection = $db->getConnect();

// CREATE NEW USERSESSION INSTANCE
$userSession = new UserSession($connection);

// CHECK IF USER IS LOGGED IN
$userSession->checkLogin();

// GET USERNAME FROM SESSION
$username = $_SESSION['username']; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles.css">
    <title>Account Settings</title>
</head>
<body>
<nav class="navbar custom-navbar sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="../assets/logo.png" width="45" height="45" class="d-inline-block align-middle me-2">
            Grab my Garbage
        </a>
        <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav">
            <li class="nav-item col-6 col-lg-auto">
                <a class="navbar-brand d-flex align-items-center" href="adminmenu.php">Go Back</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container p-5 bg-primary mb-5 w-75 mt-5">
    <h1 class="display-3 text-center text-white mb-5">Account Settings</h1>

    <?php
    // Now using the username from the session
    $query = 'SELECT username, email, adminid FROM adminacc_detail WHERE username = :username';
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<p class="lead text-white">Admin ID: ' . htmlspecialchars($row['adminid']) . '</p>';
        echo '<p class="lead text-white">Username: ' . htmlspecialchars($row['username']) . '</p>';
        echo '<p class="lead text-white">Email: ' . htmlspecialchars($row['email']) . '</p>';
    } else {
        echo '<p class="text-white text-center">No account details found for this user.</p>';
    }
    ?>

    <?php
    if (isset($_GET['error_msg'])) {
        $error_msg = $_GET['error_msg'];
        echo "<div class='lead error-message mb-3'>" . htmlspecialchars($error_msg) . "</div>";
    }

    if (isset($_GET['update_msg'])) {
        $update_msg = $_GET['update_msg'];
        echo "<div class ='lead update-message mb-3'>" . htmlspecialchars($update_msg) . "</div>";
    }
    ?>
    
    <!-- LOGOUT OF SESSION -->
    <form action="logout.php" method="post">
        <button class="btn btn-danger me-md-2 mt-3" type="submit">Logout</button>
    </form>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary me-md-2" type="button" href="updateusername.php">Change username</a>
        <a class="btn btn-primary me-md-2" type="button" href="sendotp.php">Change password</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>