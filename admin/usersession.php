<?php
class UserSession {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection; // STORE DB CONNECTION
    }

    public function checkLogin() {
        if (!isset($_SESSION['username'])) { // CHECK IF USER IS LOGGED IN
            header('Location: login.php');
            exit;
        }
    }

    public function getUsername() {
        return isset($_SESSION['username']) ? $_SESSION['username'] : null;
    }

    public function logout() {
        session_destroy(); // DESTROY SESSION
        header('Location: login.php'); // GO BACK TO LOGIN
        exit;
    }
}
?>