<?php
	include("connect.php");
	class user{
		function checkUser($id){
			//$id = 1;
			$sql	= "select * from member where uid ='$id'"; //m_user ='$u' and m_pass ='$p'";
			$query	= mysql_query($sql)or die("error=$sql <hr>".mysql_error());
			//$num	= mysql_num_rows($query);
			$row	= mysql_fetch_array($query);
			return $row[m_user];
		}
		
		function checkId($uname){
			$sql	= "select * from member where m_user ='$uname'";
			$query	= mysql_query($sql)or die("error=$sql <hr>".mysql_error());
			$num	= mysql_num_rows($query);
			if($num == 0){
				return -1;
			}
			//else if($num >=1){return true;}*/
			else if($num > 0){
				$row	= mysql_fetch_array($query);
				return $row[uid];
			}
		}
		
		function alreadyFriend($uid,$fid){
			$sql	= "select * from relation where uid = '$uid' and frid = '$fid'";
			$query	= mysql_query($sql)or die("error=$sql <hr>".mysql_error());
			$num	= mysql_num_rows($query);
			/*while($row = mysql_fetch_array($query)){
				print_r($row);
			}*/
			if($num == 0){/*echo "<script>alert('num == 0');</script>";*/return false;}
			else if($num == 1){/*cho "<script>alert('num == 1');</script>";*/return true;}
			else{echo "<script>alert('ERROR!!');</script>"; return;}
			
		}
		
		function addFriend($uid,$fid){
			/*echo "<script>alert('".self::alreadyFriend($uid,$fid)."');</script>";*/
			//echo "<script>alert('".!(self::alreadyFriend($uid,$fid))."');</script>";
			if(self::alreadyFriend($uid,$fid) === false){				
				$sql1	= "insert into relation values('$uid','$fid',null)";
				$sql2	= "insert into relation values('$fid','$uid',null)";
				mysql_query($sql1) or die("error=$sql1 <hr>".mysql_error());
				mysql_query($sql2) or die("error=$sql2 <hr>".mysql_error());
				echo "<script>alert('Friend added!');</script>";
			}			
		}
		
		function delFriend($uid,$fid){
			//echo "<script>alert('$fid');</script>";
			include('class.chat.php');
			$a = new chat;
			$sql1	= "delete from relation where uid = '$uid' and frid = '$fid'";
			$sql2	= "delete from relation where uid = '$fid' and frid = '$uid'";
			$chat_id=  $a->getChatId($uid,$fid);
			//echo "<script>alert('$chat_id');</script>";
			$sql3	= "delete from chat_user where chat_id = '$chat_id'";
			$sql4	= "delete from chat_msg where chat_id = '$chat_id'";
			mysql_query($sql1) or die("error=$sql1 <hr>".mysql_error());
			mysql_query($sql2) or die("error=$sql2 <hr>".mysql_error());
			mysql_query($sql3) or die("error=$sql3 <hr>".mysql_error());
			mysql_query($sql4) or die("error=$sql4 <hr>".mysql_error());
			echo "<script>alert('Friend deleted!');</script>";
		}
		
		function ufriend($id){
			$uf = array();
			$i = 0;
			$sql	= "select * from relation where uid ='$id'";
			$query	= mysql_query($sql)or die("error=$sql <hr>".mysql_error());
			//$num	= mysql_num_rows($query);
			/*while($row	= mysql_fetch_array($query)){
				$newrow = array();
				$newrow['uid'] = $row['uid'];
    			$newrow['frid'] = $row['frid'];
				$uf[] = $newrow;		
			}*/
			while($row	= mysql_fetch_array($query)){
				$uf[$i] = $row[frid];
				$i++;
			}
			//print_r($uf);
			return $uf;
		}
	}
?>