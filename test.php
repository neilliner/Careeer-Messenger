<?php
session_start();
if(empty($_SESSION))
{ exit("<script>alert('Please log in'); window.location='index.php';</script>");}
//include("connect.php");
include("class.user.php");
$uid = $_SESSION['uid'];
$u = new user;
if(isset($_POST['searchid'])){
	//echo "<script>alert('".$_POST['searchid']."');</script>";
	if($u->checkId($_POST['searchid']) != -1){
		//echo "<script>alert('Will add!! id = ".$u->checkId($_POST[searchid])."');</script>";
		$u->addFriend($uid,$u->checkId($_POST['searchid']));
		//header("location: http://www.neilsite.com/careeer/test/test.php");
	}
	else{
		echo "<script>alert('Not exist!!');</script>";
		//header("location: http://www.neilsite.com/careeer/test/test.php");
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Careeer Messenger</title>
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="style.css">	
<script>
$(document).ready(function(){
	$("#searchfriend").hide();
	$("#addfriend").click(function(){
	$("#searchfriend").toggle("slow");
	});
});

var indexFriendId = document.URL.indexOf("?friend=") + 8;
var friendId = document.URL.slice(indexFriendId);
console.log(friendId);
function loadAjax(){
if(friendId > 0 ){
$.ajax({
	url: "testchat.php",
	data: {uid: "<?php echo $_SESSION['uid']; ?>", fid: friendId},
	type: 'post',
	cache: false}).done(function( html ) {
	$( "#chatbox" ).html( html );
	});
}
}
setInterval(function(){loadAjax()}, 2500);

</script>
</head>
<body onload="loadAjax()">
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
	include("class.chat.php");	
	$a = new chat;
	//$friend=2;
	//$u->ufriend($uid);
	$uflength = count($u->ufriend($uid));
	//echo $uflength;
	//print_r($u->ufriend($uid));
	echo "<div id='friend' class='clearFix'>".$u->checkUser($uid).", these are your friends:";
	echo "<form id='friendform' name='friend' action='test.php' method='get'><div id='friendbox'>";
	for($i=0;$i<$uflength;$i++){echo "<a href=test.php?friend=".$u->ufriend($uid)[$i]."><div class='friend'>".$u->checkUser($u->ufriend($uid)[$i])."</div></a>";$friend = $u->ufriend($uid)[$i];}
	echo "</div></form>";
	echo "</div>";
	//$chatlength = count($a->num);
?>
	<div id="adddel">
		<div id="addfr">
			<a id="addfriend" href="#">add more friend</a>
		</div>
		<div id="delfr">
			<span class="right"><a id="deletefriend" href="testdelete.php">delete friend</a></span>
		</div>
	</div>
	<div id="searchwrapper">
	<div id="searchfriend">
	<form id="search" name="search" method="post" action="">
		<input type="text" id="searchid" name="searchid">&nbsp;&nbsp;&nbsp;
		<input type="submit" value="Add"><br><br>
	</form>
	</div>
	</div>
	<div id='chatbox'><span class="center">Click your friend's name to chat.</span></div>
	<?php
	/*echo "<div id='chatbox'>";
	//echo $friend;
	$a->getChat($uid,$_GET['friend']);
	for($row=$a->num-19;$row <= $a->num;$row++){
		//echo $row;
		if($a->msguid[$row] == $uid){
			echo "<div class='mymsg'>".$a->chatid[$row].$a->msgchat[$row]."</div>";
		}
		else{
			if($a->chatid[$row] != "")
			echo $a->chatid[$row].$u->checkUser($a->msguid[$row]).":".$a->msgchat[$row]."<br>";
		}
	}
	echo "</div>";*/
	//print_r($a->msguser);
	//print_r($a->msgchat);
		if(isset($_POST['chattxt']) && isset($_GET['friend'])){
		$a->saveChat($_POST['chattxt'],$_POST['uid'],$_GET['friend']);
		header("location: http://www.neilsite.com/careeer/test/test.php");		
	}
	?>
<table id="chattextbox">
	<form name="chat" id="chat" method="post" action="">
	<tr>
		<td><input type="text" id="chatinput" name="chattxt"></td>
	</tr>
	<tr>
		<td><input type="hidden" name="uid" value="<?php echo $uid ?>">
		<!--<input type="hidden" name="fid" value="<?php echo $friend ?>">-->
		<input type="submit" value="Send" id="submitbutton"></td>
	</tr>
	</form>
</table>
</div>
</body>
</html>
