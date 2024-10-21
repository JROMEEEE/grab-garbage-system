<?php include('dbconnect.php'); ?>

<?php 

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM `user_detail` WHERE `user_detail`.`request_id` = '$id'";
        $result = mysqli_query($connection, $query);
        
        if(!$result){
            die("Query failed: ".mysqli_error($connection))     ;
        } else {
            header('Location: adminmenu.php?delete_msg=Request Deleted!');
        } 
    
    }
?>