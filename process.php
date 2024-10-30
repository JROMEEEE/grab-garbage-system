<?php
// include('dbconnect.php');

// $name = $_POST["fullname"];
// $address = $_POST["address"];
// $phone = $_POST["phonenumber"];
// $garbageType = $_POST["garbagetype"];
// $date = $_POST["collectiondate"];

// // Check if the form was submitted
// if($_SERVER["REQUEST_METHOD"]=="POST"){

//     // Check if date is Sat/Sun
//     $collectionTimestamp = strtotime($date);

//     if (!$collectionTimestamp) {
//         header('Location: index.php?error_msgform=Invalid Input! We are unavailable on Weekends.');
//         exit;
//     }

//     $collectionDay = date('w', $collectionTimestamp);
//     if ($collectionDay == 0 || $collectionDay == 6) {
//         header('Location: index.php?error_msgform=Invalid Input! We are unavailable on Weekends.');
//         exit;
//     }

   
//     $query = "insert into `user_detail` (user_fullname, user_address, user_phonenumber, garbage_type, request_date) values ('$name', '$address', '$phone', '$garbageType', '$date')";
//     $result = mysqli_query($connection, $query);

//     if(!$result){
//         die("Query failed: ".mysqli_error($connection));
//     } else {
//         $id = mysqli_insert_id($connection);

//         // $to = 'grabmygarbageproj@gmail.com';
//         // $subject = "Grab my Garbage Request!";
//         // $messageLines = array(
//         //     "Name: $name",
//         //     "Address: $address",
//         //     "Phone Number: $phone",
//         //     "Garbage Type: $garbageType",
//         //     "Collection Date: $date",
//         //     "Request ID: $id"
//         // );
//         // $message = implode("\n", $messageLines);

//         // $headers = array(
//         //     "From: grabmygarbageproj@gmail.com",
//         //     "Reply-To: grabmygarbageproj@gmail.com",
//         //     "MIME-Version: 1.0",
//         //     "Content-Type: text/plain; charset=UTF-8"
//         // );
//         // $headersString = implode("\r\n", $headers);

//         // ASSIGN VALUES TO MAIL
//         $to = "grabmygarbageproj@gmail.com";
//         $subject = "Grab my Garbage Request!";
//         $message = "A new request has been submitted!.\n\n";
//         $message .= "Name: $name\n";
//         $message .= "Address: $address\n";
//         $message .= "Phone Number: $phone\n";
//         $message .= "Garbage Type: $garbageType\n";
//         $message .= "Collection Date: $date\n";
//         $message .= "Request ID: $id\n";

//         $headers = "From: no-reply@yourdomain.com\r\n";
//         $headers .= "Reply-To: $email\r\n";

//         // Mail Function Sending
//         if(mail($to, $subject, $message, $headers)){
//             header('Location: index.php?update_msgform=Request Sent!');
//             exit;
//         } else {
//             // header('Location: index.php?error_msgform=Invalid Input! We are unavailable on Weekends.');
//             // exit;

//             error_log("Mail failed to send for Request ID: $id on " . date('Y-m-d H:i:s'), 3, 'mail_errors.log');
//             header('Location: index.php?error_msgform=Request recorded, but email notification failed.');
//             exit;
//         }
//     }
// }

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
        $query = "INSERT INTO `user_detail` (user_fullname, user_address, user_phonenumber, garbage_type, request_date) 
                  VALUES ('$this->name', '$this->address', '$this->phone', '$this->garbageType', '$this->date')";
        $result = mysqli_query($this->connection, $query);
        return $result ? mysqli_insert_id($this->connection) : false;
    }

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

    include('dbconnect.php');

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
            header('Location: index.php?error_msgform=Invalid Input! We are unavailable on Weekends.');
            exit;
        }

        // SAVE REQUEST
        $id = $request->save();
        if (!$id) {
            die("Query failed: " . mysqli_error($connection));
        }

        // SEND EMAIL
        if ($request->sendEmail($id)) {
            header('Location: index.php?update_msgform=Request Sent!');
        } else {
            header('Location: index.php?error_msgform=Request recorded, but email notification failed.');
        }
        exit;
}
?>