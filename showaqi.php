<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.html");
    exit();
}

// Connect to the correct database
$conn = new mysqli("localhost", "root", "", "aqilist");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate city selection
if (!isset($_POST['cities']) || count($_POST['cities']) < 10) {
    echo "<script>alert('You must select at least 10 cities.'); window.location.href='request.php';</script>";
    exit();
}

$user_id = intval($_SESSION['user_id']);
$selectedCities = array_map('intval', $_POST['cities']);

$stmt_del = $conn->prepare("DELETE FROM user_selected_cities WHERE user_id = ?");
$stmt_del->bind_param("i", $user_id);
$stmt_del->execute();
$stmt_del->close();

$stmt_insert = $conn->prepare("INSERT IGNORE INTO user_selected_cities (user_id, city_id) VALUES (?, ?)");
foreach ($selectedCities as $city_id) {
    $stmt_insert->bind_param("ii", $user_id, $city_id);
    $stmt_insert->execute();
}
$stmt_insert->close();


$placeholders = implode(',', array_fill(0, count($selectedCities), '?'));
$query = "SELECT ID, CITY, COUNTRY, AQI FROM aqi WHERE ID IN ($placeholders)";
$stmt_select = $conn->prepare($query);


$stmt_select->bind_param(str_repeat('i', count($selectedCities)), ...$selectedCities);
$stmt_select->execute();
$result = $stmt_select->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Selected Cities</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(28, 46, 60);
            padding: 30px;
        }
        .container {
            background-color: rgb(255, 255, 255);
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 12px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Your Selected Cities</h2>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>City</th>
                <th>Country</th>
                <th>AQI</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['CITY']) ?></td>
                    <td><?= htmlspecialchars($row['COUNTRY']) ?></td>
                    <td><?= htmlspecialchars($row['AQI']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No cities found.</p>
    <?php endif; ?>
</div>
</body>
</html>
