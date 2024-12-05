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

$username = $_SESSION['username'];

// GET REQ ID FROM POST
if (isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];
} else {
    header("Location: verify.php?verror_msgform=Request ID is missing.");
    exit();
}

class VerifyRequest {
    public $weight;
    public $notes;
    private $connection;

    public function __construct($connection, $weight, $notes) {
        $this->connection = $connection;
        $this->weight = $weight;
        $this->notes = $notes;
    }

    // CHECK IF WEIGHT IS A NUMBER
    public function verifyWeight() {
        return is_numeric($this->weight) && $this->weight >= 0;
    }

    // SAVE DATA TO DATABASE
    public function verifySave($request_id, $username) {
        $query = "INSERT INTO `collection_data` (request_id, weight, notes, username) 
                  VALUES (:request_id, :weight, :notes, :username)";
        
        // PREPARE SQL
        $stmt = $this->connection->prepare($query);
        
        // BIND PARAMETERS
        $stmt->bindParam(':request_id', $request_id);
        $stmt->bindParam(':weight', $this->weight);
        $stmt->bindParam(':notes', $this->notes);
        $stmt->bindParam(':username', $username);
        
        // EXECUTE
        if ($stmt->execute()) {
            return $this->connection->lastInsertId();
        }
    }

    // SEND EMAIL TO GRABMYGARGAGEPROJ
    public function verifyMail($request_id) {
        $to = 'grabmygarbageproj@gmail.com';
        $subject = 'A Request has been verified!';
        $message = "Request ID: $request_id\nWeight: {$this->weight} kg\nNotes: {$this->notes}\nUsername: {$_SESSION['username']}";

        $headers = "From: no-reply@yourdomain.com\r\n";
        return mail($to, $subject, $message, $headers);
    }
}

// GET WEIGHT & NOTES FROM POST
$weight = $_POST['weight'];
$notes = $_POST['notes'];

// CREATE NEW VERIFYREQUEST INSTANCE
$verifyRequest = new VerifyRequest($connection, $weight, $notes);

// CHECK IF WEIGHT IS A NUMBER
if (!$verifyRequest->verifyWeight()) {
    header("Location: verify.php?error_msgform=Invalid weight.");
    exit();
}

// SAVE DATA TO DATABASE
$id = $verifyRequest->verifySave($request_id, $username);

// SEND EMAIL TO GRABMYGARGAGEPROJ
if ($verifyRequest->verifyMail($request_id)) {
    header("Location: adminmenu.php?update_msg=Request Sent!");
    exit();
} else {
    header("Location: verify.php?error_msgform=Unexpected Error. Please try again.");
    exit();
}
?>