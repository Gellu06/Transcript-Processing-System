<?php
session_start();
require_once('../../includes/db.php');
require_once('../../includes/functions.php');

// Check if admin is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    redirect_to('../login.php');
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $matric_no = $_POST['matric_no'];
    $jamb_no = $_POST['jamb_no'];
    $sex = $_POST['sex'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];
    $lga = $_POST['lga'];
    $town = $_POST['town'];
    $state = $_POST['state'];
    $nationality = $_POST['nationality'];
    $mobile_no = $_POST['mobile_no'];
    $year_of_admission = $_POST['year_of_admission'];
    $programme_type = $_POST['programme_type'];
    $department = $_POST['department'];
    $faculty = $_POST['faculty'];
    $marital_status = $_POST['marital_status'];
    $religion = $_POST['religion'];

    $sql = "INSERT INTO students (full_name, matric_no, jamb_no, sex, date_of_birth, address, lga, town, state, nationality, mobile_no, year_of_admission, programme_type, department, faculty, marital_status, religion) VALUES ('$full_name', '$matric_no', '$jamb_no', '$sex', '$date_of_birth', '$address', '$lga', '$town', '$state', '$nationality', '$mobile_no', '$year_of_admission', '$programme_type', '$department', '$faculty', '$marital_status', '$religion')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Student registered successfully.";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Student</title>
    <link rel="stylesheet" href="../../styles/main.css">
</head>
<body>
    <header>
        <h1>Register Student</h1>
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
        <h2>Register a New Student</h2>
        <?php if (isset($success_message)) echo "<p class='success'>$success_message</p>"; ?>
        <?php if (isset($error_message)) echo "<p class='error'>$error_message</p>"; ?>
        <form method="post" action="register_student.php">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>
            
            <label for="matric_no">Matric No:</label>
            <input type="text" id="matric_no" name="matric_no" required>
            
            <label for="jamb_no">JAMB No:</label>
            <input type="text" id="jamb_no" name="jamb_no" required>
            
            <label for="sex">Sex:</label>
            <select id="sex" name="sex" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>
            
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
            
            <label for="lga">LGA:</label>
            <input type="text" id="lga" name="lga" required>
            
            <label for="town">Town:</label>
            <input type="text" id="town" name="town" required>
            
            <label for="state">State:</label>
            <input type="text" id="state" name="state" required>
            
            <label for="nationality">Nationality:</label>
            <input type="text" id="nationality" name="nationality" required>
            
            <label for="mobile_no">Mobile No:</label>
            <input type="text" id="mobile_no" name="mobile_no" required>
            
            <label for="year_of_admission">Year of Admission:</label>
            <input type="number" id="year_of_admission" name="year_of_admission" required>
            
            <label for="programme_type">Programme Type:</label>
            <input type="text" id="programme_type" name="programme_type" required>
            
            <label for="department">Department:</label>
            <input type="text" id="department" name="department" required>
            
            <label for="faculty">Faculty:</label>
            <input type="text" id="faculty" name="faculty" required>
            
            <label for="marital_status">Marital Status:</label>
            <select id="marital_status" name="marital_status" required>
                <option value="single">Single</option>
                <option value="married">Married</option>
            </select>
            
            <label for="religion">Religion:</label>
            <input type="text" id="religion" name="religion" required>
            
            <input type="submit" value="Register Student">
        </form>
    </main>
</body>
</html>
