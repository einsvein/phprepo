<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM user_info WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No information found.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Information</title>
    <style>
        .abroad-info {
            display: none;
        }
    </style>
    <script>
        function toggleAbroadInfo() {
            var abroadInfo = document.getElementById('abroad-info');
            var checkbox = document.getElementById('stay-abroad');
            abroadInfo.style.display = checkbox.checked ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <h1>Edit Information</h1>
    <form method="post" action="update_info.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>

        <label for="country">Country of Origin:</label>
        <input type="text" id="country" name="country" value="<?php echo $row['country']; ?>" required><br><br>

        <label for="stay-abroad">Have you stayed abroad?</label>
        <input type="checkbox" id="stay-abroad" name="stay-abroad" onclick="toggleAbroadInfo()" <?php echo $row['stay_abroad'] ? 'checked' : ''; ?>><br><br>

        <div id="abroad-info" class="abroad-info" style="<?php echo $row['stay_abroad'] ? 'display:block;' : 'display:none;'; ?>">
            <label for="year-abroad">Year Abroad:</label>
            <input type="number" id="year-abroad" name="year-abroad" value="<?php echo $row['year_abroad']; ?>"><br><br>

            <label for="country-abroad">Country Stayed In:</label>
            <input type="text" id="country-abroad" name="country-abroad" value="<?php echo $row['country_abroad']; ?>"><br><br>

            <label for="date-from">From Date:</label>
            <input type="date" id="date-from" name="date-from" value="<?php echo $row['date_from']; ?>"><br><br>

            <label for="days-origin">Days in Country of Origin:</label>
            <input type="number" id="days-origin" name="days-origin" value="<?php echo $row['days_origin']; ?>"><br><br>

            <label for="days-abroad">Days in Country Abroad:</label>
            <input type="number" id="days-abroad" name="days-abroad" value="<?php echo $row['days_abroad']; ?>"><br><br>
        </div>

        <input type="submit" value="Update">
    </form>
</body>
</html>
