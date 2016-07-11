<?php
		session_start();
		include("connect.php");
		$u = $_POST['user'];
		$p = $_POST['pass'];
		echo $u;
		echo $p;
			
			if(empty($u)||empty($p))
			{
				exit("<script>alert('Registeration fail'); history.back();</script>");
			}	
			else
			{	
				$sql	= "INSERT INTO member VALUES (null, '$u', '$p' )";
				$query	= mysql_query($sql)or die("error=$sql <hr>".mysql_error());
				//$num	= mysql_num_rows($query);
				//$row	= mysql_fetch_array($query);
			
				exit("<script>alert('Successful! Please log in'); window.location='index.php';</script>");
			}

?>