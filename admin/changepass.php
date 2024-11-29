<?php
session_start();
require_once('../dbconnect.php');
require_once('usersession.php');

// CREATE NEW DB INSTANCE AND GET CONNECTION
$db = new Database();
$connection = $db->getConnect();

// CREATE NEW USER SESSION INSTANCE
$userSession = new UserSession($connection);

// CHECK IF USER IS LOGGED IN
$userSession->checkLogin();

$username = $_SESSION['username'];

$query = "SELECT email, adminid FROM adminacc_detail WHERE username = :username";
$stmt = $connection->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$email = $row['email']; 
$adminid = $row['adminid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles.css">
    <title>Change Password</title>
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
                <a class="navbar-brand d-flex align-items-center" href="settings.php">Go Back</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container p-5 bg-primary mb-5 w-75 mt-5 text-white">
    <h1 class="display-2 text-center mb-5">Change Password</h1>
    <h2 class="lead mb-3">Username: <?php echo htmlspecialchars($username); ?></h2>
    <h2 class="lead mb-3">Admin ID: <?php echo htmlspecialchars($adminid); ?></h2>
    <h2 class="lead mb-3">Email: <?php echo htmlspecialchars($email); ?></h2>
    
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
                header("Location: changepass.php?error_msg=Passwords do not match.");
                exit;
            }

            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // UPDATE PASSWORD IN DB
            $query = "UPDATE adminacc_detail SET password = :password WHERE username = :username";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':username', $username);

            if ($stmt->execute()) {
                header("Location: changepass.php?update_msg=Password updated successfully. You can now leave this page.");
            } else {
                header("Location: changepass.php?error_msg=Error updating password.");
            }
        } 
        ?>
    </form>
    
    <?php
    if (isset($_GET['update_msg'])) {
        $update_msg = $_GET['update_msg'];
        echo "<div class='lead update-message'>" . htmlspecialchars($update_msg) . "</div>";
    }

    if (isset($_GET['error_msg'])) {
        $error_msg = $_GET['error_msg'];
        echo "<div class='lead error-message'>" . htmlspecialchars($error_msg) . "</div>";
    }
    ?>   
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>