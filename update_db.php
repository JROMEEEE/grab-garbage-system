<?php include('dbconnect.php');?>

<?php

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
    <link rel="stylesheet" href="https://unpkg.com/mvp.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class='container'>
    <h1>Edit Request</h1>
    <label for="">Enter Details:</label>


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

        <form action="update_db.php?id_new=<?php echo $id; ?>" method="post">

            <h3>Request ID: <?php echo $row['request_id']; ?></h3>

            <input type="text" class="form-control m-t-4" name="fullname" id="" placeholder="Full Name:" value="<?php echo $row['user_fullname'];?>" required>
            <br>
            <input type="text" class="form-control m-t-4" name="address" id="" placeholder="Address:" value="<?php echo $row['user_address']?>" required>
            <br>
            <input type="text" class="form-control m-t-4" name="phonenumber" id="" placeholder="Phone Number:" value="<?php echo $row['user_phonenumber']; ?>" required>
            <br>
            <input type="text" class="form-control m-t-4" name="garbagetype" id="" placeholder="Garbage Type:" value="<?php echo $row['garbage_type']; ?>" required>
            <br>
            
            <label for="">Collection Date and Time (Closed on Weekends):</label>
            <input type="date" class="form-control m-t-4" name="collectiondate" id="" placeholder="Collection Date:" value="<?php echo $row['request_date']; ?>" required>
            <br>

            <input type="submit" class="btn btn-primary mt-4" value="Update" name="update_request">
        </form>

        <form action="adminmenu.php" method="get">
            <button type="submit">Redirect to Menu</button>
        </form>

    </div>
</body>
</html>