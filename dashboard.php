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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Dashboard</title>
</head>
<body>
    <div style="background-image: url('img/dashboard.jpg');background-size: 100% 900px; width: 100%; height: 900px">
    <div id="header"> <div id="logo">
    </div>
    <center>
        <br><br><br><br><br><br><br><br><br><br><br><br>
    <center><h1>Welcome to Mental Health Counselling Management System!</h1></center>
    <h1>Dashboard</h1>
    <fieldset>
    <a href="update_profile.php">Update Profile</a><br>
    <a href="view_counselors.php">View Counselors</a><br>
    <a href="view_sessions.php">View Sessions</a><br>
    <a href="schedule_session.php">Schedule Session</a><br>
    <a href="cancel_session.php">Cancel Session</a><br>
    <a href="change_password.php">Change Password</a><br>
    <a href="rate_counselor.php">Give Rating and Feedback of Counselor</a><br>
    <a href="view_average_ratings.php">View Ratings and Feedback of Counselor</a><br>
    <a href="logout.php">Logout</a>
    </fieldset>
    </center>
</body>
</html>
