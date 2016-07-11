<?php include("connect.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Careeer</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="style.css">	
</head>
<body>
<div id="container">
	<div class="indexwrapper">
	<div id="indexlogo">
		<img src="indexlogo.png" width="100%">
	</div>
	<div id="login">
		<span class="center lightblue">Please log in</span>
	<form id="loginform" name="login" method="post" action="login.php" >
		<input type="text" name="user" placeholder="Username" id="userinput">
		<input type="password" name="pass" placeholder="Password" id="passinput">
		<input type="submit" value="Log in" id="loginbutton">
	</form>
	<br><span class="bigfont">or <a href="register.php">register</a></span>
	</div>
	</div>
</div>
</body>
</html>
