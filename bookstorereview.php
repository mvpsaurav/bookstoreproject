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
$new = "insert into review(booknumber,postdate,review,score,usermail) values('$isbn',NOW(),'$review','$score','$usermail');";
mysql_query($new)or die('error submitting to database: '.mysql_error());
mysql_close($con);
//resubmit title value over to viewbook via post to redirect to correct book
$title = $_SESSION['title'];
$_SESSION['title'] = '';
echo "<script src='js/bookstore.js'></script>";
echo "<form method='post' action='viewbook.php' id='returnform'><input name='title' type='hidden' value='".$title."'></form>";
echo "<div onload='returnToBook();'>";
?>