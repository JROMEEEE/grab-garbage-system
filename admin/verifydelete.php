<?php
require_once('../dbconnect.php');

// CREATE NEW INSTANCE TO GET CONNECTION
$db = new Database();
$connection = $db->getConnect();

// DELETE DB
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // DELETE QUERY
    $query = "DELETE FROM collection_data WHERE collectionid = :id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':id', $id);

    // EXECUTE QUERY
    if ($stmt->execute()) {
        header('Location: verifytable.php?delete_msg=Request Deleted!');
        exit;
    } else {
        die("Query failed: " . implode(", ", $stmt->errorInfo()));
    }
}
?>