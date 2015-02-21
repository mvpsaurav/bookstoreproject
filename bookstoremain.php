<?php 
session_start();

if ($_SESSION['usermail'] == '')
{
	header("location:bookstorelogin.php");
}

echo "Your username is ".$_SESSION['usermail']."<br>";
?>
<html>
<head>
<title>Main Page</title>
<script>alert('Welcome!');</script>
</head>
<body>
<p>You done did it!</p>
<a href='bookstorelogout.php'>Logout</a>
</body>
</html>