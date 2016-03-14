<?php
	include_once("vars.php");
	global $dbP, $dbConn, $dbU;

	class Message{
		public $user = "son";
		public $message = "Hello World!";
		 function __construct($u, $m){
		 	$user = $u;
		 	$message = $m;
		}
	}

	$m = $_GET["message"];
	$u = $_GET["user"];
	$message = new Message($u, $m);
	
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
		header('Content-type: application/json');
			  	$conn = new PDO($dbConn, $dbU, $dbP);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  		$statement  = $conn->prepare("SELECT users.name, send_time, txt FROM messages JOIN users ON messages.user_id=users.id WHERE send_to = 0 ORDER BY send_time DESC LIMIT 10");
		$res = $statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $ind => $msg){
			echo "[" . $msg["send_time"] . "] - " . $msg["name"] . " : " . $msg["txt"];
			echo "\n";
		}
				//}
//				echo "Incorrect Username Or Password.";
//			    $_SESSION['userID'] =  				
//		echo json_encode($message);
	}
?>