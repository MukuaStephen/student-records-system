<?php
require_once 'config/database.php';

// Get all students
$students = getAllStudents();

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="students_export_' . date('Y-m-d') . '.csv"');

// Create output stream
$output = fopen('php://output', 'w');

// Add headers
fputcsv($output, ['ID', 'Name', 'Age', 'Email', 'Created At']);

// Add data rows
while ($row = $students->fetch_assoc()) {
    fputcsv($output, [
        $row['id'],
        $row['name'],
        $row['age'],
        $row['email'],
        $row['created_at']
    ]);
}

// Close output stream
fclose($output);
exit();
?>