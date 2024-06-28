<?php
session_start();
require_once('../includes/db.php');
require_once('../includes/functions.php');

// Check if staff is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'staff') {
    redirect_to('../pages/login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric_no = $_POST['matric_no'];

    // Fetch student details
    $sql_student = "SELECT * FROM students WHERE matric_no = '$matric_no'";
    $result_student = $conn->query($sql_student);
    $student = $result_student->fetch_assoc();

    // Fetch grades
    $sql_grades = "SELECT * FROM grades WHERE matric_no = '$matric_no'";
    $result_grades = $conn->query($sql_grades);

    // Calculate CGPA
    $total_points = 0;
    $total_units = 0;
    while ($grade = $result_grades->fetch_assoc()) {
        $points = calculate_points($grade['grade']);
        $units = $grade['units'];
        $total_points += $points * $units;
        $total_units += $units;
    }
    $cgpa = $total_points / $total_units;
    $classification = classify_degree($cgpa);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transcript</title>
    <link rel="stylesheet" href="../../styles/main.css">
</head>
<body>
    <header>
        <h1>Transcript</h1>
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
        <h2>Transcript</h2>
        <?php if (isset($student)) { ?>
            <h3>Student Details</h3>
            <p>Full Name: <?php echo $student['full_name']; ?></p>
            <p>Matric No: <?php echo $student['matric_no']; ?></p>
            <p>Sex: <?php echo $student['sex']; ?></p>
            <p>Date of Birth: <?php echo $student['date_of_birth']; ?></p>
            <p>Department: <?php echo $student['department']; ?></p>
            <p>Faculty: <?php echo $student['faculty']; ?></p>

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
                    <?php 
                    $result_grades->data_seek(0); // Reset pointer to fetch grades again
                    while($grade = $result_grades->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $grade['course_code']; ?></td>
                        <td><?php echo $grade['course_title']; ?></td>
                        <td><?php echo $grade['grade']; ?></td>
                        <td><?php echo $grade['year']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <h3>CGPA: <?php echo number_format($cgpa, 2); ?></h3>
            <h3>Degree Classification: <?php echo $classification; ?></h3>

            <h3>Signatures</h3>
            <p>VC: ________________________</p>
            <p>Registrar: ________________________</p>
            <p>Dean: ________________________</p>
            <p>HOD: ________________________</p>
            <p>Exam Officer: ________________________</p>

        <?php } else { ?>
            <p>No student details found. Please try again.</p>
        <?php } ?>
    </main>
</body>
</html>
