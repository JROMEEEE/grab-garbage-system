<?php

define("HOST", "localhost");
define("USERNAME", "root");
define("PASS", "");
define("DB", "grabmygarbagedb");

$connection = mysqli_connect(HOST, USERNAME, PASS, DB);

if(!$connection){
    die("Connection failed: ".mysqli_connect_error());
} else{
    echo "Database Connected!";
}

?>