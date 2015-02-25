<?php 
session_start();

if ($_SESSION['usermail'] == '')
{
	header("location:bookstorelogin.php");
}

//echo "Your username is ".$_SESSION['usermail']."<br>";
?>
<html>
<head>
<title>Main Page</title>
<!-- <link href="css/style.css" rel="stylesheet" /> -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<!-- external css-->
<link href="css/bookstore.css" rel="stylesheet" />
<script src="js/bookstore.js"></script>
</head>
<body>
<div class='jumbotron'>
<div class='container'>
<div>
<?php
$con = mysql_connect('localhost','root','');
if (!$con)
{
	die("Could not connect to database".mysql_error());
}
mysql_select_db('bookstore')or die('Cannot select database bookstore');
$getbooks = "Select title, image from books order by dateadded";
$result = mysql_query($getbooks)or die("Error querying database: ".mysql_error());
$incre = 1;
while ($books = mysql_fetch_assoc($result))
{
	echo "<form action='viewbook.php' method='POST' id = 'myForm".$incre."' name = 'myForm".$incre."'>";
	echo "<input type = 'hidden' value = '".$books['title']."' name = 'title'></form> ";
	echo "<p class='lead'><a href='javascript: getTitle(".$incre.")'>".$books['title']."</a></p>";
	echo "<div draggable='true' ondragstart='drag(event);'><img src='img/".$books['image']."' width='150' height='200' alt='a book'></div>";
	$incre++;
}
mysql_close($con);
?>
</div>
<div>
<label>Shopping Cart will go here</label>
<div class='shoppingcart' ondrop="drop(event)" ondragover="allowDrop(event)"></div>
<a href='bookstorelogout.php'>Logout</a>
</div>
</div>
</div>
</body>
</html>