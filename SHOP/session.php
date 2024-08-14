<?php
session_start(); // Start the session

// Redirect to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../SHOP/login');
    exit;
}

?>