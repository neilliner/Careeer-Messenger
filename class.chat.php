<?php
	include("connect.php");
	class chat{
		//public $sql;
		//public $query;
		public $num;
		public $msguser = array();
		public $msgchat = array();
		public $msguid = array();
		public $chatid = array();
		//public $row = array();
		//public $chat = array();
		/*function __construct(){
			$this->sql	= "select * from chat order by cid asc"; 
			$this->query = mysql_query($this->sql)or die("error=$this->sql <hr>".mysql_error());
			$this->num	= mysql_num_rows($this->query);
			//echo $this->num;
			
		}*/
		
		function getChat($uid, $frid){
			$chat_id = self::getChatId($uid, $frid);
			//echo "chat id = ".$chat_id;
			//echo $uid;
			//echo $frid;
			$sql = "select * from chat_msg where chat_id ='$chat_id' order by msg_id asc";//user_id in ('$uid','$frid') order by msg_id asc"; 
			$query = mysql_query($sql)or die("error=$sql <hr>".mysql_error());
			$this->num	= mysql_num_rows($query);
			//echo $this->num;
			$n=1;
			$nl=$this->num;
			//$oldmsguser = array();
			$oldmsgchat = array();

			//while(($nl-20) > 0){
				//$n++;
				//$nl--;
				//}
			//echo $n;
			//echo $nl;
			$count = 0;
			while($row = mysql_fetch_array($query))
			{
				/*if($row['cid'] < $n){
					//$oldmsguser[$n] = $row['m_user'];			
					$oldmsgchat[$n] = $row['msg'];
				}*/
				//echo $row['msg'];
  				//while($count >= $n)
  				//{
  					$this->chatid[$n] = $row['msg_id'];
					$this->msguid[$n] = $row['user_id'];
					//$this->msguser[$n] = $row['m_user'];			
					$this->msgchat[$n] = $row['message'];
					
					//$this->chat[] = array('user' => $row['m_user'], 'msg' => $row['msg']);
					//$this->chat[$n][] = $row['m_user'];
					//$this->chat[][$n] = $row['msg'];
					//echo $row['msg'];
					//echo $n;
    				$n++;
    				$count++;
  				//}
  				//print_r($this->msguser);
  				//print_r($row);
  			}
  			//print_r($this->msgchat);
		}
		//echo $this->msgchat;
		/*function setChat(){
			self::getChat();
			echo $msgchat;
			//return $msgchat;
		}*/
		function getChatId($uid,$fid){
			if($fid == 0){echo "fid = 0"; return;}
			$sql1 = "select * from chat_user where user_id='$uid'";
			$sql2 = "select * from chat_user where user_id='$fid'";
			$query1 = mysql_query($sql1) or die("error=$sql1 <hr>".mysql_error());
			$query2 = mysql_query($sql2) or die("error=$sql2 <hr>".mysql_error());
			
			$cid1 = ""; $cid2 = array();
			$i = 0;
			while($row1 = mysql_fetch_array($query1)){
				//echo "<script>alert('chat_id1 = ".$row1['chat_id']." uid = ".$row1['user_id']."');</script>";
				$cid1 = $row1['chat_id'];
				for($x=0;$x<count($cid2);$x++){
				if($cid1 == $cid2[$x]){
						return $cid1; break;
				}
				}
				while($row2 = mysql_fetch_array($query2)){
					//echo "<script>alert('chat_id2 = ".$row2['chat_id']." uid = ".$row2['user_id']."');</script>";
					$cid2[$i] = $row2['chat_id'];
					if($cid1 == $cid2[$i]){
						return $cid1; break;
					//if($row1['chat_id'] == $row2['chat_id']){
					//	echo "<script>alert('chat_id1 = ".print_r($row1)/*$row1['chat_id']*/." chat_id2 = ".print_r($row2)/*$row2['chat_id']*/."');</script>";
					//	return $row1['chat_id']; break;
					}
					$i++;
					/*else {
						$sql = "select MAX(chat_id) + 1 from chat_user";
						$newchatid = mysql_query($sql) or die("error=$sql <hr>".mysql_error());
						$sqlu = "insert into chat_user values ('$newchatid','$uid',null,0)";
						$sqlf = "insert into chat_user values ('$newchatid','$fid',null,0)";
						mysql_query($sqlu) or die("error=$sqlu <hr>".mysql_error());
						mysql_query($sqlf) or die("error=$sqlf <hr>".mysql_error());*/
						//self::getChatId($uid,$fid);
						/*while($row1 = mysql_fetch_array($query1)){
							//echo "<script>alert('chat_id1 = ".$row1['chat_id']."');</script>";
							while($row2 = mysql_fetch_array($query2)){
								//echo "<script>alert('chat_id2 = ".$row2['chat_id']."');</script>";
								if($row1['chat_id'] = $row2['chat_id']){
									//echo "<script>alert('chat_id1 = ".$row1['chat_id']." chat_id2 = ".$row2['chat_id']."');</script>";
									return $row1['chat_id'];*/
					//}
				}
			}
			//echo "<script>alert('addnewid');</script>";
			return self::addNewChatId($uid,$fid); 
		}
		function addNewChatId($uid,$fid){
			$sql = "select MAX(chat_id) from chat_user";
			$query = mysql_query($sql) or die("error=$sql <hr>".mysql_error());
			$newchatid;
			while($row = mysql_fetch_array($query)){
				//echo "<script>alert('chat_id = ".$row[0]."');</script>";
				$newchatid = $row[0] + 1;
			}
			//$newchatid = $row['chat_id'] + 1;
			//echo "<script>alert('query = ".print_r($query)."');</script>";
			/*while($row = mysql_fetch_assoc($query)){
				echo "<script>alert('row of chat_user = ".$row['chat_id']."');</script>";
				$newchatid = $row['chat_id'] + 1 ;
			}*/
			//echo "<script>alert('newchatid = ".$newchatid."');</script>";
			
			
			$sqlu = "insert into chat_user values ('$newchatid','$uid',null,0)";
			$sqlf = "insert into chat_user values ('$newchatid','$fid',null,0)";
			mysql_query($sqlu) or die("error=$sqlu <hr>".mysql_error());
			mysql_query($sqlf) or die("error=$sqlf <hr>".mysql_error());
			
			
			return $newchatid;
			//self::getChatId($uid,$fid);
			/*while($row1 = mysql_fetch_array($query1)){
				//echo "<script>alert('chat_id1 = ".$row1['chat_id']."');</script>";
				while($row2 = mysql_fetch_array($query2)){
					//echo "<script>alert('chat_id2 = ".$row2['chat_id']."');</script>";
					if($row1['chat_id'] = $row2['chat_id']){
						//echo "<script>alert('chat_id1 = ".$row1['chat_id']." chat_id2 = ".$row2['chat_id']."');</script>";
						return $row1['chat_id'];*/
			
		}
		function saveChat($ctxt,$uid,$fid) {
			//echo "<script>alert('fid = ".$fid."');</script>";
			$chat_id = self::getChatId($uid,$fid);
			//$chat_id = $this->getChatId($uid,$fid);
			//echo "<script>alert('chat_id = ".$chat_id."');</script>";
			$txtmsg = mysql_real_escape_string($ctxt);
			$sql = "insert into chat_msg values('$chat_id', null, '$uid', null, '$txtmsg')";
			mysql_query($sql) or die("error=$sql <hr>".mysql_error());
		}
	}
?>