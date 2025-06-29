<?php
session_start();
session_unset();
session_destroy();
if ($remember) {
    setcookie("remember_email", $email, time() + (86400 * 7), "/"); // 7 days
} else {
    setcookie("remember_email", "", time() - 3600, "/"); // Delete cookie
    setcookie("remember_password", "", time() - 3600, "/");
}
header("Location: index.php");
exit();
