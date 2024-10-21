<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/mvp.css">
    <!-- <link rel="stylesheet" href="https://unpkg.com/mvp.css"> -->
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <!--FORM REQUEST-->
        <div class = "container">
        <h1>Grab my Garbage Request System</h1>
        <form action="process.php" method="post">
            <label for="">Full Name:</label>
            <input type="text" class="form-control m-t-4" name="fullname" id="" placeholder="Enter Full Name:" required>
                <br>        
                <br>
            <label for="">Address:</label>
            <input type="text" class="form-control m-t-4" name="address" id="" placeholder="Enter Address:" required>
                <br>
            <label for="">Phone Number:</label>
            <input type="text" class="form-control m-t-4" name="phonenumber" id="" placeholder="Enter Phone Number:" required>
                <br>
            <label for="">Garbage Type:</label>
            <input type="text" class="form-control m-t-4" name="garbagetype" id="" placeholder="Describe Garbage Type:" required>
                <br>
            <label for="">Collection Date and Time (Closed on Saturday & Sunday):</label>
            <input type="date" class="form-control m-t-4" name="collectiondate" id="" placeholder="Collection Date:" required>
                <br>

            <?php
            // ERROR HANDLING
                if(isset($_GET['update_msgform'])){
                    echo "<h4>".$_GET['update_msgform']."</h4>";
                }
            ?>

            <?php
                if(isset($_GET['error_msgform'])){
                    echo "<h4>".$_GET['error_msgform']."</h4>";
                }
            ?>

            <input type="submit" class="btn btn-primary mt-4" value="Send" name="submit">
        </form>
        <!--Go back to Menu-->
        <form action="index.html" method="post">
            <button type="submit">Redirect to Menu</button>
        </form>
        </div>
</body>
</html>