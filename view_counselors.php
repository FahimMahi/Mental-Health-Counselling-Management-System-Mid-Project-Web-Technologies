<?php
session_start();

if (!isset($_SESSION["patient_id"])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mental_health_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM counselors";
$result = $conn->query($sql);

$counselors = array();
while ($row = $result->fetch_assoc()) {
    $counselors[] = $row;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Counselors</title>
</head>
<body>
    <div style="background-image: url('img/others.jpg');background-size: 100% 900px; width: 100%; height: 900px">
    <div id="header"> <div id="logo">
    </div>
    <center>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h1>Available Counselors</h1>
    <fieldset>
    <ul>
        <?php foreach ($counselors as $counselor): ?>
            <li>Name: <?php echo $counselor['name']; ?> - Email: <?php echo $counselor['email']; ?> - Phone: <?php echo $counselor['phone']; ?></li>
        <?php endforeach; ?>
    </ul>
    </fieldset>
    <a href="dashboard.php">Back to Dashboard</a>
    </center>
</body>
</html>
