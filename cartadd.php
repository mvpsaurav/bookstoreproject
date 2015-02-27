<?php
session_start();

if(!$_SESSION['cart'])
{
	$cart = array();
	$_SESSION['cart'] = $cart; 
}

array_push($_SESSION['cart'],$_POST['cart']);

?>