<?php
session_start();
require_once('../../includes/db.php');
require_once('../../includes/functions.php');

// Check if admin is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
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
    <title>View Student Details</title>
    <link rel="stylesheet" href="../../styles/main.css">
</head>
<body>
    <header>
        <h1>View Student Details</h1>
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
        <h2>Student Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Matric No</th>
                    <th>JAMB No</th>
                    <th>Sex</th>
                    <th>Date of Birth</th>
                    <th>Address</th>
                    <th>LGA</th>
                    <th>Town</th>
                    <th>State</th>
                    <th>Nationality</th>
                    <th>Mobile No</th>
                    <th>Year of Admission</th>
                    <th>Programme Type</th>
                    <th>Department</th>
                    <th>Faculty</th>
                    <th>Marital Status</th>
                    <th>Religion</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['matric_no']; ?></td>
                    <td><?php echo $row['jamb_no']; ?></td>
                    <td><?php echo $row['sex']; ?></td>
                    <td><?php echo $row['date_of_birth']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['lga']; ?></td>
                    <td><?php echo $row['town']; ?></td>
                    <td><?php echo $row['state']; ?></td>
                    <td><?php echo $row['nationality']; ?></td>
                    <td><?php echo $row['mobile_no']; ?></td>
                    <td><?php echo $row['year_of_admission']; ?></td>
                    <td><?php echo $row['programme_type']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo $row['faculty']; ?></td>
                    <td><?php echo $row['marital_status']; ?></td>
                    <td><?php echo $row['religion']; ?></td>
                    <td>
                        <a href="edit_student.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="delete_student.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>
