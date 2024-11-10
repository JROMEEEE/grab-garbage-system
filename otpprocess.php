<?php
include('dbconnect.php');
session_start();

if (!isset($_SESSION['username'])) { // Check if user is logged in
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];

// Get email associated with username
$query = "SELECT email FROM adminacc_detail WHERE username = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$email = $row['email']; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Verification</title>
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
                <a class="navbar-brand d-flex align-items-center" href="accountedit.php">Go Back</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container p-5 w-50 bg-primary mb-5 mt-5 text-white">
    <h1 class="display-2 text-center mb-5">Verification</h1>

    <form action="" method="post">
        <input type="hidden" name="sendotp" value="1">
        <button type="submit" class="btn btn-primary mb-3">Send OTP to Email</button>
    </form>

    <?php
        // OTP SENDING
        if (isset($_POST['sendotp'])) {
            // GENERATE OTP
            $otpcode = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
            $_SESSION['otp'] = $otpcode;

            // SEND OTP TO USER EMAIL
            $subject = "Your OTP for Password Verification";
            $message = "Your OTP for password change verification is: $otpcode\nPlease ignore this email if this was not you.";
            $headers = "From: no-reply@example.com\r\n";

            if (mail($email, $subject, $message, $headers)) {
                echo "<h4 class='lead text-white'>OTP has been sent to your email.</h4>";
            } else {
                echo "<h4 class='lead text-white'>Failed to send OTP. Please try again.</h4>";
            }
        }
    ?>

    
    <form action="" method="post">
        <input type="text" class="form-control mb-3" name="otpcode" placeholder="Enter code:" required>
        <button type="submit" class="btn btn-primary" name="submit">Verify</button>
    </form>

    <?php   
    // ERROR HANDLING FOR OTP
    if (isset($_POST['submit'])) {
        if ($_POST['otpcode'] === $_SESSION['otp']) {
            unset($_SESSION['otp']); // REMOVE OTP
            $_SESSION['otp_verified'] = true; // MARK OTP AS VERIFIED
            header("Location: changepass.php");
            exit;
        } else {
            echo "<h4 class='lead text-white'>Invalid OTP. Please try again.</h4>";
        }
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
