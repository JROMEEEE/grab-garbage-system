<?php
    session_start();
    include('dbconnect.php');

    if(!isset($_SESSION['username'])) { // CHECK IF USER IS LOGGED IN
        header('Location: login.php');
    }
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
                <a class="navbar-brand d-flex align-items-center" href="adminmenu.php">Go Back</a>
            </li>
        </div>
    </nav>

    <div class="container p-5 bg-primary mb-5 w-75 mt-5">
        <h1 class="display-3 text-center text-white mb-5">Account Settings</h1>

        <?php
            $username = $_SESSION['username'];
            $query = 'SELECT username, email, adminid FROM `adminacc_detail` WHERE username = ?';
        
            if ($stmt = mysqli_prepare($connection, $query)) {
                mysqli_stmt_bind_param($stmt, 's', $username);
                mysqli_stmt_execute($stmt);
        
                $result = mysqli_stmt_get_result($stmt);
        
                if ($row = mysqli_fetch_assoc($result)) {
                    echo '<p class="lead text-white">Admin ID: ' . $row['adminid'] . '</p>';
                    echo '<p class="lead text-white">Username: ' . $row['username'] . '</p>';
                    echo '<p class="lead text-white">Email: ' .$row['email'].'</p>';
                } else {
                    echo '<p class="text-white text-center">No account details found for this user.</p>';
                }
            } else {
                    echo '<p class="text-white text-center">Error preparing the query.</p>';
                }
        ?>
        <!-- LOGOUT OF SESSION -->
        <form action="logout.php" method="post">
            <button class="btn btn-danger me-md-2 mt-3" type="submit">Logout</button>
        </form>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-primary me-md-2" type="button">Change username</button>
            <button class="btn btn-primary" type="button">Change password</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>