<?php
    include('dbconnect.php');
    session_start();

    if(!isset($_SESSION['username'])) { // CHECK IF USER IS LOGGED IN
        header('Location: login.php');
    }

    // VERIFY IF OTP IS COMPLETE
    if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
        header('Location: otpprocess.php'); // Redirect to OTP verification page
        exit;
    }

    $username = $_SESSION['username'];
    $adminid = $_SESSION['adminid'];
    
    //GET EMAIL THAT IS ASSOC W/ USERNAME
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
                <a class="navbar-brand d-flex align-items-center" href="accountedit.php">Go Back</a>
            </li>
        </div>
    </nav>

    <div class="container p-5 bg-primary mb-5 w-75 mt-5 text-white">
        <h1 class="display-2 text-center mb-5">Change Password</h1>
        <h2 class="lead mb-3">Username: <?php echo $username; ?></h2>
        <h2 class="lead mb-3">Admin ID: <?php echo $adminid; ?></h2>
        <h2 class="lead mb-3">Email: <?php echo $email; ?></h2>
        <form action="" method="post">
            <input type="password" class="form-control mb-3" name="newpassword" placeholder="Enter new password: " required>
            <input type="password" class="form-control mb-3" name="confirmpassword" placeholder="Confirm new password: " required>
            <input type="submit" class="btn btn-primary" value="Change Password" name="submit">

            <?php
                if (isset($_POST['submit'])) {
                    
                    $new_password = $_POST['newpassword'];
                    $confirm_password = $_POST['confirmpassword'];
                    $username = $_SESSION['username'];
                
                    // CHECK IF PASSWORD IS MATCHING
                    if ($new_password !== $confirm_password) {
                        header("Location: changepass.php.php?error_msg=Passwords do not match.");
                        exit;
                    }
                
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                    //UPDATE PASS AT DB
                    $query = "UPDATE adminacc_detail SET password = ? WHERE username = ?";
                    $stmt = mysqli_prepare($connection, $query);
                    mysqli_stmt_bind_param($stmt, 'ss', $hashed_password, $username);
                
                    if (mysqli_stmt_execute($stmt)) {
                        header("Location: changepass.php?update_msg=Password updated successfully You can now leave this page.");
                    } else {
                        header("Location: changepass.php?error_msg=Error updating password.");
                    }
                
                    mysqli_stmt_close($stmt);
                    mysqli_close($connection);
                } 
            ?>
        </form>
        <?php
            if (isset($_GET['update_msg'])) {
                $update_msg = $_GET['update_msg'];
                echo "<div class='lead update-message'>$update_msg</div>";
            }

            if (isset($_GET['error_msg'])) {
                $error_msg = $_GET['error_msg'];
                echo "<div class='lead error-message'>$error_msg</div>";
            }
        ?>   
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>     