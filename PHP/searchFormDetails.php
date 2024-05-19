<?php

session_start();
$_SESSION["SearchPlace"]=$_POST["Place"];
$_SESSION["UserLocation"]=$_POST["Location"];
header('Location: ../HTML/sites.php');
exit;

?>