-- Create database
CREATE DATABASE IF NOT EXISTS university_transcript_system;

-- Use the created database
USE university_transcript_system;

-- Table for users (admins and staff)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'staff') NOT NULL
);

-- Insert sample admin and staff users
INSERT INTO users (username, password, role) VALUES 
('admin', '$2y$10$E1N/2q0sd6Z.8EzDZ1Z6UuTYuwFIfk7Tlbkeoe/EzEC7ZdqEQ5.yK', 'admin'), -- password: password
('staff1', '$2y$10$E1N/2q0sd6Z.8EzDZ1Z6UuTYuwFIfk7Tlbkeoe/EzEC7ZdqEQ5.yK', 'staff'); -- password: password

-- Table for students
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    matric_no VARCHAR(50) NOT NULL UNIQUE,
    jamb_no VARCHAR(50) NOT NULL UNIQUE,
    sex ENUM('male', 'female') NOT NULL,
    date_of_birth DATE NOT NULL,
    address VARCHAR(255) NOT NULL,
    lga VARCHAR(50) NOT NULL,
    town VARCHAR(50) NOT NULL,
    state VARCHAR(50) NOT NULL,
    nationality VARCHAR(50) NOT NULL,
    mobile_no VARCHAR(20) NOT NULL,
    year_of_admission YEAR NOT NULL,
    programme_type VARCHAR(50) NOT NULL,
    department VARCHAR(50) NOT NULL,
    faculty VARCHAR(50) NOT NULL,
    marital_status ENUM('single', 'married') NOT NULL,
    religion VARCHAR(50) NOT NULL
);

-- Insert sample students
INSERT INTO students (full_name, matric_no, jamb_no, sex, date_of_birth, address, lga, town, state, nationality, mobile_no, year_of_admission, programme_type, department, faculty, marital_status, religion) VALUES
('John Doe', '202001', 'JAMB2020001', 'male', '2000-01-01', '123 Main St', 'Ikeja', 'Lagos', 'Lagos', 'Nigerian', '08012345678', 2020, 'Undergraduate', 'Computer Science', 'Science', 'single', 'Christianity'),
('Jane Smith', '202002', 'JAMB2020002', 'female', '1999-02-02', '456 Elm St', 'Surulere', 'Lagos', 'Lagos', 'Nigerian', '08087654321', 2020, 'Undergraduate', 'Mathematics', 'Science', 'single', 'Islam');

-- Table for staff
CREATE TABLE IF NOT EXISTS staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staff_name VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email_id VARCHAR(100) NOT NULL,
    mobile_no VARCHAR(20) NOT NULL
);

-- Insert sample staff
INSERT INTO staff (staff_name, username, password, address, email_id, mobile_no) VALUES
('Staff Member 1', 'staff1', '$2y$10$E1N/2q0sd6Z.8EzDZ1Z6UuTYuwFIfk7Tlbkeoe/EzEC7ZdqEQ5.yK', '789 Pine St', 'staff1@example.com', '08011112222'); -- password: password

-- Table for courses
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_code VARCHAR(10) NOT NULL UNIQUE,
    course_name VARCHAR(100) NOT NULL,
    department VARCHAR(50) NOT NULL,
    faculty VARCHAR(50) NOT NULL
);

-- Insert sample courses
INSERT INTO courses (course_code, course_name, department, faculty) VALUES
('CSC101', 'Introduction to Computer Science', 'Computer Science', 'Science'),
('MTH101', 'Calculus I', 'Mathematics', 'Science');

-- Table for grades
CREATE TABLE IF NOT EXISTS grades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    year INT NOT NULL,
    semester ENUM('1', '2','3','4') NOT NULL,
    grade ENUM('A', 'B', 'C', 'D', 'F') NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

-- Insert sample grades
INSERT INTO grades (student_id, course_id, year, semester, grade) VALUES
((SELECT id FROM students WHERE matric_no = '202001'), (SELECT id FROM courses WHERE course_code = 'CSC101'), 2020, '1', 'A'),
((SELECT id FROM students WHERE matric_no = '202002'), (SELECT id FROM courses WHERE course_code = 'MTH101'), 2020, '1', 'B');

-- Table for results (to store calculated CGPA and classifications)
CREATE TABLE IF NOT EXISTS results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    cgpa DECIMAL(3, 2) NOT NULL,
    classification ENUM('First Class', 'Second Class Upper', 'Second Class Lower', 'Third Class', 'Pass', 'Fail') NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id)
);

-- Insert sample results
INSERT INTO results (student_id, cgpa, classification) VALUES
((SELECT id FROM students WHERE matric_no = '202001'), 4.75, 'First Class'),
((SELECT id FROM students WHERE matric_no = '202002'), 3.45, 'Second Class Lower');
