<?php
    session_start();
    session_destroy(); // DESTROY SESSION
    header('Location: login.php');
?>