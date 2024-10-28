<?php
session_start();
include('dbconnect.php');

if(!isset($_SESSION['username'])) { // CHECK IF USER IS LOGGED IN
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu</title>
    <!-- <link rel="stylesheet" href="https://unpkg.com/mvp.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css">
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
                <a class="navbar-brand d-flex align-items-center" href="index.php#request">Request Pickup</a>
            </li>
            <li nav-item col-6 col-lg-auto>
                <a class="navbar-brand d-flex align-items-center" href="login.php">Admin Menu</a>
            </li>
        </div>
    </nav>


    <div class="container-fluid p-5 justify-content-center w-100">
        <h1 class="display-4 text-center mb-4">Database Center</h1>
        <table class="table table-hover table-bordered">
            <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Garbage Type</th>
                    <th>Collection Date</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // FETCH USER DATA
                    $query = 'SELECT * FROM `user_detail`';
                    $result = mysqli_query($connection, $query);

                    if (!$result) {
                        die("Query failed: " . mysqli_error($connection));
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr class="text-center">
                                <!-- PRINT DATA -->
                                <td><?php echo $row['request_id']; ?></td>
                                <td><?php echo $row['user_fullname']; ?></td>
                                <td><?php echo $row['user_address']; ?></td>
                                <td><?php echo $row['user_phonenumber']; ?></td>
                                <td><?php echo $row['garbage_type']; ?></td>
                                <td><?php echo $row['request_date']; ?></td>
                                <td><a class="btn btn-warning" href="update_db.php?id=<?php echo $row['request_id']; ?>">Update</a></td>
                                <td><a class="btn btn-danger" href="delete_db.php?id=<?php echo $row['request_id']; ?>">Delete</a></td>
                            </tr>
                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>

        <?php
            // DISPLAY UPDATE MESSAGE
            if (isset($_GET['update_msg'])) {
                echo "<h4 class = 'lead'>" . $_GET['update_msg'] . "</h4>";
            }

            // DISPLAY DELETE MESSAGE
            if (isset($_GET['delete_msg'])) {
                echo "<h4 class = 'lead'>" . $_GET['delete_msg'] . "</h4>";
            }
        ?>
        
        <!-- GO BACK TO MENU -->
        <form action="index.php" method="post">
            <div class="container text-center mt-4">
                <button type="submit" class="btn btn-primary">Redirect to Menu</button>
            </div>  
        </form>
    </div>
    <!-- LOGOUT OF SESSION -->
    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
