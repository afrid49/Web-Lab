<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "aqilist");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #1d2b64, #f8cdda);
        background-attachment: fixed;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }
    .container {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        border-radius: 20px;
        padding: 40px;
        max-width: 950px;
        width: 100%;
        color: #fff;
    }
    h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
        color: #ffffff;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    }
    i {
        margin-right: 8px;
    }
    button {
        padding: 10px 20px;
        background: linear-gradient(135deg, #ff416c, #ff4b2b);
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 30px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 30px;
    }
    button:hover {
        background: linear-gradient(135deg, #ff4b2b, #ff416c);
        transform: scale(1.05);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.3);
        margin-top: 10px;
    }
    th, td {
        padding: 15px 18px;
        text-align: left;
        backdrop-filter: blur(8px);
    }
    th {
        background-color: rgba(0, 123, 255, 0.8);
        color: #fff;
    }
    tr:nth-child(even) {
        background-color: rgba(255, 255, 255, 0.05);
    }
    tr:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transition: background-color 0.2s ease-in-out;
    }
    p {
        text-align: center;
        font-size: 18px;
        color: #fff;
        margin-top: 20px;
    }
    .logout-container {
        text-align: center;
    }
</style>
</head>
<body>
<div class="container">
    <h2><i class="fas fa-city"></i> Your Selected Cities</h2>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th><i class="fas fa-city"></i> City</th>
                <th><i class="fas fa-flag"></i> Country</th>
                <th><i class="fas fa-smog"></i> AQI</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['CITY']) ?></td>
                    <td><?= htmlspecialchars($row['COUNTRY']) ?></td>
                    <td><i class="fas fa-smog"></i> <?= htmlspecialchars($row['AQI']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No cities found.</p>
    <?php endif; ?>

    <div class="logout-container">
    <form action="logout.php" method="post" style="display: inline;">
        <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
    </form>
    <a href="request.php" style="text-decoration: none;">
        <button type="button" style="margin-left: 10px; background: #6c757d;">
            <i class="fas fa-arrow-left"></i> Back
        </button>
    </a>
</div>
</div>
</body>
</html>