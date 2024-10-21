<?php include('dbconnect.php');?>

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
    <h1>Database Center</h1>
    <table>
        <thead>
            <tr>
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
                $query = 'select * from `user_detail`';
                $result = mysqli_query($connection, $query);

                if(!$result){
                    die("Query failed: ".mysqli_error($connection));
                } else{
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo $row['request_id']; ?></td>
                        <td><?php echo $row['user_fullname']; ?></td>
                        <td><?php echo $row['user_address']; ?></td>
                        <td><?php echo $row['user_phonenumber']; ?></td>
                        <td><?php echo $row['garbage_type']; ?></td>
                        <td><?php echo $row['request_date']; ?></td>
                        <td><a href="update_db.php?id=<?php echo $row['request_id']; ?>">Update</td>
                        <td><a href="delete_db.php?id=<?php echo $row['request_id']; ?>">Delete</td>
                    </tr>
                    <?php
                }
             }
            ?>
        </tbody>
    </table>

    <?php
        if(isset($_GET['update_msg'])){
            echo "<h4>".$_GET['update_msg']."</h4>";
        }
    ?>

    <?php
        if(isset($_GET['delete_msg'])){
            echo "<h4>".$_GET['delete_msg']."</h4>";
        }
    ?>

    </div>
    <form action="index.html" method="get">
            <button type="submit">Redirect to Main Menu</button>
        </form>
</body>
</html>