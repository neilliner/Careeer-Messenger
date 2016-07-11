<?php
	include('class.chat.php');
	include('class.user.php');
	$a = new chat;
	$u = new user;
	//echo "<script>console.log(".$_POST['uid'].")</script>";
	//echo "<script>console.log(".$_POST['fid'].")</script>";
	$uid = $_POST['uid'];
	$a->getChat($uid,$_POST['fid']);
	for($row=$a->num-19;$row <= $a->num;$row++){
		if($a->msguid[$row] == $uid){
			echo "<div class='mymsg'>"/*.$a->chatid[$row]*/.$a->msgchat[$row]."<div class='space'></div></div>";
		}
		else{
			if($a->chatid[$row] != "")
				echo /*$a->chatid[$row].*/"<span class='frname'>".$u->checkUser($a->msguid[$row])."</span> <span class='chatmsg'>: ".$a->msgchat[$row]."</span><br>";
		}
	}
?>