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

$email = $_POST['loginEmail'];
$password = $_POST['loginPassword'];
$remember = isset($_POST['remember']); // ✅ Properly check if "remember" is checked

// Basic validation
if (empty($email) || empty($password)) {
    echo "<script>alert('Please fill in all fields.'); window.location.href='login.html';</script>";
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format.'); window.location.href='login.html';</script>";
    exit();
}

// Query database
$stmt = $conn->prepare("SELECT * FROM userlist WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];

        // ✅ Set cookie if "Remember Me" is checked
        if ($remember) {
            setcookie("remember_email", $email, time() + (86400 * 7), "/");
            setcookie("remember_password", $password, time() + (86400 * 7), "/");
             // 7 days
        } else {
            setcookie("remember_email", "", time() - 3600, "/"); // Delete cookie
            setcookie("remember_password", "", time() - 3600, "/");
        }

        header("Location: request.php");
        exit();
    } else {
        echo "<script>alert('Incorrect password.'); window.location.href='login.html';</script>";
        exit();
    }
} else {
    echo "<script>alert('No user found with this email.'); window.location.href='login.html';</script>";
    exit();
}
?>
