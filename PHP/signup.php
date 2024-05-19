<?php
include "../PHP/db_conn.php";
$fname=$_POST["fname"];
$email=$_POST["email"];
$password=$_POST["password"];

$sql="INSERT INTO users(FullName, Email, Password) VALUES ('$fname', '$email' ,'$password')";

if($connection->query($sql)==TRUE){
    header('Location: ../HTML/index.php');
    exit;
}
else
    echo "<script>alert('SignUp is not successful')</script>";

$connection->close();
?>