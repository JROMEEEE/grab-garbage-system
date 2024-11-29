<?php
session_start();
require_once('../dbconnect.php');
require_once('usersession.php');

// CREATE NEW DB INSTANCE AND GET CONNECTION
$db = new Database();
$connection = $db->getConnect();

// CREATE NEW USERSESSION INSTANCE
$userSession = new UserSession($connection);

// CHECK IF USER IS LOGGED IN
$userSession->checkLogin();

// GET USERNAME FROM SESSION
$username = $_SESSION['username']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles.css">
    <title>Update Username</title>
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
    <form class="p-5" action="" method="post">
        <h1 class="display-4 text-center mb-5">Update Username</h1>

        <?php
        if (isset($_POST['update_username'])) {
            $new_username = $_POST['new_username'];
            $admincode = $_POST['admincode'];
            $password = $_POST['password'];
        
            // Check if the new username already exists
            $query = "SELECT * FROM adminacc_detail WHERE username = :new_username";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(':new_username', $new_username);
            $stmt->execute();
        
            if ($stmt->rowCount() > 0 && $new_username != $username) {
                header('Location: update_user.php?error_msg=Username already exists');
                exit;
            } else {
                // Check if the admin code and password match the ones in the database
                $query = "SELECT * FROM adminacc_detail WHERE username = :username AND admincode = :admincode";
                $stmt = $connection->prepare($query);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':admincode', $admincode);
                $stmt->execute();
        
                if ($stmt->rowCount() > 0) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
                    if (password_verify($password, $user['password'])) {
                        // Update the username in the database
                        $query = "UPDATE adminacc_detail SET username = :new_username WHERE username = :username";
                        $stmt = $connection->prepare($query);
                        $stmt->bindParam(':new_username', $new_username);
                        $stmt->bindParam(':username', $username);
        
                        if ($stmt->execute()) {
                            // Update the session variable with the new username
                            $_SESSION['username'] = $new_username;
                            header('Location: updateusername.php?update_msg=Username updated successfully');
                            exit;
                        } else {
                            header('Location: updateusername.php?error_msg=Error updating username');
                            exit;
                        }
                    } else {
                        header('Location: updateusername.php?error_msg=Invalid password');
                        exit;
                    }
                } else {
                    header('Location: updateusername.php?error_msg=Invalid admin code');
                    exit;
                }
            }
        }
        ?>

        <div class="container text-center mt-3">
            <?php
            if (isset($_GET['update_msg'])) {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>".$_GET['update_msg'].'</div>';
            }

            if (isset($_GET['error_msg'])) {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert >".$_GET['error_msg'].'</div>';
            }
            ?>
        </div>

        <div class="mb-3 row">
            <label for="username" class="col-sm-2 col-form-label">Current Username</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext text-white" id="username" value="<?php echo $username; ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="new_username" class="col-sm-2 col-form-label">Change Username:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="new_username" name="new_username" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="admincode" class="col-sm-2 col-form-label">Enter Admin Code:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="admincode" name="admincode" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputPassword" required>
            </div>
        </div>
        <input type="submit" name="update_username" value="Update Username" class="btn btn-primary float-end mt-3">
        <br>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>