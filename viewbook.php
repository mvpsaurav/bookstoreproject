<?php
session_start();
if(!$_SESSION['username']){
	header("location:bookstorelogin.php");
}
$con = mysql_connect('localhost','root','');
if (!$con)
{
	die("Could not connect to database".mysql_error());
}
mysql_select_db('bookstore')or die('Cannot select database bookstore');
$itle = $_POST['title'];
$books = "select title, author, image, category, summary, price, dateadded from books where title='$title' limit 1;";
$results = mysql_query($books);
$bookrow = $results->fetch_assoc();	//create associative array from results based on column name
$reviews = "select usermail, title, score, review, postdate from books, account_book where books.isbn=account_book.booknumber and title='$title' order by postdate;";
$result2 = mysql_query($reviews);
?>
<html>
<head>
<title><?php echo $title; ?> </title>
<!-- <link href="css/style.css" rel="stylesheet" /> -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<link href="css/bookstore.css" rel="stylesheet" />
<script src="js/bookstore.js"></script>
</head>
<body>

<div class='container'>
<div class='jumbotron'>
<h1><?php echo $title; ?></h1>
<p class='lead'>By <?php echo $bookrow['author']."  Category: ".$bookrow['category']; ?></p>
<?php echo "<img src='".$bookrow['image']."'>";?>
<p><?php echo $bookrow['summary'];?></p>
<small>$<?php $bookrow['price'];?></small>
<small>Added on <?php $bookrow['dateadded'];?></small>

<p>Reviews for <?php echo $title;?></p>
<?php
while ($reviewrow = mysql_fetch_assoc($result2)
{
	echo "<p>".$reviewrow['review']."</p>";
	echo "<p>".$reviewrow['score']."/10</p>";
	echo "<small>By ".$reviewrow['usermail']." on ".$reviewrow['postdate']."</small>";
}
?>
</div>
</div>

</body>
</html>