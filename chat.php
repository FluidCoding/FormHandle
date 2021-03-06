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
		margin:0px;
		padding:0px;
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
		margin-top: 75px;
		margin-left: auto;
		margin-right: auto;
		background-color: #214187;
		color: #D2F608;
		font-family: Tahoma, Geneva, sans-serif;
		padding: 15px;
		border-radius: 9px;
		border: 2px solid #000;
	}
	#chatBox{
		background-color: #BDBDBD;
		text-align: left;
	}
	
	input[type='text']#chatText{
		width: 525px;
		padding:7px;
		margin-right: 10px;
		background-color: #eee;
		display:inline-block;
	}
	button#send{
		padding: 8px;
		display:inline;
	}
	#welcome{  
		position: absolute;
    	top: 0px;
		margin: 0px;
		padding: 0px;
		width: 100%;
		background-color: #FF8D00;
		text-align: center;
	}
	#welcome h1{
		margin:0px;
		padding-top: 3px;
		padding-bottom: 3px;
	}
	</style>
	<script>
	var xhr;
	function initChat(){
		console.log("Init Chat");
		ping();
    }
	
	function ping(){
		xhr = new XMLHttpRequest();
		xhr.open('GET', 'chatter.php?ping=1');
		xhr.send(null);
		xhr.onload=packBack.bind(xhr);
	}

	var x=0;
	var Messages = [];
	function packBack(){
		if (xhr.readyState === xhr.DONE) {
        if (xhr.status === 200) {
            //console.log(xhr.responseText);
            JSON.parse(xhr.responseText, function(k, v) {
  				if(k==='user'){
  					Messages[x] = new Message();
  					Messages[x].user = v;
  				}
  				else if(k==='txt'){
  					Messages[x].txt = v;
  				}
  				else if(k==='timeStamp'){
  					Messages[x].timeStamp = v;
  				}
  				else{
  					x++;
  				}
  			});
        }
        }
        updateChatBox();
        x=0;
		window.setTimeout(ping, 5000);
	}
	var Mess = {
		user:'',
		txt: '',
		timeStamp: ''};
	var Message = function(user, txt, timeStamp){
		this.user = user;
		this.txt = txt;
		this.timeStamp = timeStamp;
	};
	function updateChatBox(){
		var chatBox = document.getElementById("chatBox");
		var out = "";
		for(var i=Messages.length-1; i >=0 ; i--){
			out+= "[" + Messages[i].timeStamp + "] - ";
			out+= Messages[i].user + ": ";
			out+= Messages[i].txt + "\n";
		}
		chatBox.innerHTML=out;
	}

	function sendChat(){
		var uID = document.getElementById("userID").value;
		var chatTxt = document.getElementById("chatText");
		if(chatTxt.value === ''){
			return;
		}
		xhrSend = new XMLHttpRequest();

		xhrSend.open('GET', 'chatter.php?user='+ uID + '&message=' + chatTxt.value);
		xhrSend.send(null);

		xhrSend.onreadystatechange = function () {
		
		var DONE = 4; // readyState 4 means the request is done.
	    var OK = 200; // status 200 is a successful return.
	    if (xhrSend.readyState === DONE) {
	    	if (xhrSend.status === OK) 
	     		console.log(xhrSend.responseText); // 'This is the returned text.'
				chatTxt.value = '';
	    	} else {
	    		console.log('Error: ' + xhr.status); // An error occurred during the request.
	    	}
		};
	}
	function listenChat(){

	}
	</script>
</head>
<body onload="initChat();">
<div id="welcome" name="welcome"><h1>Hello <?php echo $_SESSION["userName"]; ?>!</h1></div>
<div id="container">
	<input type="hidden" id="userID" name="userID" value=<?php echo "'" . $_SESSION["userID"] ."' "; ?> />
	<a id="logout" href="logout.php">Logout</a>
	<textarea enabled="false" readonly="true" cols="100" rows="14" id="chatBox" name="chatBox"></textarea><br />
	<label for="chatText">Enter Message: </label><input type="text" id="chatText" name="chatText" /> <button type="submit" id="send" onclick="sendChat();" name="send">Send</button>
</div>
</body>
</html>