<?php 
session_start();
if(isset($_SESSION['userName'])){
	//echo "Your Logged In " . $_SESSION['userName'];
}
else{
	header("Location: enter.php"); /* Redirect browser */
	exit();
}
$userName = $_SESSION["userName"];
$userID = $_SESSION["userID"];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Chats</title>

	<style type="text/css">
	body{
		background-color: #1E3637;
	}
	div a#logout{
		display:inline;
		text-decoration: none;
		float:right;
		color: #000;
		font-family: Tahoma, Geneva, sans-serif;
	}

	#container{
		min-width: 500px;
		width: 950px;
		height: 100%;
		margin-left: auto;
		margin-right: auto;
		background-color: #214187;
		color: #D2F608;
		font-family: Tahoma, Geneva, sans-serif;
		padding: 12px;
		border-radius: 9px;
		border: 2px solid #000;
	}
	#chatBox{
		background-color: #BDBDBD;
		text-align: right;
	}
	
	input[type='text']#chatText{
		width: 95%;
		padding:7px;
		margin-right: 10px;
		background-color: #eee;
	}
	</style>
	<script>
	function initChat(){
		console.log("Init Chat");
	}

	function sendChat(){
		
	}
	function listenChat(){

	}
	</script>
</head>
<body onload="initChat();">
<h1>Hello <?php echo $_SESSION["userName"]; ?>!</h1>
<div id="container">
	<a id="logout" href="logout.php">Logout</a>
	<textarea enabled="false" readonly="true" cols="100" rows="14" id="chatBox" name="chatBox"></textarea><br />
	<label for="chatText">Enter Message: </label><input type="text" id="chatText" name="chatText" /> <button type="submit" id="send" name="send">Send</button>
</div>
</body>
</html>