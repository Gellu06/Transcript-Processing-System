<?php
// welcome.php - Welcome page for both admin and staff users

session_start();
require_once('../includes/functions.php');
check_login(); // Check if user is logged in

// Example: Retrieve user details from session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role']; // 'admin' or 'staff'

// Example: Determine page title based on user role
$page_title = ($role === 'admin') ? 'Admin Dashboard' : 'Staff Dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .logout-link {
            float: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $page_title; ?></h1>
        <p>Welcome, <?php echo $username; ?>!</p>
        
        <!-- Example: Display different menu items based on user role -->
        <ul>
            <li><a href="view_students.php">View Students</a></li>
            <?php if ($role === 'admin') : ?>
                <li><a href="register_student.php">Register Student</a></li>
                <li><a href="view_staff.php">View Staff</a></li>
                <li><a href="backup.php">Backup Data</a></li>
            <?php else : ?>
                <li><a href="query_result.php">Query Result</a></li>
                <li><a href="print_result.php">Print Result</a></li>
            <?php endif; ?>
            <li><a href="logout.php" class="logout-link">Logout</a></li>
        </ul>
    </div>
</body>
</html>
