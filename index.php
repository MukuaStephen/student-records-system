<?php
require_once 'config/database.php';

// Get success/error messages
$message = '';
if (isset($_GET['success'])) {
    switch($_GET['success']) {
        case 'added':
            $message = '<div class="alert success"> Student added successfully!</div>';
            break;
        case 'updated':
            $message = '<div class="alert success"> Student updated successfully!</div>';
            break;
        case 'deleted':
            $message = '<div class="alert success"> Student deleted successfully!</div>';
            break;
    }
}

// Handle search
$students = null;
if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $students = searchStudents($keyword);
} else {
    $students = getAllStudents();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records Management System</title>
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
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
        }
        .header-actions {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .search-box {
            flex: 1;
            min-width: 200px;
        }
        .search-box input {
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }
        .search-box input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 10px rgba(102,126,234,0.3);
        }
        .btn {
            display: inline-block;
            padding: 10px 25px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-primary {
            background: #667eea;
            color: white;
        }
        .btn-primary:hover {
            background: #5a67d8;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102,126,234,0.4);
        }
        .btn-success {
            background: #10b981;
            color: white;
        }
        .btn-success:hover {
            background: #059669;
        }
        .btn-warning {
            background: #f59e0b;
            color: white;
        }
        .btn-warning:hover {
            background: #d97706;
        }
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        .btn-danger:hover {
            background: #dc2626;
        }
        .btn-sm {
            padding: 5px 15px;
            font-size: 14px;
        }
        .table-wrapper {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background: #667eea;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #e5e7eb;
        }
        tr:hover {
            background: #f9fafb;
        }
        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .alert.success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .empty-state {
            text-align: center;
            padding: 50px;
            color: #6b7280;
        }
        .badge {
            background: #e5e7eb;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            color: #374151;
        }
        .btn-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .total-records {
            margin-top: 20px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            .header-actions {
                flex-direction: column;
            }
            .actions {
                flex-direction: column;
            }
            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Records Management</h1>
        
        <?php echo $message; ?>
        
        <div class="header-actions">
            <div class="search-box">
                <form method="GET" action="">
                    <input type="text" name="search" placeholder="Search by name or email..." 
                           value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </form>
            </div>
            <div class="btn-group">
                <a href="index.php" class="btn btn-primary">View All</a>
                <a href="add_student.php" class="btn btn-success">Add New Student</a>
                <a href="export.php" class="btn btn-warning">Export CSV</a>
            </div>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($students && $students->num_rows > 0): ?>
                        <?php while($row = $students->fetch_assoc()): ?>
                            <tr>
                                <td><span class="badge">#<?php echo $row['id']; ?></span></td>
                                <td><strong><?php echo htmlspecialchars($row['name']); ?></strong></td>
                                <td><?php echo $row['age']; ?> years</td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                                <td>
                                    <div class="actions">
                                        <a href="update_student.php?id=<?php echo $row['id']; ?>" 
                                           class="btn btn-warning btn-sm"> Edit</a>
                                        <a href="delete_student.php?id=<?php echo $row['id']; ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Are you sure you want to delete this student?');"> Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <p> No students found. <a href="add_student.php">Add your first student</a></p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="total-records">
            Total Records: <?php echo $students ? $students->num_rows : 0; ?>
        </div>
    </div>
</body>
</html>