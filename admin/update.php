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

// Update DB function
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM user_detail WHERE request_id = :id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Data fetched successfully
    } else {
        die("No record found.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles.css">
</head>
<body>

<nav class="shadow navbar custom-navbar sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="../assets/logo.png" width="45" height="45" class="d-inline-block align-middle me-2">
            Grab my Garbage
        </a>
        <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav">
            <li class="nav-item col-6 col-lg-auto">
                <a class="navbar-brand d-flex align-items-center" href="login.php">Go Back</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container p-5 mb-5">
    <h1 class="display-4 text-center mb-4">Edit Request</h1>
    <?php 
    if (isset($_POST['update_request'])) {
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $phone = $_POST['phonenumber'];
        $garbageType = $_POST['garbagetype'];
        $date = $_POST['collectiondate'];

        $query = "UPDATE user_detail SET user_fullname = :fullname, user_address = :address, user_phonenumber = :phone, garbage_type = :garbageType, request_date = :date WHERE request_id = :id";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':garbageType', $garbageType);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            header('Location: adminmenu.php?update_msg=Successfully Updated');
            exit; // Always good practice to exit after a header redirect
        } else {
            die("Query failed: " . implode(", ", $stmt->errorInfo()));
        }
    }
    ?>

    <!-- Update Form w/ set placeholder-->
    <form action="update.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
        <h3 class="lead">Request ID: <?php echo htmlspecialchars($row['request_id']); ?></h3>
        <br>

        <input type="text" class="form-control m-t-4" name="fullname" placeholder="Full Name:" value="<?php echo htmlspecialchars($row['user_fullname']); ?>" required>
        <br>
        <label for="">Address:</label>
        <input type="text" class="form-control m-t-4" name="address" placeholder="Address:" value="<?php echo htmlspecialchars($row['user_address']); ?>" required>
        <br>
        <label for="">Phone Number:</label>
        <input type="text" class="form-control m-t-4" name="phonenumber" placeholder="Phone Number:" value="<?php echo htmlspecialchars($row['user_phonenumber']); ?>" required>
        <br>
        <label for="">Garbage Type:</label>
        <input type="text" class="form-control m-t-4" name="garbagetype" placeholder="Garbage Type:" value="<?php echo htmlspecialchars($row['garbage_type']); ?>" required>
        <br>

        <label for="">Collection Date and Time (Closed on Weekends):</label>
        <input type="date" class="form-control m-t-4" name="collectiondate" value="<?php echo htmlspecialchars($row['request_date']); ?>" required>
        <br>

        <input type="submit" class="btn btn-primary mt-2" value="Save Changes" name="update_request">
    </form>

    <form action="adminmenu.php" method="post">
        <div class="container text-center mt-4">
            <button type="submit" class="btn btn-primary">Go Back</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>