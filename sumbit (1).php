<?php
// Database configuration
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "attendance"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$rollNo = $_GET['rollNo']; // Assuming rollNo is sent via GET method
$labSubject = $_GET['labSubject']; // Assuming labSubject is sent via GET method
$year = $_POST['year'];
$semester = $_POST['semester'];
$branch = $_POST['branch'];
$sysNo = $_POST['sysNo'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];

// Insert data into database
$sql = "INSERT INTO attendancerecords(rollNo, labSubject, year, semester, branch, sysNo, startTime, endTime)
        VALUES ('$rollNo', '$labSubject', '$year', '$semester', '$branch', '$sysNo', '$startTime', '$endTime')";

if ($conn->query($sql) === TRUE) {
    echo "Attendance submitted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
