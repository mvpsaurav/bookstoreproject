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
$title = $_POST['title'];
$books = "select isbn, title, author, image, category, summary, price, dateadded from books where title='".$title."' limit 1;";
$result = mysql_query($books)or die("Error fetching data".mysql_error());
$bookrow = mysql_fetch_assoc($result);	//create associative array from results based on column name
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
<?php echo "<img src='img/".$bookrow['image']."' width='450' height='600'>";?>
<p><?php echo $bookrow['summary'];?></p>
<p>$<?php echo $bookrow['price'];?></p>
<small>Added on <?php echo $bookrow['dateadded'];?></small>

<p>Reviews for <?php echo $title;?></p>
<?php
while ($reviewrow = mysql_fetch_assoc($result2))
{
	echo "<ul>".$reviewrow['review']."</ul>";
	echo "<ul>This user gave this book a score of ".$reviewrow['score']."/10</ul>";
	echo "<ul>By ".$reviewrow['usermail']." on ".$reviewrow['postdate']."</ul><br>";
}
mysql_close($con);
?>
<br><br><br>
<label>Submit a review</label>
<form id='comment' method='post' action='bookstorereview.php'>
<textarea class='form-control' name='review' id='review'></textarea>
<label for='score'>Score</label>
<select id='score' name='score'>
    <option value="one">1</option>
    <option value="two">2</option>
    <option value="three">3</option>
    <option value="four">4</option>
    <option value="five">5</option>
    <option value="one">6</option>
    <option value="two">7</option>
    <option value="three">8</option>
    <option value="four">9</option>
    <option value="five">10</option>
</select>
<?php echo "<input type='hidden' name='isbn' id='isbn' value='".$bookrow['isbn']."'>"; ?>
<button class='btn btn-default' type='submit'>Submit</button>
</form>
</div>
</div>

</body>
</html>