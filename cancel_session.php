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

$patientId = $_SESSION["patient_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sessionId = $_POST["session_id"];

    $sql = "DELETE FROM sessions WHERE id=$sessionId AND client_id=$patientId";

    if ($conn->query($sql) === TRUE) {
        echo "Session canceled successfully.";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM sessions WHERE client_id=$patientId";
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
    <title>Cancel Counseling Session</title>
</head>
<body>
    <div style="background-image: url('img/others.jpg');background-size: 100% 900px; width: 100%; height: 900px">
    <div id="header"> <div id="logo">
    </div>
    <center>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h1>Your Counseling Sessions</h1>
    <fieldset>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="session_id">Select Session to Cancel:</label>
        <select name="session_id" required>
            <?php foreach ($sessions as $session): ?>
                <option value="<?php echo $session['id']; ?>"><?php echo $session['session_date']; ?> - <?php echo $session['session_notes']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="submit" value="Cancel Session">
    </form>
    </fieldset>
    <a href="dashboard.php">Back to Dashboard</a>
    </center>
</body>
</html>
