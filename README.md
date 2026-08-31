# Student Records Management System

A simple PHP-based student records management application for adding, viewing, updating, deleting, searching, and exporting student information.

## Overview

This project allows administrators to manage student records in a MySQL database through a clean web interface. It includes CRUD functionality, record search, and CSV export support.

## Features

- Add new student records
- View all student records in a table
- Update existing student details
- Delete student records with confirmation
- Search students by name or email
- Export student data to CSV
- Input validation for name, age, and email
- Responsive user interface

## Tech Stack

- PHP
- MySQL
- HTML
- CSS
- JavaScript (not required for core features)

## Project Structure

```text
student-records-system/
├── add_student.php
├── delete_student.php
├── export.php
├── index.php
├── update_student.php
├── LICENSE
├── README.md
├── assets/
├── config/
│   └── database.php
├── css/
├── screenshots/
├── sql/
│   ├── schema.sql
│   └── sample_data.sql
└── venv/
```

## Requirements

Before running this project, make sure you have:

- PHP 7.4 or later
- MySQL or MariaDB
- Apache or another local PHP server
- A browser such as Chrome, Firefox, or Edge

## Database Setup

1. Start MySQL and create the database.
2. Import the schema file:

```bash
mysql -u root -p < sql/schema.sql
```

3. Optionally, insert sample records:

```bash
mysql -u root -p < sql/sample_data.sql
```

4. Confirm the database name and connection details in [config/database.php](config/database.php).

The current configuration uses:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'student_records');
```

If your local MySQL uses a different username or password, update these values before running the app.

## Run the Application

1. Place the project folder in your local web server directory such as:
   - XAMPP: htdocs/
   - WAMP: www/
   - LAMP: /var/www/html/

2. Start Apache and MySQL.

3. Open the project in a browser:

```text
http://localhost/student-records-system/
```

or the corresponding path in your local server setup.

## Application Pages

### Home page

The main dashboard displays all students and includes:

- a search box
- add student button
- edit and delete actions for each record
- success alerts after create, update, and delete operations

### Add Student

This page allows you to add a new student with:

- full name
- age
- email address

It validates required fields and email format before inserting into the database.

### Update Student

This page lets you edit an existing student's information.

### Delete Student

This page confirms the student deletion before removing the record permanently.

### Export Records

The export page generates a CSV file containing all student records.

## Search Functionality

Users can search by:

- student name
- email address

The search is handled through the database query and filters results in real time.

## Validation Rules

The application validates the following:

- name is required
- age must be between 0 and 120
- email is required and must be valid
- duplicate email addresses are not allowed

## Screenshots

Screenshots for the project are stored in the [screenshots](screenshots) directory to document the user interface and project output.

## License

This project is licensed under the MIT License. See [LICENSE](LICENSE) for details.

## Notes

This project is a practical CRUD application intended for learning and small-scale record management workflows. It can be extended with features like pagination, authentication, user roles, and advanced reporting.
