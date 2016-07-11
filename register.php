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
<div id="header">
	<div id="logo">
		<img src="logo.png" alt="Careeer" height="30px">
	</div>
	<div id="logout">
		<a href="index.php">back</a>
	</div>
</div>
	<div class="indexwrapper">
	<div id="login">
		<span class="center lightblue">Type desired username and password</span><br><br>
	<form id="regis" name="login" method="post" action="regissave.php">
		<input type="text" name="user" placeholder="Username" id="userinput">
		<input type="password" name="pass" placeholder="Password" id="passinput">
		<input type="submit" value="Register" id="loginbutton">
	</form>
	</div>
	</div>
</div>
</body>
</html>