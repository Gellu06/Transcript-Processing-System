<?php
require_once('includes/init.php');

// Verify token and handle password reset
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token'])) {
    $token = $_GET['token'];
    $user = find_user_by_token($token, $conn);

    if ($user) {
        // Token is valid, allow password reset
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            // Validate and process password reset
            if ($new_password === $confirm_password) {
                // Update user's password in the database
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                update_user_password($user['id'], $hashed_password, $conn);

                // Clear the reset token after successful password reset
                clear_reset_token($user['email'], $conn);

                // Redirect to login page or show success message
                header('Location: login.php');
                exit();
            } else {
                $error_message = "Passwords do not match";
            }
        }
    } else {
        // Invalid or expired token, handle accordingly (redirect or show error)
        // Example: Redirect to forgot password page with an error message
        header('Location: forgot_password.php?error=invalid_token');
        exit();
    }
} else {
    // Token parameter not provided or invalid request method, handle accordingly
    // Example: Redirect to forgot password page with an error message
    header('Location: forgot_password.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles/main.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <h1>University Transcript System</h1>
    </header>
    <main>
        <h2>Reset Password</h2>
        <?php if (isset($error_message)) { ?>
            <div class="error">
                <p><?php echo $error_message; ?></p>
            </div>
        <?php } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?token=' . $token; ?>" method="post">
            <div>
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit">Reset Password</button>
        </form>
    </main>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> University Transcript System. All rights reserved.</p>
    </footer>
</body>
</html>
