<?php
session_start();
require_once('../includes/db.php');
require_once('../includes/functions.php');

// Check if admin is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    redirect_to('../pages/login.php');
}

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

    $sql = "INSERT INTO students (full_name, matric_no, jamb_no, sex, date_of_birth, address, lga, town, state, nationality, mobile_no, year_of_admission, programme_type, department, faculty, marital_status, religion)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssssssssssss', $full_name, $matric_no, $jamb_no, $sex, $date_of_birth, $address, $lga, $town, $state, $nationality, $mobile_no, $year_of_admission, $programme_type, $department, $faculty, $marital_status, $religion);

    if ($stmt->execute()) {
        redirect_to('../admin/view_student_details.php');
    } else {
        redirect_to('../pages/error.php?message=Error registering student');
    }
} else {
    redirect_to('../admin/register_student.php');
}
?>
