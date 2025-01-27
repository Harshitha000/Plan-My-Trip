<?php
session_start();
include "../PHP/db_conn.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$fname = $_POST["fname"];
$email = $_POST["email"];
$password = $_POST["password"];
$userOtp = $_POST["otp"];

if ($userOtp == $_SESSION['otp']) {
    $sql = "INSERT INTO users (FullName, Email, Password) VALUES ('$fname', '$email', '$password')";

    if ($connection->query($sql) === TRUE) {
        unset($_SESSION['otp']);
        echo "<script>
                alert('User signup is successful. Login to continue.');
                window.location.href = '../HTML/index.php';
              </script>";
        exit;
    } else {
        echo "<script>alert('SignUp is not successful. Please try again.')</script>";
    }
} else {
    echo "<script>alert('Invalid OTP. Please try again.')</script>";
}

$connection->close();
?>
