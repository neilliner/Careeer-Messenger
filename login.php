<?php
		session_start();
		include("connect.php");
		$u = $_POST['user'];
		$p = $_POST['pass'];
		//echo $u;
		//echo $p;
				
			$sql	= "select * from member where m_user ='$u' and m_pass ='$p'";
			$query	= mysql_query($sql)or die("error=$sql <hr>".mysql_error());
			$num	= mysql_num_rows($query);
			$row	= mysql_fetch_array($query);
			
			if($num==0) // if NOT found the matching of $user and $pass inthe table ==> display this ...
			{
				exit("<script>alert('Login fail'); history.back();</script>");	
			}
			else
			{
				$_SESSION['m_user'] = $u;
				$_SESSION['uid'] = $row['uid'];
				//echo $row['uid'];
				exit("<script>alert('Welcome'); window.location='test.php';</script>");
			}

?>