<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information Form</title>
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
</<body>
    <h1>User Information Form</h1>
    <form method="post" action="submit_info.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="country">Country of Origin:</label>
        <input type="text" id="country" name="country" required><br><br>

        <label for="stay-abroad">Have you stayed abroad?</label>
        <input type="checkbox" id="stay-abroad" name="stay-abroad" onclick="toggleAbroadInfo()"><br><br>

        <div id="abroad-info" class="abroad-info">
            <label for="year-abroad">Year Abroad:</label>
            <input type="number" id="year-abroad" name="year-abroad"><br><br>

            <label for="country-abroad">Country Stayed In:</label>
            <input type="text" id="country-abroad" name="country-abroad"><br><br>

            <label for="date-from">From Date:</label>
            <input type="date" id="date-from" name="date-from"><br><br>

            <label for="days-origin">Days in Country of Origin:</label>
            <input type="number" id="days-origin" name="days-origin"><br><br>

            <label for="days-abroad">Days in Country Abroad:</label>
            <input type="number" id="days-abroad" name="days-abroad"><br><br>
        </div>

        <input type="submit" value="Submit">
    </form>

    <?php
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

        $sql = "INSERT INTO user_info (user_id, name, email, country, stay_abroad, year_abroad, country_abroad, date_from, days_origin, days_abroad)
                VALUES ('$user_id', '$name', '$email', '$country', '$stay_abroad', '$year_abroad', '$country_abroad', '$date_from', '$days_origin', '$days_abroad')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>
