<?php
include('dbconnect.php');

$name = $_POST["fullname"];
$address = $_POST["address"];
$phone = $_POST["phonenumber"];
$garbageType = $_POST["garbagetype"];
$date = $_POST["collectiondate"];

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $collectionTimestamp = strtotime($date);

    if (!$collectionTimestamp) {
        header('Location: formrequest.php?error_msgform=Invalid Input! We are unavailable on Weekends.');
        exit;
    }

    $collectionDay = date('w', $collectionTimestamp);
    if ($collectionDay == 0 || $collectionDay == 6) {
        header('Location: formrequest.php?error_msgform=Invalid Input! We are unavailable on Weekends.');
        exit;
    }

   
    $query = "insert into `user_detail` (user_fullname, user_address, user_phonenumber, garbage_type, request_date) values ('$name', '$address', '$phone', '$garbageType', '$date')";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die("Query failed: ".mysqli_error($connection));
    } else {
        $id = mysqli_insert_id($connection);

        $to = 'grabmygarbageproj@gmail.com';
        $subject = "Grab my Garbage Request!";
        $messageLines = array(
            "Name: $name",
            "Address: $address",
            "Phone Number: $phone",
            "Garbage Type: $garbageType",
            "Collection Date: $date",
            "Request ID: $id"
        );
        $message = implode("\n", $messageLines);

        $headers = array(
            "From: grabmygarbageproj@gmail.com",
            "Reply-To: grabmygarbageproj@gmail.com",
            "MIME-Version: 1.0",
            "Content-Type: text/plain; charset=UTF-8"
        );
        $headersString = implode("\r\n", $headers);

        if(mail($to, $subject, $message, $headersString)){
            header('Location: formrequest.php?update_msgform=Request Sent!');
            exit;
        } else {
            header('Location: formrequest.php?error_msgform=Invalid Input! We are unavailable on Weekends.');
            exit;
        }
    }
}
?>