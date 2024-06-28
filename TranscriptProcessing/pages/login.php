<?php
require_once('includes/init.php'); // Adjust path as needed

// Initialize variables and error handling
$username = "";
$password = "";
$role = "";
$errors = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    // Validate inputs (basic validation example)
    if (empty($username) || empty($password) || empty($role)) {
        $errors[] = "Please fill in all fields";
    }

    // Attempt login if no errors
    if (empty($errors)) {
        $user = authenticate($username, $password, $role, $conn); // Assuming $conn is your database connection

        if ($user) {
            // Start session and store user data
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $role;

            // Redirect based on role
            if ($role == 'admin') {
                redirect_to('pages/admin/welcome.php');
            } elseif ($role == 'staff') {
                redirect_to('pages/staff/welcome.php');
            }
        } else {
            $errors[] = "Invalid username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Transcript System - Login</title>
    <link rel="stylesheet" href="styles/main.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <h1>University Transcript System</h1>
    </header>
    <main>
        <div class="login-container">
            <h2>Login</h2>
            <?php if (!empty($errors)) { ?>
                <div class="error">
                    <ul>
                        <?php foreach ($errors as $error) { ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="role">Login as:</label>
                    <select id="role" name="role" required>
                        <option value="">--select user--</option>
                        <option value="admin" <?php echo ($role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                        <option value="staff" <?php echo ($role == 'staff') ? 'selected' : ''; ?>>Staff</option>
                    </select>
                </div>
                <button type="submit">Login</button>
                <div class="forgot-password">
                    <a href="forgot_password.php">Forgot Password?</a>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> University Transcript System. All rights reserved.</p>
    </footer>
</body>
</html>
