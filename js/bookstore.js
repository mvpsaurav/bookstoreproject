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