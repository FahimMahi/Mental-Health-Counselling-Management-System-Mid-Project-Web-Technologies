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

// Handle search for counselors
if (isset($_GET['searchCounselor'])) {
    $searchTerm = $_GET['searchCounselor'];
    $searchSql = "SELECT counselors.id, counselors.name, AVG(counselor_ratings.rating) AS average_rating
                  FROM counselors
                  LEFT JOIN counselor_ratings ON counselors.id = counselor_ratings.counselor_id
                  WHERE counselors.name LIKE '%$searchTerm%'
                  GROUP BY counselors.id, counselors.name";
    $searchResult = $conn->query($searchSql);

    $searchCounselorRatings = array();
    while ($row = $searchResult->fetch_assoc()) {
        $searchCounselorRatings[] = $row;
    }
} else {
    // If no search term provided, retrieve all ratings for counselors
    $sql = "SELECT counselors.id, counselors.name, AVG(counselor_ratings.rating) AS average_rating
            FROM counselors
            LEFT JOIN counselor_ratings ON counselors.id = counselor_ratings.counselor_id
            GROUP BY counselors.id, counselors.name";
    $result = $conn->query($sql);

    $counselorRatings = array();
    while ($row = $result->fetch_assoc()) {
        $counselorRatings[] = $row;
    }
}

// Handle search for all feedback
if (isset($_GET['searchAllFeedback'])) {
    $searchTermAllFeedback = $_GET['searchAllFeedback'];
    $searchSqlAllFeedback = "SELECT counselor_ratings.*, counselors.name AS counselor_name, patients.username AS client_username
                             FROM counselor_ratings
                             JOIN counselors ON counselor_ratings.counselor_id = counselors.id
                             JOIN patients ON counselor_ratings.client_id = patients.id
                             WHERE counselors.name LIKE '%$searchTermAllFeedback%'";
    $searchResultAllFeedback = $conn->query($searchSqlAllFeedback);

    $searchAllFeedbackData = array();
    while ($row = $searchResultAllFeedback->fetch_assoc()) {
        $searchAllFeedbackData[] = $row;
    }
} else {
    // If no search term provided, retrieve all feedback
    $sqlAllFeedback = "SELECT counselor_ratings.*, counselors.name AS counselor_name, patients.username AS client_username
                      FROM counselor_ratings
                      JOIN counselors ON counselor_ratings.counselor_id = counselors.id
                      JOIN patients ON counselor_ratings.client_id = patients.id";
    $resultAllFeedback = $conn->query($sqlAllFeedback);

    $allFeedbackData = array();
    while ($row = $resultAllFeedback->fetch_assoc()) {
        $allFeedbackData[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Average Ratings</title>
</head>
<body>
    <div style="background-image: url('img/others.jpg');background-size: 100% 900px; width: 100%; height: 900px">
    <div id="header"> <div id="logo">
    </div>
    <center>
        <br><br><br><br><br>
    <h1>Average Ratings for Counselors</h1>

    <!-- Search Form for Counselors -->
    <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="searchCounselor">Search Counselor:</label>
        <input type="text" name="searchCounselor" placeholder="Enter counselor's name">
        <input type="submit" value="Search">
    </form><br>

    <?php if (isset($searchCounselorRatings)): ?>
        <table border="1">
            <tr>
                <th>Counselor Name</th>
                <th>Average Rating</th>
            </tr>
            <?php foreach ($searchCounselorRatings as $rating): ?>
                <tr>
                    <td><?php echo $rating['name']; ?></td>
                    <td><?php echo ($rating['average_rating'] !== null) ? number_format($rating['average_rating'], 2) : 'N/A'; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <!-- Display all ratings for counselors if no search term -->
        <table border="1">
            <tr>
                <th>Counselor Name</th>
                <th>Average Rating</th>
            </tr>
            <?php foreach ($counselorRatings as $rating): ?>
                <tr>
                    <td><?php echo $rating['name']; ?></td>
                    <td><?php echo ($rating['average_rating'] !== null) ? number_format($rating['average_rating'], 2) : 'N/A'; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <br>
    <h2>All Feedback and Ratings for Every User</h2>

    <!-- Search Form for All Feedback -->
    <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="searchAllFeedback">Search All Feedback:</label>
        <input type="text" name="searchAllFeedback" placeholder="Enter counselor's name">
        <input type="submit" value="Search">
    </form><br>

    <?php if (isset($searchAllFeedbackData)): ?>
        <table border="1">
            <tr>
                <th>Counselor Name</th>
                <th>Client Username</th>
                <th>Rating</th>
                <th>Feedback</th>
            </tr>
            <?php foreach ($searchAllFeedbackData as $feedback): ?>
                <tr>
                    <td><?php echo $feedback['counselor_name']; ?></td>
                    <td><?php echo $feedback['client_username']; ?></td>
                    <td><?php echo $feedback['rating']; ?></td>
                    <td><?php echo ($feedback['feedback'] !== null) ? $feedback['feedback'] : 'No feedback available'; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <!-- Display all feedback if no search term -->
        <table border="1">
            <tr>
                <th>Counselor Name</th>
                <th>Client Username</th>
                <th>Rating</th>
                <th>Feedback</th>
            </tr>
            <?php foreach ($allFeedbackData as $feedback): ?>
                <tr>
                    <td><?php echo $feedback['counselor_name']; ?></td>
                    <td><?php echo $feedback['client_username']; ?></td>
                    <td><?php echo $feedback['rating']; ?></td>
                    <td><?php echo ($feedback['feedback'] !== null) ? $feedback['feedback'] : 'No feedback available'; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <br>
    <a href="dashboard.php">Back to Dashboard</a>
    </center>
</body>
</html>
