<?php include('dbconnect.php');?>

<?php
// Update DB function
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "select * from `user_detail` where request_id = '$id'";
        $result = mysqli_query($connection, $query);

        if(!$result){
            die("Query failed: ".mysqli_error($connection));
        }else{
                $row = mysqli_fetch_assoc($result);
            }
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

    <div class = "container p-5 mb-5">
    <h1>Edit Request</h1>
        <?php 
        
        if(isset($_POST['update_request'])){

            if(isset($_GET['id_new'])){
                $idnew = $_GET['id_new'];
            }

            $fullname = $_POST['fullname'];
            $address = $_POST['address'];
            $phone = $_POST['phonenumber'];
            $garbageType = $_POST['garbagetype'];
            $date = $_POST['collectiondate'];

            $query = "update `user_detail` set user_fullname = '$fullname', user_address = '$address', user_phonenumber = '$phone', garbage_type = '$garbageType', request_date = '$date' where request_id = '$idnew'";
            $result = mysqli_query($connection, $query);

            if(!$result){
                die("Query failed: ".mysqli_error($connection));
            }else{
                header('Location: adminmenu.php?update_msg=Sucessfully Updated');
            }

        }
        
        ?>
 
        <!-- Update Form w/ set placeholder-->
        <form action="update_db.php?id_new=<?php echo $id; ?>" method="post">
            <h3>Request ID: <?php echo $row['request_id']; ?></h3>
            <br>

            <label for="">Full Name:</label>
            <input type="text" class="form-control m-t-4" name="fullname" id="" placeholder="Full Name:" value="<?php echo $row['user_fullname'];?>" required>
            <br>
            <label for="">Address:</label>
            <input type="text" class="form-control m-t-4" name="address" id="" placeholder="Address:" value="<?php echo $row['user_address']?>" required>
            <br>
            <label for="">Phone Number:</label>
            <input type="text" class="form-control m-t-4" name="phonenumber" id="" placeholder="Phone Number:" value="<?php echo $row['user_phonenumber']; ?>" required>
            <br>
            <label for="">Garbage Type:</label>
            <input type="text" class="form-control m-t-4" name="garbagetype" id="" placeholder="Garbage Type:" value="<?php echo $row['garbage_type']; ?>" required>
            <br>
            
            <label for="">Collection Date and Time (Closed on Weekends):</label>
            <input type="date" class="form-control m-t-4" name="collectiondate" id="" placeholder="Collection Date:" value="<?php echo $row['request_date']; ?>" required>
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