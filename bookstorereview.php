<?php
session_start();
if(!$_SESSION['usermail']){
	header("location:bookstorelogin.php");
}
$con = mysql_connect('localhost','root','');
if (!$con)
{
	die("Could not connect to database".mysql_error());
}
mysql_select_db('bookstore')or die('Cannot select database bookstore');
$usermail = $_SESSION['usermail'];
$wishlist = false;
$isbn = $_POST['isbn'];
$score = $_POST['score'];
$review = $_POST['review'];
$new = "insert into account_book(booknumber,postdate,review,score,usermail,wishlist) values('$isbn',NOW(),'$review','$score','$usermail','$wishlist');";
mysql_query($new)or die('error submitting to database'.mysql_error());
mysql_close($con);
header('location:viewbook.php');
?>