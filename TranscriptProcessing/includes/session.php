<?php
// session.php - Session management script

// Start or resume session
session_start();

// Function to check if user is logged in
function check_login() {
    if (!isset($_SESSION['users'])) {
        header('Location: login.php');
        exit();
    }
}

// Function to log out user
function logout() {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}
?>
