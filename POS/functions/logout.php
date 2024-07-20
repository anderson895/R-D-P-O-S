<?php
session_start(); // Start the session

if (isset($_SESSION['acc_id'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the login page (or any other page as needed)
    header("Location: ../pages");
    exit();
}
