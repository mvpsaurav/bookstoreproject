<?php session_start();
session_destroy(); // Destroy session on logout
header("location:bookstorelogin.php"); // reroute to login page
?>