<?php
session_start();
require_once('../../includes/db.php');
require_once('../../includes/functions.php');

// Check if staff is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'staff') {
    redirect_to('../login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Welcome</title>
    <link rel="stylesheet" href="../../styles/main.css">
</head>
<body>
    <header>
        <h1>Welcome, Staff</h1>
        <nav>
            <ul>
                <li><a href="welcome.php">Home</a></li>
                <li><a href="query_result.php">Query Result</a></li>
                <li><a href="print_result.php">Print Result</a></li>
                <li><a href="backup.php">Backup</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Welcome to the Staff Panel</h2>
        <p>Use the menu to navigate through the system.</p>
    </main>
</body>
</html>
