<?php 
session_start();

if ($_SESSION['usermail'] == '')
{
	header("location:bookstorelogin.php");
}
$_SESSION['title'] = '';
//echo "Your username is ".$_SESSION['usermail']."<br>";
?>
<html>
	
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
	<title>Main Page: Book Master</title>
	
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
                <a class="navbar-brand" href="#">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="#">Wishlist</a>
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
	<div id="wrapper">
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
	<div id="page-content-wrapper">	
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
				$getbooks = "Select title, image, price from books order by dateadded";
				$result = mysql_query($getbooks)or die("Error querying database: ".mysql_error());
				$incre = 1;
				while ($books = mysql_fetch_assoc($result))
				{
					echo "<form action='viewbook.php' method='POST' id = 'myForm".$incre."' name = 'myForm".$incre."'>";
					echo "<input type = 'hidden' value = '".$books['title']."' name = 'title'></form> ";
					echo "<p class='lead'><a href='javascript: getTitle(".$incre.")'>".$books['title']."</a></p>";
					echo "<div id= '".$books['title']."' draggable='true' ondragstart='drag(event);'><img src='img/".$books['image']."' width='150' height='200' alt='a book'></div>";
					echo "<p>Price: $".$books['price']."</p>";
				$incre++;
				}
				mysql_close($con);
				?>
				</div>
			</div>
		</div>
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
		</script>
		
	</footer>
		</div>
		</div>
	</body>
</html>