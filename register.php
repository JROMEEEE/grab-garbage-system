<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://unpkg.com/mvp.css">  -->
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

    <div class="container">
        <?php
        //     // print_r($_POST);
        //     if (isset($_POST["submit"])) {
        //         $username = $_POST["username"];
        //         $password = $_POST["password"];
        //         $email = $_POST["email"];
        //         $repeat_password = $_POST["repeat_password"];

        //         if (strlen($password) < 8) {
        //             header('Location: register.php?error_msgform=Invalid Input! Password must be at least 8 characters long.');
        //             exit;
        //         }
                
        //         // CHECK IF PASSWORDS MATCH
        //         if ($password !== $repeat_password) {
        //           header('Location: register.php?error_msgform=Invalid Input! Passwords do not match.');
        //           exit;
        //         }

        //         // CHECK IF EMAIL IS VALID
        //         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //             header('Location: register.php?error_msgform=Invalid Input! Please enter a valid email address.');
        //             exit;
        //         }
        //     }
        // ?>
        <h1>Register Admin Account</h1>
        <form action="accprocess.php" method = "post">
            <!-- USERNAME -->
            <input type="text" class="form-control" name="username" placeholder="Enter new username: " required>
            <!-- EMAIL -->
            <input type="text" class="form-control" name="email" placeholder="Enter email: " required>
            <!-- PASSWORD -->
            <input type="password" class="form-control" name="password" placeholder="Enter new password: " required>
            <input type="password" class="form-control" name="repeat_password" placeholder="Repeat new password: " required>

            <?php
            // UPDATE MESSAGE
                if(isset($_GET['update_msgform'])){
                    echo "<h4>".$_GET['update_msgform']."</h4>";
                    echo "<h4>Click <a href='login.php'>here</a> to login.</h4>";
                }
            ?>

            <?php
            // ERROR MESSAGE
                if (isset($_GET["error_msgform"])) {
                    $error_msgform = $_GET["error_msgform"];
                    echo "<div class='error-message'>$error_msgform</div>";
                }
            ?>
            <br>
            <input type="submit" value="Register" name="submit">    
        </form>
        
        <p>Do you have an account? <a href="login.php">Go login</a></p>
    
    <form action="index.php" method="post">
            <button type="submit">Redirect to Menu</button>
        </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>