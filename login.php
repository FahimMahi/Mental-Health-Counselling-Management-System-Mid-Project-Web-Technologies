<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mental_health_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

$loginMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM patients WHERE username='$username'";
    $result = $conn->query($sql);

    if (empty($username) && empty($password)) {
        $loginMessage = "Username and Password are empty.";
    }
    elseif (empty($username)) {
        $loginMessage = "Username is empty.";
    }
    elseif (empty($password)) {
        $loginMessage = "Password is empty.";
    }
    elseif ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["patient_id"] = $row["id"];
            header("Location: dashboard.php");
            exit();
        }
        else {
            $loginMessage = "Invalid username and password.";
        }
    }
    else {
        $loginMessage = "Invalid username and password.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Login</title>
</head>
<body>
    <div style="background-image: url('img/login.jpg');background-size: 100% 850px; width: 100%; height: 850px">
        <div id="header"> <div id="logo">
        </div>
        <center>
            <br><br><br><br><br><br><br><br><br><br><br><br><br>
            <h1>Login</h1>

            <div style="color: red;"><?php echo $loginMessage; ?></div>

            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <fieldset>
                <br>
                <label for="username">Username:</label>
                <input type="text" name="username"><br> <br>

                <label for="password">Password:</label>
                <input type="password" name="password"><br><br>

                <input type="submit" value="Login">
            </fieldset>
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a>.</p>
        </center>
    </div>
</body>
</html>
