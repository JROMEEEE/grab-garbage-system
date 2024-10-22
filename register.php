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
    <div class="container">
        <?php
            // print_r($_POST);
            if (isset($_POST["submit"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];
                $email = $_POST["email"];
                $repeat_password = $_POST["repeat_password"];
              
                if ($password !== $repeat_password) {
                  header('Location: register.php?error_msgform=Invalid Input! Passwords do not match.');
                  exit;
                }
              }
        ?>
        <h1>Register Admin Account</h1>
        <form action="" method = "post">
            <!-- USERNAME -->
            <input type="text" class="form-control" name="username" placeholder="Enter new username: " required>
            <!-- EMAIL -->
            <input type="text" class="form-control" name="email" placeholder="Enter email: " required>
            <!-- PASSWORD -->
            <input type="password" class="form-control" name="password" placeholder="Enter new password: " required>
            <input type="password" class="form-control" name="repeat_password" placeholder="Repeat new password: " required>
            <!-- ADMIN CODE FOR VERIFICATION -->
            <!-- <input type="text" class="form-control" name="admincode" placeholder="Enter given admin code: "> -->
            <?php
                if (isset($_GET["error_msgform"])) {
                    $error_msgform = $_GET["error_msgform"];
                    echo "<div class='error-message'>$error_msgform</div>";
                }
            ?>
            <br>
            <input type="submit" value="Register" name="submit">    
        </form>
        
        <p>Do you have an account? <a href="login.php">Go login</a></p>
    
    <form action="index.html" method="post">
            <button type="submit">Redirect to Menu</button>
        </form>
</div>
</body>
</html>