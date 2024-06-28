<?php
session_start();
require_once('../../includes/db.php');
require_once('../../includes/functions.php');

// Check if admin is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    redirect_to('../login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Welcome</title>
    <link rel="stylesheet" href="../../styles/main.css">
</head>
<body>
    <header>
        <h1>Welcome, Admin</h1>
        <nav>
            <ul>
                <li><a href="welcome.php">Home</a></li>
                <li><a href="register_student.php">Register Student</a></li>
                <li><a href="view_student_details.php">View Student Details</a></li>
                <li><a href="staff_details.php">Staff Details</a></li>
                <li><a href="backup.php">Backup</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Welcome to the Admin Panel</h2>
        <p>Use the menu to navigate through the system.</p>
    </main>
</body>
</html>
