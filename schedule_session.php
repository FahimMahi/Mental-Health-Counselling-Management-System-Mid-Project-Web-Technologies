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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $counselorId = $_POST["counselor"];
    $sessionDate = $_POST["session_date"];
    $sessionNotes = $_POST["session_notes"];
    $patientId = $_SESSION["patient_id"];

    $sql = "INSERT INTO sessions (counselor_id, client_id, session_date, session_notes)
            VALUES ($counselorId, $patientId, '$sessionDate', '$sessionNotes')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success-message'>Session scheduled successfully.</p>";
    } else {
        echo "<p class='error-message'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

// Fetch counselors
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
    <title>Schedule a Counseling Session</title>
</head>
<body>
    <div style="background-image: url('img/others.jpg');background-size: 100% 900px; width: 100%; height: 900px">
    <div id="header"> <div id="logo">
    </div>
    <center>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h1>Schedule a Counseling Session</h1>
    <fieldset>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="counselor">Counselor:</label>
        <select name="counselor" required>
            <?php foreach ($counselors as $counselor): ?>
                <option value="<?php echo $counselor['id']; ?>"><?php echo $counselor['name']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="session_date">Session Date:</label>
        <input type="date" name="session_date" required><br><br>

        <label for="session_notes">Session Notes:</label>
        <textarea name="session_notes" rows="4" required></textarea><br><br>

        <input type="submit" value="Schedule Session"><br>
    </form>
    </fieldset>
    <a href="dashboard.php">Back to Dashboard</a>
    </center>
</body>
</html>
