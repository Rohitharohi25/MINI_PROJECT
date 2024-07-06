<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Attendance Automation System for Lab</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0; /* Set background color */
            display: flex;
            flex-direction: column; /* Align items in a column */
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .logo-img {
    padding:0px 0px;
    margin: left 0px;
    float:left;
}

.logo-img img {
    transform:translate(-20%,-7%);
    height: 5rem;
    border-radius:50%;
    width:5rem;
    margin-left:-280px;
}
        
        .heading {
            color: #333; /* Set text color */
            text-align: center;
            font-weight: bold; /* Make the text bold */
            font-size: 48px; /* Increase font size */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Add shadow effect */
            margin-bottom: 20px; /* Add space below the title */
            margin-top: 20px; /* Add space above the title */
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-weight: bold; /* Make text bold */
            text-align: center;
        }

        form {
            margin-top: 20px; /* Add space above the form */
        }

        input[type="text"],
        select {
            width: 300px; /* Increase width of input and select */
            padding: 10px; /* Add padding */
            font-size: 16px; /* Increase font size */
            margin-bottom: 10px; /* Add space below each input */
        }

        button {
            margin-top: 20px; /* Add space above the button */
            font-weight: bold; /* Make the button text bold */
            font-size: 20px; /* Increase button text size */
        }
        body {
    /* Set background image using a relative or absolute path */
    background-image: url('https://tse1.mm.bing.net/th?id=OIP.gM2RjYhqGF2QIx09-HGcWAHaEK&pid=Api&P=0&h=180');

    background-size: cover; 

    background-repeat: no-repeat; 

    background-position: center center; 
        }


    </style>
</head>
<body>
<header>
    <div class="container">
            <div class="logo">
                <img height=280px src="SAASLOGO.png" alt="Logo">
            </div>
            <!---------Name of the Website-------->
    </div>
</header>
<h1 class="heading">Students Attendance Automation System for Lab</h1>

<div class="container">
    <form id="attendanceForm" method="post"> <!-- Removed action attribute -->
        <input type="text" name="rollNo" id="rollNoInput" placeholder="Enter Roll No.">
        <select name="labSubject" id="labSubjectSelect">
            <option value="" selected disabled>Select Lab Subject</option>
            <option value="Foss Lab">Foss Lab</option>
            <option value="Uml Lab">Uml Lab</option>
            <option value="Java Lab">JavaLab</option>
            <option value="MongoDB Lab">MongoDB Lab</option>
            <option value="Stat with R Lab">Stat with RLab</option>
            <!-- Add more lab subjects as needed -->
        </select>
        <button  type="submit">NEXT</button> <!-- Changed type to submit -->
    </form>
</div>

</body>
</html>

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

// Retrieve form data and insert into database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rollNo = $_POST['rollNo'];
    $labSubject = $_POST['labSubject'];

    // Insert data into database
    $sql = "INSERT INTO attendance (rollNo, labSubject) VALUES ('$rollNo', '$labSubject')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to index2.php
        header("Location: index2.php?rollNo=$rollNo&labSubject=$labSubject");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
