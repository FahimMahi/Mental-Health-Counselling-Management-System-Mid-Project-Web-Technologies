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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $counselorId = $_POST["counselor_id"];
    $rating = $_POST["rating"];
    $feedback = $_POST["feedback"];

    if ($rating >= 1 && $rating <= 5) {
        $sql = "INSERT INTO counselor_ratings (counselor_id, client_id, rating, feedback)
                VALUES ($counselorId, $patientId, $rating, '$feedback')";

        if ($conn->query($sql) === TRUE) {
            echo "Rating submitted successfully.";
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid rating. Please provide a rating between 1 and 5.";
    }
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
    <title>Rate Counselor</title>
</head>
<body>
    <div style="background-image: url('img/others.jpg');background-size: 100% 900px; width: 100%; height: 900px">
    <div id="header"> <div id="logo">
    </div>
    <center>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h1>Rate Your Counselor</h1>
    <fieldset>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="counselor_id">Select Counselor:</label>
        <select name="counselor_id" required>
            <?php foreach ($counselors as $counselor): ?>
                <option value="<?php echo $counselor['id']; ?>"><?php echo $counselor['name']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required><br><br>

        <label for="feedback">Feedback:</label>
        <textarea name="feedback" rows="4" required></textarea><br><br>

        <input type="submit" value="Submit Rating"><br>
    </form>
    </fieldset>
    <a href="dashboard.php">Back to Dashboard</a>
    </center>
</body>
</html>
