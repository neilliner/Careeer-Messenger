<?php
session_start();
include("class.user.php");
$uid = $_SESSION['uid'];
$u = new user;
if($_GET['del']){
	//echo "<script>alert('Will Delete');</script>";
	$u->delFriend($uid,$_GET[iddel]);
	$_GET['del'] = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Test Delete</title>
	<meta name="generator" content="BBEdit 10.5" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="style.css">
	<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->	
</head>
<body>
<div id="container">
<div id="header">
	<div id="logo">
		<img src="logo.png" alt="Careeer" height="30px">
	</div>
	<div id="logout">
		<a href="logout.php">log out</a>
	</div>
</div>
<?php	
	$uflength = count($u->ufriend($uid));
	echo "<div id='friend' class='clearFix'>".$u->checkUser($uid).", please click on the friend you want to delete.";
	echo "<form id='friendform' name='friend' action='testdelete.php' method='get'><div id='friendbox'>";
	for($i=0;$i<$uflength;$i++){echo "<a href='testdelete.php?del=true&iddel=".$u->ufriend($uid)[$i]."'><div class='friend'>".$u->checkUser($u->ufriend($uid)[$i])."</div></a>";}
	echo "</div></form>";
	echo "</div>";
?>
<a href="test.php"><div id="backbutton">Back</div></a>	
</div>
</body>
</html>
