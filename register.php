<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mental_health_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    if (empty($_POST["password"])) {
        $errors[] = "Password is required.";
    }

    if (empty($name)) {
        $errors[] = "Full Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($phone)) {
        $errors[] = "Phone is required.";
    }

    // Display Validation Messages Only Beside the Form
    if (!empty($errors)) {
        // Validation failed, store errors to display beside the form
        $validationMessages = implode("<br>", $errors);
    } else {
        $sql = "INSERT INTO patients (username, password, name, email, phone)
                VALUES ('$username', '$password', '$name', '$email', '$phone')";

        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            $validationMessages = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Registration</title>
</head>
<body>
    <div style="background-image: url('img/reg.jpg');background-size: 100% 900px; width: 100%; height: 900px">
        <div id="header">
            <div id="logo"></div>
            <center>
                <br><br><br><br><br><br><br><br><br><br>
                <h1>Patient Registration</h1>

                <!-- Display Validation Messages Only Beside the Form -->
                <?php if (isset($validationMessages)): ?>
                    <div style="color: red;"><?php echo "Registration failed. Please fix the following:<br>"; echo $validationMessages; ?></div>
                <?php endif; ?>

                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <fieldset>
                        <br>
                        <label for="username">Username:</label>
                        <input type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>"><br><br>

                        <label for="password">Password:</label>
                        <input type="password" name="password"><br><br>

                        <label for="name">Full Name:</label>
                        <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>"><br><br>

                        <label for="email">Email:</label>
                        <input type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"><br><br>

                        <label for="phone">Phone:</label>
                        <input type="tel" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>"><br><br>

                        <input type="submit" value="Register"><br>
                    </fieldset>
                </form>
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </center>
        </div>
    </div>
</body>
</html>
