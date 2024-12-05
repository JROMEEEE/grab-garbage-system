<?php
require_once('../dbconnect.php');

$db = new Database();
$connection = $db->getConnect();

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

    // GET DB TO CHECK IF USERNAME EXISTS
    $query = "SELECT * FROM adminacc_detail WHERE username = :username";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // IF ROW < 0 THEN USERNAME DOES NOT EXIST
    if ($stmt->rowCount() > 0) { // CHECK IF ROWS RETURNED ARE GREATER THAN 0
        header('Location: register.php?error_msgform=Username already exists please choose another one.');
        exit;
    }

    // VALIDATE EMAIL
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: register.php?error_msgform=Invalid email address.');
        exit;
    }

    // CHECK PASSWORD LENGTH
    if (strlen($password) < 8) {
        header('Location: register.php?error_msgform=Password must be at least 8 characters long.');
        exit;
    }

    // GENERATE ADMIN CODE
    $admin_code = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);

    // INSERT NEW USER
    $query = "INSERT INTO adminacc_detail (username, password, email, admincode) VALUES (:username, :password, :email, :admincode)";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $passwordhash);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':admincode', $admin_code);
    
    $result = $stmt->execute();

    if (!$result) {
        die("Query failed: " . implode(", ", $stmt->errorInfo()));
    } else {
        // EMAIL CONTENT
        $to = "grabmygarbageproj@gmail.com";
        $subject = "New Admin Account Register Request";
        $message = "A new admin account has been registered.\n\n";
        $message .= "Username: $username\n";
        $message .= "Email: $email\n";
        $message .= "Admin Code: $admin_code\n";

        // EMAIL HEADER
        $headers = "From: no-reply@yourdomain.com\r\n";
        $headers .= "Reply-To: $email\r\n";

        // SEND EMAIL
        if (mail($to, $subject, $message, $headers)) {
            header('Location: register.php?update_msgform=Account Registered! Please wait for admin approval.');
        } else {
            header('Location: register.php?error_msgform=Unexpected Error. Please try again.');
        }
    }
}
?>