<?php
session_start();
$alert = isset($_SESSION['alert']) ? $_SESSION['alert'] : 'No alert message found.';
unset($_SESSION['alert']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Alert</title>
  <style>
    body {
      background: #0f2027;
      color: white;
      font-family: Arial, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      text-align: center;
    }
    .message-box {
      background: rgba(255,255,255,0.1);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(255,255,255,0.2);
    }
    .message-box p {
      font-size: 20px;
    }
    .message-box a {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      color: white;
      background: #6366f1;
      text-decoration: none;
      border-radius: 8px;
    }
    .message-box a:hover {
      background: #8b5cf6;
    }
  </style>
</head>
<body>
  <div class="message-box">
    <p><?= htmlspecialchars($alert) ?></p>
    <a href="index.php">Go Back</a>
  </div>
</body>
</html>
