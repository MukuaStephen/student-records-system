<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'student_records');

// Create connection function
function getConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Get all students
function getAllStudents() {
    $conn = getConnection();
    $sql = "SELECT * FROM students ORDER BY id DESC";
    $result = $conn->query($sql);
    return $result;
}

// Get student by ID
function getStudentById($id) {
    $conn = getConnection();
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Add student
function addStudent($name, $age, $email) {
    $conn = getConnection();
    $sql = "INSERT INTO students (name, age, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis", $name, $age, $email);
    return $stmt->execute();
}

// Update student
function updateStudent($id, $name, $age, $email) {
    $conn = getConnection();
    $sql = "UPDATE students SET name = ?, age = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisi", $name, $age, $email, $id);
    return $stmt->execute();
}

// Delete student
function deleteStudent($id) {
    $conn = getConnection();
    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Search students
function searchStudents($keyword) {
    $conn = getConnection();
    $keyword = "%" . $keyword . "%";
    $sql = "SELECT * FROM students WHERE name LIKE ? OR email LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $keyword, $keyword);
    $stmt->execute();
    return $stmt->get_result();
}
?>