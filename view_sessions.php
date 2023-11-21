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

$patientId = $_SESSION["patient_id"];

$sql = "SELECT sessions.session_date, sessions.session_notes, counselors.name AS counselor_name
        FROM sessions
        JOIN counselors ON sessions.counselor_id = counselors.id
        WHERE sessions.client_id=$patientId";

$result = $conn->query($sql);

$sessions = array();
while ($row = $result->fetch_assoc()) {
    $sessions[] = $row;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Sessions</title>
</head>
<body>
    <div style="background-image: url('img/others.jpg');background-size: 100% 900px; width: 100%; height: 900px">
        <div id="header"> <div id="logo"></div>
    <center>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
            <h1>Your Counseling Sessions</h1>
            <fieldset>
            <ul>
                <?php foreach ($sessions as $session): ?>
                    <li>Date: <?php echo $session['session_date']; ?> - Notes: <?php echo $session['session_notes']; ?> - Counselor: <?php echo $session['counselor_name']; ?></li>
                <?php endforeach; ?>
            </ul>

            <a href="dashboard.php">Back to Dashboard</a>
        </div>
    </div>
    </fieldset>
    </center>
</body>
</html>
