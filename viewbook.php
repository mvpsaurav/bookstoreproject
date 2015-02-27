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
$_SESSION['title'] = $title;
$books = "select isbn, title, author, image, category, summary, price, dateadded from books where title='".$title."' limit 1;";
$result = mysql_query($books)or die("Error fetching data".mysql_error());
$bookrow = mysql_fetch_assoc($result);	//create associative array from results based on column name
$reviews = "select usermail, title, score, review, postdate from books, review where books.isbn=review.booknumber and title='$title' order by postdate;";
$result2 = mysql_query($reviews);
$usermail = $_SESSION['usermail'];
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
<link href="css/shop-item.css" rel="stylesheet">
<link href="css/simple-sidebar.css" rel="stylesheet">
	
	<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="//code.jquery.com/jquery-1.8.3.min.js"></script>
	<script>
		$(document).ready(function() {
		$tmp = $("#tmp").get(0);
		
		$("#sortable").sortable({
			start: function(event, ui) {
			},
			stop: function(event, ui) { 
				console.log("isNew : ", jQuery.data($tmp, "isNew"));
				console.log("resultHTML : ", jQuery.data($tmp, "resultHTML"));
			}
		});

		$("#draggable li").draggable({
			connectToSortable: "#sortable",
			start: function(event, ui) {    

				//Store info in a tmp div         
				jQuery.data($tmp, "isNew", true);
				jQuery.data($tmp, "resultHTML", "<b>Here I will add some custom html to EVENT data</b>");
				
			},
			helper: function(event) {
				return "<div class='custom-helper'>Custom helper for " + $(this).context.innerHTML + "</div>";   
			},
			revert: "invalid"
		});
	});
	</script>
	<style>
		#div1 {
			width:300px;
			height:290px;
			padding:10px;
			border:0px solid #aaaaaa;
			text-align: middle;
		}

		#sortable {
			margin-top: 16px;
			min-height: 256px;
		}
	</style>
	<script type="text/JavaScript">
		function allowDrop(ev) {
			ev.preventDefault();
		}

		function drag(ev) {
			ev.dataTransfer.setData("text", ev.target.id);
		}

		function drop(ev) {
			ev.preventDefault();
			var data = ev.dataTransfer.getData("text");
			ev.target.appendChild(document.getElementById(data).cloneNode(true));
			
		}
	</script>
</head>
<body>
<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Bookmaster</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="bookstoremain.php">Home</a>
                    </li>
                    <li>
                        <a href="#menu-toggle1" class="btn btn-default" id="menu-toggle1">Wishlist</a>
                    </li>
                    <li>
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Shopping Cart</a>
                    </li>
					<li>
						<a href="bookstorelogout.php">Log Out</a>
					</li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	<div id="wrapper" class='toggled'>
	<div id="wrapper1" class='toggled'>
	<!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
				<br>
				<ul id="sortable" class="ui-state-highlight">
				</ul>
				<div id="tmp"></div>
            </ul>
        </div>
		<div id="sidebar-wrapper1">
            <ul class="sidebar-nav1">
            <p>Your Wishlist</p>
                <?php
				$wish = "select isbn, title from books, wishlist where books.isbn=wishlist.booknumber and usermail='$usermail';";
				$list = mysql_query($wish)or die('No: '.mysql_error());
				while ($eachbook = mysql_fetch_assoc($list))
				{
					echo "<label>".$eachbook['title']."</label>";
				}
				?>
            </ul>
        </div>
	<div id="page-content-wrapper">
	<div id="page-content-wrapper1">	

<div class='container'>
<div class='jumbotron'>
<h1><?php echo $title; ?></h1>
<p class='lead'>By <?php echo $bookrow['author']."  Category: ".$bookrow['category']; ?></p>
<?php echo "<div id='".$title."'draggable='true' droppable='true' ondragstart='drag(event);'><img src='img/".$bookrow['image']."' width='450' height='600'></div>";?>
<p><?php echo $bookrow['summary'];?></p>
<p>$<?php echo $bookrow['price'];?></p>
<small>Added on <?php echo $bookrow['dateadded'];?></small><br>
<button type='button' class='btn btn-info'>Add to Wishlist</button>
<br><br>
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
    <option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option selected='selected' value='5'>5</option>
    <option value='6'>6</option>
    <option value='7'>7</option>
    <option value='8'>8</option>
    <option value='9'>9</option>
    <option value='10'>10</option>
</select>
<?php echo "<input type='hidden' name='isbn' id='isbn' value='".$bookrow['isbn']."'>"; ?>
<button class='btn btn-default' type='submit'>Submit</button>
</form>
<a href='bookstoremain.php'><-Back</a>
</div>
</div>

</body>
<footer>
		<div class="container">
			<hr>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Book Master 2015</p>
                </div>
            </div>
		</div>
	
		<!-- jQuery -->
		<script src="js/jquery.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>

		<!-- Menu Toggle Script -->
		<script>
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
		$("#menu-toggle1").click(function(e) {
			e.preventDefault();
			$("#wrapper1").toggleClass("toggled");
		});
		</script>
</footer>
</div>
</div>
</div>
</div>
</div>
</html>