<?php
session_start();
require_once('../../includes/db.php');
require_once('../../includes/functions.php');

// Check if staff is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'staff') {
    redirect_to('../login.php');
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric_no = $_POST['matric_no'];

    $sql_student = "SELECT * FROM students WHERE matric_no = '$matric_no'";
    $result_student = $conn->query($sql_student);

    $sql_grades = "SELECT * FROM grades WHERE matric_no = '$matric_no'";
    $result_grades = $conn->query($sql_grades);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Query Result</title>
    <link rel="stylesheet" href="../../styles/main.css">
</head>
<body>
    <header>
        <h1>Query Result</h1>
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
        <h2>Query Student Result</h2>
        <form method="post" action="query_result.php">
            <label for="matric_no">Matric No:</label>
            <input type="text" id="matric_no" name="matric_no" required>
            <input type="submit" value="Query">
        </form>

        <?php if (isset($result_student) && $result_student->num_rows > 0) { ?>
            <?php $student = $result_student->fetch_assoc(); ?>
            <h3>Student Details</h3>
            <p>Full Name: <?php echo $student['full_name']; ?></p>
            <p>Matric No: <?php echo $student['matric_no']; ?></p>
            <p>Sex: <?php echo $student['sex']; ?></p>
            <p>Date of Birth: <?php echo $student['date_of_birth']; ?></p>
            <p>Department: <?php echo $student['department']; ?></p>
            <p>Faculty: <?php echo $student['faculty']; ?></p>

            <?php if (isset($result_grades) && $result_grades->num_rows > 0) { ?>
                <h3>Grades</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Grade</th>
                            <th>Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($grade = $result_grades->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $grade['course_code']; ?></td>
                            <td><?php echo $grade['course_title']; ?></td>
                            <td><?php echo $grade['grade']; ?></td>
                            <td><?php echo $grade['year']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No grades found for this student.</p>
            <?php } ?>
        <?php } else if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
            <p>No student found with the provided Matric No.</p>
        <?php } ?>
    </main>
</body>
</html>
