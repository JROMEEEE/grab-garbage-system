<?php
require_once('../dbconnect.php');

// Create a new Database instance and get the connection
$db = new Database();
$connection = $db->getConnect();

// Delete DB function
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the DELETE query
    $query = "DELETE FROM user_detail WHERE request_id = :id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);

    // Execute the query and check for success
    if ($stmt->execute()) {
        header('Location: adminmenu.php?delete_msg=Request Deleted!');
        exit; // Always good practice to exit after a header redirect
    } else {
        die("Query failed: " . implode(", ", $stmt->errorInfo()));
    }
}
?>