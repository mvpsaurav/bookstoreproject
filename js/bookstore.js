var xmlhttp;

function validateLogin()
{
	let usermail = document.getElementById('mainusermail').value;
	const password = document.getElementById('mainpassword').value;
	if (usermail == '' || password == '')
	{
		alert('Make sure all fields are filled in before continuing');
		return false;
	}
}

function validateRegistration()
{
	var usermail = document.getElementById('usermail').value;
	var password = document.getElementById('password').value;
	var checkpassword = document.getElementById('checkpassword').value;
	if (usermail == '' || password == '' || checkpassword == '')
	{
		alert('Make sure all fields are filled in before continuing');
		return false;
	}
	if (password != cpassword)
	{
		alert('Passwords do not match');
		return false;
	}
}

//drag and drop from w3schools
function getTitle(s) {
    var incre = "myForm"+s;
    document.getElementById(incre).submit();
}

//jquery from onextrapixel.com
$(document).ready(function(){
	//fade in from http://www.onextrapixel.com/2010/02/23/how-to-use-jquery-to-make-slick-page-transitions/
	$("body").css("display", "none");
	$("body").fadeIn(500);
});

function getXMLHttpObject()
{
	if (window.XMLHttpRequest)
	{
		xmlHttp = new XMLHttpRequest(); //good browsers
	}
	else 
	{
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); // IE
	}
	return xmlHttp;
}

function addto(isbn, user, title)
{
	var xmlhttp = getXMLHttpObject(); //create
	var params = "isbn="+isbn+"&user="+user+"&sid="+Math.random();
	xmlhttp.open('POST',"bookstoreadd.php",true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send(params);
	alert('Added to wishlist!');
	var newdiv = document.createElement('div');
	var newbook = document.createElement('label');
	newdiv.setAttribute('id',title);
	var but = document.createElement('button'); //create the X button
	but.innerHTML = 'x';
	but.setAttribute('onclick','removefrom(isbn,user,title)');
	but.setAttribute('class','close');
	newbook.appendChild(but);
	newbook.innerHTML = title;
	document.getElementById('wishlistbar').appendChild(newbook);
}

function removefrom(isbn, user, title)
{
	let xmlhttp = getXMLHttpObject();
	let params = "isbn="+isbn+'&user='+user+'&sid='+Math.random();
	xmlhttp.open('POST','bookstoreremove.php',true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send(params);
	alert('Removed from wishlist!');
	let removed = document.getElementById(title);
	//console.log(removed);
	removed.parentNode.removeChild(removed);
}

function allowDrop(ev) {
	ev.preventDefault();
}

function drag(ev) {
	ev.dataTransfer.setData("text", ev.target.id);
	//ev.dataTransfer.setData('name', ev.target.name);
}

function drop(ev) {
	ev.preventDefault();
	var data = ev.dataTransfer.getData("text");
	ev.target.appendChild(document.getElementById(data).cloneNode(true));
	updoot(data);
}

function updoot(cart){
	xmlhttp = getXMLHttpObject();
	let params = "cart="+cart+"&sid="+Math.random();
	xmlhttp.open('POST',"cartadd.php",true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send(params);
	alert('Added to shopping cart!');
}
