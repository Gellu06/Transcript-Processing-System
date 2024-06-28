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
    <title>Backup</title>
    <link rel="stylesheet" href="../../styles/main.css">
</head>
<body>
    <header>
        <h1>Backup</h1>
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
        <h2>Database Backup</h2>
        <p>Click the button below to download a backup of the database.</p>
        <form action="backup_action.php" method="post">
            <input type="submit" value="Download Backup">
        </form>
    </main>
</body>
</html>
