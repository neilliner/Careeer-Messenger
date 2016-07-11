<?php
	$host 	= "localhost";
	$user	= "username";
	$pass	= "password";
	$dbname = "database name";
	mysql_connect($host,$user,$pass) or die("Can't connect DB");
	mysql_select_db($dbname) or die("Can't select DB");
	mysql_query("set names utf8");
?>
