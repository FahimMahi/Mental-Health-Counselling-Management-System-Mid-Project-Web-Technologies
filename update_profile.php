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
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $sql = "UPDATE patients SET name='$name', email='$email', phone='$phone' WHERE id=$patientId";

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM patients WHERE id=$patientId";
$result = $conn->query($sql);
$patient = $result->fetch_assoc();

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Profile</title>
</head>
<body>
    <div style="background-image: url('img/others.jpg');background-size: 100% 900px; width: 100%; height: 900px">
    <div id="header"> <div id="logo">
    </div>
    <center>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h1>Update Your Profile</h1>
    <fieldset>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Full Name:</label>
        <input type="text" name="name" value="<?php echo $patient['name']; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $patient['email']; ?>" required><br><br>

        <label for="phone">Phone:</label>
        <input type="tel" name="phone" value="<?php echo $patient['phone']; ?>" required><br><br>

        <input type="submit" value="Update Profile"><br>
    </form>
    </fieldset>
    <a href="dashboard.php">Back to Dashboard</a>
    </center>
</body>
</html>
