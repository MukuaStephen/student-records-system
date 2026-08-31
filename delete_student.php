<?php
require_once 'config/database.php';

// Check if ID is provided
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = (int)$_GET['id'];
$student = getStudentById($id);

if (!$student) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
        if (deleteStudent($id)) {
            header("Location: index.php?success=deleted");
            exit();
        }
    } else {
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            text-align: center;
        }
        .warning-icon {
            font-size: 80px;
            margin-bottom: 20px;
            color: #ef4444;
        }
        h1 {
            color: #ef4444;
            margin-bottom: 20px;
        }
        .student-info {
            background: #fef2f2;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #ef4444;
        }
        .student-info p {
            margin: 5px 0;
        }
        .student-info strong {
            color: #991b1b;
        }
        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 16px;
            flex: 1;
        }
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239,68,68,0.4);
        }
        .btn-secondary {
            background: #6b7280;
            color: white;
        }
        .btn-secondary:hover {
            background: #4b5563;
        }
        .warning-text {
            color: #6b7280;
            font-size: 14px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="warning-icon">!</div>
        <h1>Delete Student Record</h1>
        <p style="color: #6b7280; margin-bottom: 20px;">Are you sure you want to delete this student record?</p>
        
        <div class="student-info">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($student['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?></p>
            <p><strong>Age:</strong> <?php echo $student['age']; ?> years</p>
        </div>
        
        <p class="warning-text">This action cannot be undone!</p>
        
        <form method="POST" action="">
            <div class="btn-group">
                <button type="submit" name="confirm" value="yes" class="btn btn-danger">Delete Permanently</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>