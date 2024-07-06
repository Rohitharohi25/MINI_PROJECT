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

// Retrieve all attendance details from the database
$sql = "SELECT * FROM attendance";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Attendance Details</title>
<style>
  table {
    width: 100%;
    border-collapse: collapse;
  }
  table, th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
  }
</style>
</head>
<body>

<h2>Attendance Details</h2>

<table>
  <tr>
    <th>Roll No.</th>
    <th>Lab Subject</th>
    <th>Year</th>
    <th>Semester</th>
    <th>Branch</th>
    <th>System No.</th>
    <th>Start Time</th>
    <th>End Time</th>
  </tr>
  <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["rollNo"] . "</td>";
            echo "<td>" . $row["labSubject"] . "</td>";
            echo "<td>" . $row["year"] . "</td>";
            echo "<td>" . $row["semester"] . "</td>";
            echo "<td>" . $row["branch"] . "</td>";
            echo "<td>" . $row["sysNo"] . "</td>";
            echo "<td>" . $row["startTime"] . "</td>";
            echo "<td>" . $row["endTime"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }
  ?>
</table>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
