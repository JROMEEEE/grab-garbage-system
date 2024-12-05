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

// GET REQUEST ID FROM DB
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM user_detail WHERE request_id = :id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles.css">
</head>
<body>

<nav class="shadow navbar custom-navbar sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="../index.php">
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

<div class="container p-5 bg-primary mb-5 w-75 mt-5 text-white">
    <h1 class="display-5 text-center text-white mt-5 mb-3">Verify Request</h1>
    <form action="verifyprocess.php" method="post">

        <!-- HIDDEN INPUT FOR REQUEST ID -->
        <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
        
        <p class="lead text-white">Request ID: <?php echo $row['request_id']; ?></p>    
    
        <div class="mb-3">
            <label for="weight" class="form-label">Weight (kg)</label>
            <input type="text" name="weight" class="form-control" id="weight" placeholder="Enter collection weight in kg" required>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" class="form-control" id="notes" rows="2" placeholder="Optional"></textarea>
        </div>

        <input type="submit" class="btn btn-primary mt-2" value="Verify Request" name="update_request">

        <?php
            if (isset($_GET['update_msg'])) {
                echo "<h6 class='text-white'>".$_GET['update_msg']."</h6>";
            }

            if (isset($_GET['error_msgform'])) {
                echo "<h6 class='text-white'>".$_GET['error_msgform']."</h6>";
            }
        ?>
    </form>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>