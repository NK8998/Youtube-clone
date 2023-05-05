<?php
session_start(); 
setcookie("user_id", "", time() - 3600, "/"); // set expiration to 1 hour ago
unset($_SESSION['user_uid']);
header("Location: ../watch");
exit(); 
?>