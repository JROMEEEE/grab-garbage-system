<?php
    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $repeat_password = $_POST["repeat_password"];
    
        // PASSWORDS MUST MATCH
        if ($password !== $repeat_password) {
            header('Location: register.php?error_msgform=Passwords do not match.');
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
    
        // EMAIL CONTENT
        $to = "grabmygarbageproj@gmail.com";
        $subject = "New Admin Account Register Request";
        $message = "A new admin account has been registered.\n\n";
        // "." concatinates variables
        $message .= "Username: $username\n";
        $message .= "Email: $email\n";
        $message .= "Admin Code: $admin_code\n";
    
        // Email headers
        $headers = "From: no-reply@yourdomain.com\r\n";
        $headers .= "Reply-To: $email\r\n";
    
        // Send the email
        if (mail($to, $subject, $message, $headers)) {
            header('Location: register.php?update_msgform=Request Sent!');;
        } else {
            echo 'Location: register.php?error_msgform=Unexpected Error. Please try again.';
        }
    
    }
?>