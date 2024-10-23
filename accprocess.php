<?php
    include('dbconnect.php');

    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $repeat_password = $_POST["repeat_password"];

    $passwordhash = password_hash($password, PASSWORD_DEFAULT);

    if (isset($_POST["submit"])) {
        // PASSWORDS MUST MATCH
        if ($password !== $repeat_password) {
            header('Location: register.php?error_msgform=Passwords do not match.');
            exit;
        }

        // CHECK USERNAME DOES NOT CONTAIN WHITESPACES
        if (strpos($username, ' ') !== false) {
            header('Location: register.php?error=Username cannot contain spaces.');
            exit;
        }

        $query = "SELECT * FROM adminacc_detail WHERE username = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 's', $username); // PREVENT SQL INJECTION BY BINDING PARAMETERS
        mysqli_stmt_execute($stmt); // EXECUTE BINDED STATEMENT
        mysqli_stmt_store_result($stmt); // STORE RESULT OF STATEMENT

        // CHECK USERNAME IF IT EXISTS
        if (mysqli_stmt_num_rows($stmt) > 0) { // CHECK IF ROWS RETURNED ARE GREATER THAN 0
            header('Location: register.php?error_msgform=Username already exists please choose another one.');
            exit;
        }
    
        // VALIDATE EMAIL
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: register.php?error_msgform=Invalid email address.');
            exit;
        }
    
        // CHECK PASS LENGTH
        if (strlen($password) < 8) {
            header('Location: register.php?error_msgform=Password must be at least 8 characters long.');
            exit;
        }
    
        // GENERATE ADMIN CODE USE SUBSTR TO SELECT PART OF GIVEN STRING AND STR SHUFFLE TO RANDOMIZE FROM POINT 0 TO POINT 6
        $admin_code = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);

        $query = "INSERT INTO adminacc_detail (username, password, email, admincode) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'ssss', $username, $passwordhash, $email, $admin_code);
        $result = mysqli_stmt_execute($stmt);

        if(!$result){
            die("Query failed: ".mysqli_error($connection));
        } else {
            // EMAIL CONTENT
            $to = "grabmygarbageproj@gmail.com";
            $subject = "New Admin Account Register Request";
            $message = "A new admin account has been registered.\n\n";
            // "." CONCAT ALL VARIABLES
            $message .= "Username: $username\n";
            $message .= "Email: $email\n";
            $message .= "Admin Code: $admin_code\n";
        
            // EMAIL HEADER
            $headers = "From: no-reply@yourdomain.com\r\n";
            $headers .= "Reply-To: $email\r\n";
        
            // SEND EMAIL
            if (mail($to, $subject, $message, $headers)) {
                header('Location: register.php?update_msgform=Account Registered! Please wait for admin approval.');;
            } else {
                echo 'Location: register.php?error_msgform=Unexpected Error. Please try again.';
            }
        }
    }
?>