<?php
session_start();
include "../PHP/db_conn.php";
$email=$_POST["email"];
$password=$_POST["password"];

$sql="SELECT * from users WHERE Email='$email' AND Password='$password'";
$result=$connection->query($sql);
if($result->num_rows>0){
    $row=$result->fetch_assoc();
    $_SESSION["User"]=$row['FullName'];
    header('Location: ../HTML/search.php'); 
    exit;
}
else
    echo "<script>alert('Login is not successful');window.location.href = '../HTML/index.php'</script>";
    $connection->close();
?>