<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mental_health_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getCounselors($conn)
{
    $sql = "SELECT * FROM counselors";
    $result = $conn->query($sql);

    $counselors = array();
    while ($row = $result->fetch_assoc()) {
        $counselors[] = $row;
    }

    return $counselors;
}

function getClients($conn)
{
    $sql = "SELECT * FROM clients";
    $result = $conn->query($sql);

    $clients = array();
    while ($row = $result->fetch_assoc()) {
        $clients[] = $row;
    }

    return $clients;
}

function scheduleSession($conn, $counselorId, $clientId, $sessionDate, $sessionNotes)
{
    $sql = "INSERT INTO sessions (counselor_id, client_id, session_date, session_notes)
            VALUES ($counselorId, $clientId, '$sessionDate', '$sessionNotes')";

    if ($conn->query($sql) === TRUE) {
        return true;
    }
    else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

$counselors = getCounselors($conn);
$clients = getClients($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $counselorId = $_POST["counselor"];
    $clientId = $_POST["client"];
    $sessionDate = $_POST["session_date"];
    $sessionNotes = $_POST["session_notes"];

    $result = scheduleSession($conn, $counselorId, $clientId, $sessionDate, $sessionNotes);

    if ($result === true) {
        echo "Session scheduled successfully.";
    } else {
        echo "Error: " . $result;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mental Health Counseling Management System</title>
</head>
<body>
    <h1>Schedule a Counseling Session</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="counselor">Counselor:</label>
        <select name="counselor" required>
            <?php foreach ($counselors as $counselor): ?>
                <option value="<?php echo $counselor['id']; ?>"><?php echo $counselor['name']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="client">Client:</label>
        <select name="client" required>
            <?php foreach ($clients as $client): ?>
                <option value="<?php echo $client['id']; ?>"><?php echo $client['name']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="session_date">Session Date:</label>
        <input type="date" name="session_date" required><br>

        <label for="session_notes">Session Notes:</label>
        <textarea name="session_notes" rows="4" required></textarea><br>

        <input type="submit" value="Schedule Session">
    </form>
</body>
</html>
