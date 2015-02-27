var xmlhttp;

function validateLogin()
{
	var usermail = document.getElementById('mainusermail').value;
	var password = document.getElementById('mainpassword').value;
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
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
}

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

function addto(isbn, user)
{
	xmlhttp = getXMLHttpObject(); //create
	var params = "isbn="+isbn+"&user="+user+"&sid="+Math.random();
	xmlhttp.open('POST',"bookstoreadd.php",true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send(params);
	alert('Sent');
}