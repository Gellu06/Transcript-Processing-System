<?php
// error.php - Error page to display meaningful error messages

// Example error message (you can customize this based on your needs)
$error_message = "Oops! Something went wrong.";

// You can also receive error messages from query strings or session variables
if (isset($_GET['message'])) {
    $error_message = $_GET['message'];
}

// Example usage of session function (e.g., logout)
if (isset($_GET['logout'])) {
    logout();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .error-container {
            margin: 100px auto;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .error-message {
            font-size: 24px;
            color: red;
            margin-bottom: 20px;
        }
        .logout-link {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>Error</h1>
        <p class="error-message"><?php echo $error_message; ?></p>
        <a class="logout-link" href="logout.php">Logout</a> <!-- Example logout link -->
    </div>
</body>
</html>
