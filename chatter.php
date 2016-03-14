<?php
	include_once("vars.php");
	global $dbP, $dbConn, $dbU;

	class Message{
		public $user;
		public $message;
		 function __construct($u, $m){
		 	$this->user = $u;
		 	$this->message = $m;
		}
	}

	class ChatBoxMessages{
		public $user;
		public $txt;
		public $timeStamp;
		function __construct($u,$t, $tS){
			$this->user=$u;
			$this->txt = $t;
			$this->timeStamp=$tS;
		}
	}

	$m = $_GET["message"];
	$u = $_GET["user"];
	$message = new Message($u, $m);
	$messages = array();

	echo "Hello ";
	if(isset($m) & isset($u)){
		try {
	  		$conn = new PDO($dbConn, $dbU, $dbP);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$statement  = $conn->prepare("INSERT INTO messages (message_id, user_id, send_time, send_to, txt) VALUES (NULL, :user_id, CURRENT_TIMESTAMP, :send_to, :txt)");
				$res = $statement->execute(array(
    				"user_id" => $u,
			    	"send_to" => 0,
			    	"txt" => $m
				));
			if( $res ){
				header('Content-type: application/json');
				echo json_encode($message);
				//exit();
			}
			else {
//				echo "Failed.";
			}
  			
		}catch(PDOException $e)
 	  	{
// 	  		var_dump($e);
	    	echo "failed: " . $e->getMessage();
	    }
	    $conn = null;
	}
	
	$ping = $_GET["ping"];
	if(isset($ping)){
			  	$conn = new PDO($dbConn, $dbU, $dbP);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  		$statement  = $conn->prepare("SELECT users.name as username, send_time, txt FROM messages JOIN users ON messages.user_id=users.id WHERE send_to = 0 ORDER BY send_time DESC LIMIT 10");
		$res = $statement->execute();
		$result = $statement->fetchAll();
		header('Content-type: application/json');
		foreach($result as $ind => $msg){
			$messages[] = new ChatBoxMessages($msg["username"],$msg["txt"], $msg["send_time"]);
//			echo "\n";
		}
		echo json_encode($messages);
				//}
//				echo "Incorrect Username Or Password.";
//			    $_SESSION['userID'] =  				
//		echo json_encode($message);
	}
?>