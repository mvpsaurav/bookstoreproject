<?php session_start();

// Check if the user has logged in
if( !empty($_SESSION) ){
  header("location:bookstoremain.php");
}
?>
<html>
<head>
<meta charset='utf-8'>
<title>Bookstore Portal: Login or Signup!</title>
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
<div align='center'>
<h2>Bookstore: Log In or Create an Account</h2>
</div>
<!--login format courtesy of getbootstrap.com-->
<div class='container'>

<div class='col-xs-6'>
<form class='form-signin' name='login' id='login' method='post' action='bookstoreverify.php' onsubmit='return validateLogin();'>
<h2 class='form-signin-heading'>Log In</h2>
<input type='email' class='form-control' id='mainusermail' placeholder='Email' name='mainusermail'>
<input type='password' class='form-control' id='mainpassword' placeholder='Password' name='mainpassword'>
<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
</div>

<div class='col-xs-6'>
<form class='form-signin' name='register' id='register' method='post' action='bookstoreregister.php' onsubmit='return validateRegistration();'>
<h2 class='form-signin-heading'>Sign Up</h2>
<input type='email' class='form-control' id='usermail' placeholder='Email' name='usermail'>
<input type='password' class='form-control' id='password' placeholder='Password' name='password'>
<input type='password' class='form-control' id='checkpassword' placeholder='Reenter Password' name='checkpassword'>
<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
</form>
</div>

</div>
</body>
</html>