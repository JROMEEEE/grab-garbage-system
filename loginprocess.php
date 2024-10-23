<?php
    include('dbconnect.php');
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $admincode = $_POST["admincode"];

    if(isset($_POST["submit"])){

        $sqlquery = "SELECT * FROM adminacc_detail WHERE username = ? AND admincode = ?";
        $stmt = mysqli_prepare($connection, $sqlquery);
        mysqli_stmt_bind_param($stmt, "ss", $username, $admincode); // PREPARE STATEMENTS BY BINDING THE PARAMETERS
        mysqli_stmt_execute($stmt); // EXECUTES PREPARED STATEMENT

        $result = mysqli_stmt_get_result($stmt); // GET RESULT FROM STMT EXECUTE

        if (mysqli_num_rows($result) > 0) { // CHECK IF ROWS RETURNED ARE GREATER THAN 0
            $user = mysqli_fetch_assoc($result); // 

            if (password_verify($password, $user['password'])) { // COMPARE INPUTTED PASSWORD WITH HASHED PASSWORD
                session_start();
                $_SESSION['username'] = $user['username']; // STORES USERNAME IN SESSION
                $_SESSION['admincode'] = $user['admincode']; // STORES ADMIN CODE IN SESSION
                header('Location: adminmenu.php'); // REDIRECTS TO ADMIN MENU
                exit;
            } else {
                header('Location: login.php?error_msgform=Invalid details, please try again.');
                exit;
            }
        } else {
            header('Location: login.php?error_msgform=Invalid details, please try again.');
            exit;
        }
    }
?>