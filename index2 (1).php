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

// Retrieve form data from index.php
$rollNo = $_GET['rollNo'];
$labSubject = $_GET['labSubject'];

// Retrieve form data and insert into database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $sysNo = mysqli_real_escape_string($conn, $_POST['sys_no']);
    $startTime = mysqli_real_escape_string($conn, $_POST['startTime']);
    $endTime = mysqli_real_escape_string($conn, $_POST['endTime']);

    // Insert data into database
    $sql = "UPDATE attendance SET year='$year', semester='$semester', branch='$branch', sysNo='$sysNo', startTime='$startTime', endTime='$endTime' WHERE rollNo='$rollNo' AND labSubject='$labSubject'";

    if ($conn->query($sql) === TRUE) {
        echo "Attendance submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        
        h2 {
            font-size: 36px;
            margin-bottom: 20px;
            text-align: center;
        }

        #attendanceContainer {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            justify-content: center;
        }
        body {
    /* Set background image using a relative or absolute path */
    background-image: url('https://tse1.mm.bing.net/th?id=OIP.gM2RjYhqGF2QIx09-HGcWAHaEK&pid=Api&P=0&h=180');

    /* You can also use an image from a web URL */
    /* background-image: url('https://example.com/image.jpg'); */

    /* Specify background image size */
    background-size: cover; /* Cover the entire element */
    /* background-size: contain; */ /* Fit the image within the element */

    /* Specify background image repeat */
    background-repeat: no-repeat; /* Do not repeat the image */

    /* Specify background image position */
    background-position: center center; /* Center the image horizontally and vertically */
    /* background-position: left top; */ /* Align the image to the top left corner */
    /* background-position: right bottom; */ /* Align the image to the bottom right corner */

    /* Add additional styles */
    /* background-color: #f0f0f0; */ /* Fallback background color */
    /* opacity: 0.5; */ /* Set opacity for the background image */
    /* filter: blur(5px); */ /* Apply blur effect to the background image */
}


        #attendanceForm {
            margin:20px;
        
        }

        #timer {
            text-align: center;
            margin-bottom: 20px;
        }

        #startButton,
        #endButton,
        #submitButton {
            font-size: 24px;
            padding: 10px 20px;
            margin: 0 10px;
        }

        label {
            font-size: 20px;
            margin-bottom: 10px;
        }

        select,
        input[type="hidden"] {
            font-size: 20px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .attendence-btn{
            margin:10px;
            text-align:center;
            position: absolute;
            top:10px;
            right: 10px; /* Adjust as needed */

        }

        button {
            font-size: 20px;
            padding: 10px 20px;
        }
    </style>
</head>
<body>

<div id="attendanceContainer">
    <h2>Lab Attendance</h2>

    <div id="timer">
        <button id="startButton" onclick="startLab()">Start Lab</button>
        <button id="endButton" onclick="endLab()" disabled>End Lab</button>
        <span id="elapsedTime">00:00:00</span>
    </div>

    <form id="attendanceForm" style="display:none;" method="post"> 
        <div>
            <label for="year">Year:</label>
            <select id="year" name="year" required>
                <option value="">Select Year</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        <div>
            <label for="semester">Semester:</label>
            <select id="semester" name="semester" required>
                <option value="">Select Semester</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>
        <div>
            <label for="branch">Branch:</label>
            <select id="branch" name="branch" required>
                <option value="">Select Branch</option>
                <option value="Information Technology">Information Technology</option>
                <option value="Computer Science">Computer Science</option>
                <option value="Electrical Engineering">Electrical Engineering</option>
                <option value="Mechanical Engineering">Mechanical Engineering</option>
                <option value="Civil Engineering">Civil Engineering</option>
            </select>
        </div>
        <div>
            <label for="sys_no">System Number:</label>
            <select id="sys_no" name="sys_no" required>
                <option value="">System Number</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>
        <input type="hidden" id="startTime" name="startTime">
        <input type="hidden" id="endTime" name="endTime">
        <button type="submit" id="submitButton" disabled>Submit</button>
    </form>
</div>

<a href="attendance_details.php" style="text-align: center; ">
<div class="attendence-btn">
<button>View Attendance Details</button></a>
</div>

<script>
var labStartTime;
var interval;

function startLab() {
    var currentTime = new Date(); // Get current time in local timezone
    var currentTimeUTC = new Date(currentTime.getTime() + (currentTime.getTimezoneOffset() * 60000)); // Convert current time to UTC
    labStartTime = new Date(currentTimeUTC.getTime() + (330 + currentTimeUTC.getTimezoneOffset()) * 60000); // Add IST offset (330 minutes) and convert back to local time
    
    document.getElementById("startTime").value = labStartTime.toISOString();
    document.getElementById("startButton").disabled = true;
    document.getElementById("endButton").disabled = false;
    document.getElementById("attendanceForm").style.display = "block";
    interval = setInterval(updateTimer, 1000);
    setTimeout(endLabAutomatically, 3 * 60 * 60 * 1000); // End lab after 3 hours
}

function endLab() {
    clearInterval(interval);
    var currentTime = new Date(); // Get current time in local timezone
    var currentTimeUTC = new Date(currentTime.getTime() + (currentTime.getTimezoneOffset() * 60000)); // Convert current time to UTC
    var endTime = new Date(currentTimeUTC.getTime() + (330 + currentTimeUTC.getTimezoneOffset()) * 60000); // Add IST offset (330 minutes) and convert back to local time
    
    document.getElementById("endTime").value = endTime.toISOString();
    document.getElementById("endButton").disabled = true;
    document.getElementById("submitButton").disabled = false;
}

function endLabAutomatically() {
    clearInterval(interval);
    var currentTime = new Date(); // Get current time in local timezone
    var currentTimeUTC = new Date(currentTime.getTime() + (currentTime.getTimezoneOffset() * 60000)); // Convert current time to UTC
    var endTime = new Date(currentTimeUTC.getTime() + (330 + currentTimeUTC.getTimezoneOffset()) * 60000); // Add IST offset (330 minutes) and convert back to local time
    
    document.getElementById("endTime").value = endTime.toISOString();
    document.getElementById("endButton").disabled = true;
    document.getElementById("submitButton").disabled = false;
}

function updateTimer() {
    var currentTime = new Date(); // Get current time in local timezone
    var currentTimeUTC = new Date(currentTime.getTime() + (currentTime.getTimezoneOffset() * 60000)); // Convert current time to UTC
    var currentISTTime = new Date(currentTimeUTC.getTime() + (330 + currentTimeUTC.getTimezoneOffset()) * 60000); // Add IST offset (330 minutes) and convert back to local time
    
    var elapsedTime = new Date(currentISTTime - labStartTime);
    var hours = elapsedTime.getUTCHours();
    var minutes = elapsedTime.getUTCMinutes();
    var seconds = elapsedTime.getUTCSeconds();
    
    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;
    
    document.getElementById("elapsedTime").textContent = hours + ":" + minutes + ":" + seconds;
}
</script>

</body>
</html>

