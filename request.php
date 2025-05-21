<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Cities</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(6, 61, 116);
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: white;
            max-width: 700px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .city-list {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .city-list label {
            display: block;
            padding: 10px;
            background-color: #f9f9f9;
            margin-bottom: 10px;
            border-radius: 5px;
            border-left: 5px solid #007bff;
            cursor: pointer;
        }
        button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color:rgb(16, 47, 80);
        }
    </style>
</head>
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

// Fetch city data from 'aqi' table
$result = $conn->query("SELECT * FROM aqi LIMIT 20");
?>
<body>
<div class="container">
    <h2>Please select at least 10 cities</h2>

    <?php if ($result->num_rows > 0): ?>
        <form action="showaqi.php" method="POST">
            <div class="city-list">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <label>
                    <input type="checkbox" name="cities[]" value="<?= $row['ID'] ?>"> 
                        <?= $row['ID'] ?> .
                        <?= htmlspecialchars($row['CITY']) ?>, <?= htmlspecialchars($row['COUNTRY']) ?>.
                        <strong>AQI</strong><strong>-</strong> <?= htmlspecialchars($row['AQI']) ?>
                        
                    </label>
                <?php endwhile; ?>
            </div>
            <button type="submit">Submit</button>
            <script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const checked = document.querySelectorAll('input[name="cities[]"]:checked');
        if (checked.length < 10) {
            alert("Please select at least 10 cities.");
            e.preventDefault();
        }
    });
</script>
        </form>
    <?php else: ?>
        <p>No cities found.</p>
    <?php endif; ?>
</div>
</body>
</html>
