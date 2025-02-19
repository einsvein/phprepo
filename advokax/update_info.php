<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $stay_abroad = isset($_POST['stay-abroad']) ? 1 : 0;
    $year_abroad = $_POST['year-abroad'];
    $country_abroad = $_POST['country-abroad'];
    $date_from = $_POST['date-from'];
    $days_origin = $_POST['days-origin'];
    $days_abroad = $_POST['days-abroad'];
    $user_id = $_SESSION['user_id'];

    // Database connection
    $servername = "localhost";
    $username = "your_username";
    $password_db = "your_password";
    $dbname = "your_database";

    $conn = new mysqli($servername, $username, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE user_info SET name='$name', email='$email', country='$country', stay_abroad='$stay_abroad', year_abroad='$year_abroad', country_abroad='$country_abroad', date_from='$date_from', days_origin='$days_origin', days_abroad='$days_abroad' WHERE user_id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
