<?php
session_start();
require_once('../../includes/db.php');
require_once('../../includes/functions.php');

// Check if staff is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'staff') {
    redirect_to('../login.php');
}

// Fetch students
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Result</title>
    <link rel="stylesheet" href="../../styles/main.css">
</head>
<body>
    <header>
        <h1>Print Result</h1>
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
        <h2>Print Student Result</h2>
        <form method="post" action="generate_transcript.php">
            <label for="matric_no">Select Student:</label>
            <select id="matric_no" name="matric_no" required>
                <?php while($row = $result->fetch_assoc()) { ?>
                <option value="<?php echo $row['matric_no']; ?>"><?php echo $row['full_name'] . ' (' . $row['matric_no'] . ')'; ?></option>
                <?php } ?>
            </select>
            <input type="submit" value="Print Transcript">
        </form>
    </main>
</body>
</html>
