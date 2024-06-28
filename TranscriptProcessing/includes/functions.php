<?php
function redirect_to($location) {
    header("Location: {$location}");
    exit;
}
require_once 'db.php';

function authenticate($username, $password, $role, $conn) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND role = ?");
    $stmt->bind_param("ss", $username, $role);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Verify hashed password
        if (password_verify($password, $row['password'])) {
            return $row; // Return the entire user row for further processing if needed
        }
    }
    return false;
}

function insert_student($conn, $full_name, $matric_no, $jamb_no, $sex, $date_of_birth, $address, $lga, $town, $state, $nationality, $mobile_no, $year_of_admission, $programme_type, $department, $faculty, $marital_status, $religion) {
    $sql = "INSERT INTO students (full_name, matric_no, jamb_no, sex, date_of_birth, address, lga, town, state, nationality, mobile_no, year_of_admission, programme_type, department, faculty, marital_status, religion)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssssssssssss', $full_name, $matric_no, $jamb_no, $sex, $date_of_birth, $address, $lga, $town, $state, $nationality, $mobile_no, $year_of_admission, $programme_type, $department, $faculty, $marital_status, $religion);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
function calculate_points($grade) {
    switch ($grade) {
        case 'A':
            return 5;
        case 'B':
            return 4;
        case 'C':
            return 3;
        case 'D':
            return 2;
        case 'E':
            return 1;
        case 'F':
            return 0;
        default:
            return 0;
    }
}

function classify_degree($cgpa) {
    if ($cgpa >= 4.5) {
        return 'First Class';
    } elseif ($cgpa >= 3.5) {
        return 'Second Class Upper';
    } elseif ($cgpa >= 2.5) {
        return 'Second Class Lower';
    } elseif ($cgpa >= 1.5) {
        return 'Third Class';
    } else {
        return 'Pass';
    }
}
?>

