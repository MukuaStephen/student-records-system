-- Use the database
USE student_records;

-- Insert sample records
INSERT INTO students (name, age, email) VALUES 
('John Doe', 20, 'john.doe@example.com'),
('Jane Smith', 22, 'jane.smith@example.com'),
('Michael Johnson', 21, 'michael.j@example.com'),
('Sarah Williams', 23, 'sarah.w@example.com'),
('David Brown', 19, 'david.brown@example.com'),
('Emily Davis', 24, 'emily.d@example.com'),
('James Wilson', 20, 'james.w@example.com'),
('Lisa Martinez', 22, 'lisa.m@example.com'),
('Robert Taylor', 21, 'robert.t@example.com'),
('Maria Garcia', 23, 'maria.g@example.com');

-- Verify insertion
SELECT COUNT(*) as total_students FROM students;

-- View all records
SELECT * FROM students ORDER BY id;