<?php
session_start();
if(isset($_SESSION['username'])) { // CHECK IF USER IS LOGGED IN
    header('Location: adminmenu.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/mvp.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Document</title>
</head>
<body>
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
            ?>

        </form>

        <p>Don't have an account? <a href="register.php">Go register</a></p>

        <form action="index.html" method="post">
            <button type="submit">Redirect to Menu</button>
        </form>
    </div>
    <form action="adminmenu.php" method="post">
            <button type="submit">Go to Admin Menu</button>
        </form>
</body>
</html>