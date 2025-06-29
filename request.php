<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Cities</title>
    <!-- Google Fonts and Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 40px 20px;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1f1c2c, #928dab);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            padding: 40px;
            border-radius: 20px;
            max-width: 750px;
            width: 100%;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            color: #fff;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: 600;
            color: #ffffff;
            text-shadow: 0px 2px 6px rgba(0,0,0,0.2);
        }
        .city-list {
            max-height: 400px;
            overflow-y: auto;
            padding: 10px;
            margin-bottom: 25px;
            border-radius: 10px;
        }
        .city-list label {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .city-list label:hover {
            background: rgba(255, 255, 255, 0.25);
        }
        .city-list input[type="checkbox"] {
            margin-right: 12px;
            transform: scale(1.3);
            cursor: pointer;
        }
        .city-list i {
            margin-right: 10px;
            color: #00ffff;
        }
        button {
            display: block;
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        button:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #ff4b2b, #ff416c);
        }
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
        }
    </style>
</head>
<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
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
                        <?= htmlspecialchars($row['CITY']) ?>, <?= htmlspecialchars($row['COUNTRY']) ?>
                        
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
