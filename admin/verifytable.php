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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles.css">

    <!-- DATATABLE -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">
</head>
<body>
    <nav class="shadow navbar custom-navbar sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="../index.php">
                <img src="../assets/logo.png" width="45" height="45" class="d-inline-block align-middle me-2">
                Grab my Garbage
            </a>
            <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav">
                <li>
                    <a class="navbar-brand d-flex align-items-center" href="settings.php">Settings</a>
                </li>
                <li class="nav-item col-6 col-lg-auto">
                    <a class="navbar-brand d-flex align-items-center" href="adminmenu.php">Go Back</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid p-5 justify-content-center w-100">
        <h1 class="display-4 text-center mb-4">Collection Data</h1>
        <table id="datatableid" class="table table-hover table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Collection ID</th>
                    <th>Request ID</th>
                    <th>Weight</th>
                    <th>Notes</th>
                    <th>Collection Date</th>
                    <th>Verifier</th> <!-- Added Username column -->
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // FETCH DATA FROM collection_data TABLE
                $query = 'SELECT * FROM collection_data';
                $stmt = $connection->prepare($query);
                $stmt->execute();

                // FETCH ALL RESULTS
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($results as $row) {
                    ?>
                    <tr class="text-center">
                        <td><?php echo $row['collectionid']; ?></td>
                        <td><?php echo $row['request_id']; ?></td>
                        <td><?php echo $row['weight']; ?></td>
                        <td><?php echo $row['notes']; ?></td>
                        <td><?php echo $row['collection_date']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><a class="btn btn-danger" href="verifydelete.php?id=<?php echo $row['collectionid']; ?>">Delete</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

        <?php
        // DISPLAY UPDATE MESSAGE
        if (isset($_GET['update_msg'])) {
            echo "<h4 class='lead'>" . htmlspecialchars($_GET['update_msg']) . "</h4>";
        }

        // DISPLAY DELETE MESSAGE
        if (isset($_GET['delete_msg'])) {
            echo "<h4 class='lead'>" . htmlspecialchars($_GET['delete_msg']) . "</h4>";
        }
        ?>

        <!-- GO BACK TO MENU -->
        <form action="adminmenu.php" method="post">
            <div class="container text-center mt-4">
                <button type="submit" class="btn btn-primary">Redirect to Dashboard</button>
            </div>  
        </form>
    </div>
    
<!-- DATATABLE SCRIPT -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384 -MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#datatableid').DataTable();
    });
</script>
</body>
</html>