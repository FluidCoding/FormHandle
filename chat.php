<?php 
session_start();
if(isset($_SESSION['userName'])){
	echo "Your Logged In " . $_SESSION['userName'];
	draw_chat();
}
else{
	header("Location: enter.php"); /* Redirect browser */
	exit();
}
<!DOCTYPE html>
<html>
<head>
	<title>Chats</title>
</head>
<body>
<textarea enabled="false" cols="100" rows="25" id="chatBox" name="chatBox"></textarea>
<label for="chatText">Enter Message: </label><input type="text" id="chatText" name="chatText" /> <button type="submit" id="send" name="send">Send</button>
</body>
</html>

function draw_chat(){

}
?>