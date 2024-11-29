<?php
require_once('../dbconnect.php');

class Request {
    public $name;
    private $address;
    private $phone;
    private $garbageType;
    public $date;
    public $connection;

    public function __construct($connection, $name, $address, $phone, $garbageType, $date) {
        $this->connection = $connection;
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->garbageType = $garbageType;
        $this->date = $date;
    }

    public function isValidDate() {
        $collectionTimestamp = strtotime($this->date);
        if (!$collectionTimestamp) {
            return false;
        }
        $collectionDay = date('w', $collectionTimestamp);
        return ($collectionDay != 0 && $collectionDay != 6);
    }

    public function save() {

        //DEFINE QUERY WITH PLACEHOLDER
        $query = "INSERT INTO `user_detail` (user_fullname, user_address, user_phonenumber, garbage_type, request_date) 
                  VALUES (:fullname, :address, :phonenumber, :garbage_type, :request_date)";
        
        //PREPARE SQL STATEMENT
        $stmt = $this->connection->prepare($query);
        
        // BIND PARAMETERS
        $stmt->bindParam(':fullname', $this->name);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':phonenumber', $this->phone);
        $stmt->bindParam(':garbage_type', $this->garbageType);
        $stmt->bindParam(':request_date', $this->date);
        
        // EXECUTE STATEMENT
        if ($stmt->execute()) {
            return $this->connection->lastInsertId();
        } else {
            return false;
        }
    }

    // SEND EMAIL
    public function sendEmail($id) {
        $to = "grabmygarbageproj@gmail.com";
        $subject = "Grab my Garbage Request!";
        $message = "A new request has been submitted!\n\n" .
                   "Name: $this->name\n" .
                   "Address: $this->address\n" .
                   "Phone Number: $this->phone\n" .
                   "Garbage Type: $this->garbageType\n" .
                   "Collection Date: $this->date\n" .
                   "Request ID: $id\n";

        $headers = "From: no-reply@yourdomain.com\r\n";
        return mail($to, $subject, $message, $headers);
    }
}

// Create a new Database instance and get the connection
$database = new Database();
$connection = $database->getConnect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["fullname"];
    $address = $_POST["address"];
    $phone = $_POST["phonenumber"];
    $garbageType = $_POST["garbagetype"];
    $date = $_POST["collectiondate"];

    // CREATE REQUEST OBJECT
    $request = new Request($connection, $name, $address, $phone, $garbageType, $date);

    // CHECK IF DATE IS SAT/SUN
    if (!$request->isValidDate()) {
        header('Location: ../index.php?error_msgform=Invalid Input! We are unavailable on Weekends.');
        exit;
    }

    // SAVE REQUEST
    $id = $request->save();
    if (!$id) {
        die("Query failed: " . implode(", ", $request->connection->errorInfo()));
    }

    // SEND EMAIL
    if ($request->sendEmail($id)) {
        header('Location: ../index.php?update_msgform=Request Sent!');
    } else {
        header('Location: ../index.php?error_msgform=Request recorded, but email notification failed.');
    }
    exit;
}
?>