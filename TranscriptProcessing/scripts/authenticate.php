<?php
require_once('includes/init.php'); // Adjust path as needed

// Initialize variables
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

// Validate inputs (basic validation example)
if (empty($username) || empty($password) || empty($role)) {
    $response = array(
        'success' => false,
        'message' => 'Please fill in all fields'
    );
    echo json_encode($response);
    exit;
}

// Attempt login
$user = authenticate($username, $password, $role, $conn); // Assuming $conn is your database connection

if ($user) {
    // Start session and store user data
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $role;

    // Prepare success response
    $response = array(
        'success' => true,
        'message' => 'Login successful',
        'redirect' => ($role == 'admin') ? 'pages/admin/welcome.php' : 'pages/staff/welcome.php'
    );
} else {
    // Prepare error response
    $response = array(
        'success' => false,
        'message' => 'Invalid username or password'
    );
}

echo json_encode($response);
exit;
?>
