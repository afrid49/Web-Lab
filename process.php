<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "registered";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm']) && $_POST['confirm'] === '1') {
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $gender = $conn->real_escape_string($_POST['gender']);
        $country = $conn->real_escape_string($_POST['country']);
        $dob = $conn->real_escape_string($_POST['dob']);

        $checkEmail = "SELECT * FROM userlist WHERE email = '$email'";
        $result = $conn->query($checkEmail);
        if ($result->num_rows > 0) {
    $_SESSION['alert'] = '❌ Email already exists. Please use a different one.';
    header("Location: alert.php");
    exit;
} else {
    $sql = "INSERT INTO userlist (name, email, password, gender, country, dob)
            VALUES ('$name', '$email', '$password', '$gender', '$country', '$dob')";
    if ($conn->query($sql)) {
        $_SESSION['alert'] = '✅ Registration successful!';
    } else {
        $_SESSION['alert'] = '❌ Database error: ' . $conn->error;
    }
    header("Location: alert.php");
    exit;
  }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Information</title>
  <style>
  body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    height: 100vh;
     background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    background-size: 400% 400%;
    animation: glowBackground 15s ease infinite;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  @keyframes glowBackground {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

 .receipt {
  position: relative;
  z-index: 1;
  background: rgba(255, 255, 255, 0.15); /* Slightly higher opacity for better readability */
  border-radius: 20px;
  padding: 40px 35px;
  max-width: 650px;
  width: 90%;
  box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
  animation: floatCard 4s ease-in-out infinite;
  background-color: rgba(255, 255, 255, 0.15); /* Optional: soften the background */
backdrop-filter: none;
-webkit-backdrop-filter: none;
  border: 1px solid rgba(255, 255, 255, 0.25);
  overflow: hidden;
  color: #ffffff; /* Ensure text is bright */
}

/* Glow border overlay */
.receipt::before {
  content: '';
  position: absolute;
  inset: 0;
  z-index: -1;
  border-radius: 20px;
  background: radial-gradient(circle at top left, #93c5fd, #c084fc, #f9a8d4);
  background-size: 300% 300%;
  animation: borderPulse 8s ease infinite;
  opacity: 0.5;
  filter: blur(18px);
}

/* Optional pattern overlay */
.receipt::after {
  content: '';
  position: absolute;
  inset: 0;
  background-image: repeating-linear-gradient(45deg, rgba(255,255,255,0.03) 0, rgba(255,255,255,0.03) 1px, transparent 1px, transparent 10px);
  border-radius: 20px;
  z-index: -1;
}

@keyframes borderPulse {
  0%, 100% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
}

  @keyframes floatCard {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
  }

 .receipt h2 {
  text-align: center;
  font-size: 32px;
  color:rgb(248, 246, 250); /* Softer purple */
  margin-bottom: 25px;
  font-weight: 700;
  letter-spacing: 1px;
  text-shadow: 0 2px 4px rgba(124, 58, 237, 0.4),
               0 0 10px rgba(124, 58, 237, 0.2);
  animation: glowTitle 3s ease-in-out infinite;
}

@keyframes glowTitle {
  0%, 100% {
    text-shadow: 0 2px 4px rgba(124, 58, 237, 0.4),
                 0 0 10px rgba(124, 58, 237, 0.2);
  }
  50% {
    text-shadow: 0 2px 8px rgba(124, 58, 237, 0.8),
                 0 0 20px rgba(124, 58, 237, 0.6);
  }
}

.info-group {
  display: flex;
  flex-direction: column;
  gap: 12px;
  margin-top: 20px;
  animation: fadeIn 1.5s ease forwards;
  opacity: 0;
}

@keyframes fadeIn {
  from {
    transform: translateY(20px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}


.receipt p {
  font-size: 18px;
  margin: 0;
  padding: 10px 15px;
  background: rgba(255, 255, 255, 0.75); /* <== better readability */
  color: #000; /* Optional: makes text black on light background */
  border-radius: 12px;
  font-weight: 600;
  letter-spacing: 0.3px;
  transition: transform 0.3s ease, background 0.3s ease;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
}
.receipt p:hover {
  transform: scale(1.03);
  background: rgba(255, 255, 255, 0.4);
}

.label {
  font-size: 19px;
  font-weight: 700;
  background: linear-gradient(90deg, #6366f1, #8b5cf6, #ec4899);
  background-size: 200% 200%;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: gradientFlow 5s ease infinite;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
}

@keyframes gradientFlow {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}


  button {
    margin: 20px 10px 0;
    padding: 12px 28px;
    background: linear-gradient(145deg, #6366f1, #8b5cf6);
    color: white;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
    transition: all 0.3s ease;
    transform: translateY(0);
  }

  button:hover {
    box-shadow: 0 12px 25px rgba(99, 102, 241, 0.6);
    transform: translateY(-3px);
  }

  button:active {
    transform: translateY(1px);
    box-shadow: 0 6px 12px rgba(99, 102, 241, 0.3);
  }

  .button-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 300px;
  margin: 30px auto 0;
}


/* Custom Alert Modal Styling */
.modal {
  display: none;
  position: fixed;
  z-index: 999;
  left: 0; top: 0;
  width: 100%; height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(5px);
}

.modal-content {
  background: linear-gradient(145deg, #6366f1, #8b5cf6);
  color: white;
  margin: 15% auto;
  padding: 30px 20px;
  border-radius: 15px;
  width: 80%;
  max-width: 400px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.3);
  text-align: center;
  animation: popIn 0.4s ease;
}

.modal-content button {
  margin-top: 20px;
  padding: 10px 25px;
  background-color: white;
  color: #6366f1;
  border: none;
  border-radius: 30px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s ease;
}

.modal-content button:hover {
  background-color: #f0f0f0;
}

@keyframes popIn {
  0% { transform: scale(0.8); opacity: 0; }
  100% { transform: scale(1); opacity: 1; }
}

</style>
</head>
<body>
  <div class="receipt">
  <h2>🎉 Registration Info</h2>
  <div class="info-group">
  <p><span class="label">👤Name:</span> <?php echo htmlspecialchars($_POST['name'] ?? ''); ?></p>
<p><span class="label">📧Email:</span> <?php echo htmlspecialchars($_POST['email'] ?? ''); ?></p>
<p><span class="label">⚧Gender:</span> <?php echo htmlspecialchars($_POST['gender'] ?? ''); ?></p>
<p><span class="label">🌍Country:</span> <?php echo htmlspecialchars($_POST['country'] ?? ''); ?></p>
<p><span class="label">🎂Date of Birth:</span> <?php echo htmlspecialchars($_POST['dob'] ?? ''); ?></p>

  </div>
<form method="post" action="">
  <input type="hidden" name="confirm" value="1">
  <input type="hidden" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
  <input type="hidden" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
  <input type="hidden" name="password" value="<?php echo htmlspecialchars($_POST['password'] ?? ''); ?>">
  <input type="hidden" name="gender" value="<?php echo htmlspecialchars($_POST['gender'] ?? ''); ?>">
  <input type="hidden" name="country" value="<?php echo htmlspecialchars($_POST['country'] ?? ''); ?>">
  <input type="hidden" name="dob" value="<?php echo htmlspecialchars($_POST['dob'] ?? ''); ?>">

  <div class="button-container">
    <button type="button" onclick="window.location.href='index.php';">Cancel</button>
    <button type="submit">Confirm</button>
  </div>
</form>
    <!-- Custom Alert Modal -->
<div id="customAlert" class="modal">
  <div class="modal-content">
    <span id="alertMessage"></span>
    <button onclick="closeAlert()">OK</button>
  </div>
</div>
<script>
function showAlert(message) {
  document.getElementById("alertMessage").innerText = message;
  document.getElementById("customAlert").style.display = "block";
}
function closeAlert() {
  document.getElementById("customAlert").style.display = "none";
}

document.addEventListener('DOMContentLoaded', function() {
  <?php if (isset($_SESSION['alert'])): ?>
    showAlert("<?= addslashes($_SESSION['alert']) ?>");
    <?php unset($_SESSION['alert']); ?>
  <?php endif; ?>
});
</script>
</body>
</html>
