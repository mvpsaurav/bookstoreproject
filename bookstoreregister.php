<?php
session_start();
$usermail = $_POST['usermail'];
$password = $_POST['password'];
$encpassword = md5($password); //create md5 hash of password
$con = mysql_connect('localhost', 'root', ''); //establish connection
if(!$con) //if connection not established
{
	die('Could not connect: '.mysql_error());
}
mysql_select_db('bookstore')or die('cannot select db'); //submit mysql use db query
$ismod = false;
$newuser = "insert into accounts(ismoderator,usermail,password) values('$ismod','$usermail','$encpassword');";
mysql_query($newuser)or die('error submitting to database: '.mysql_error());
mysql_close($con);
$_SESSION['error'] = '';
$_SESSION['account'] = 'Your account has been created!';
header("location:bookstorelogin.php");