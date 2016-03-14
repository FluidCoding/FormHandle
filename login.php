<?php
	include_once("vars.php");
	$login = $_POST['login'];

	$userName = $_POST["name"];
	$email = $_POST["email"];
	$passWord = $_POST["passWord"];
	$passWordConfirm = $_POST["passWordConfirm"];
	$checked = $_POST["signIn"];

/*
	echo "user name : " . $userName . "<br />";
	echo "email: " . $email . "<br />";
	echo "password: " . md5($passWord) . "<br />";
	if($passWordConfirm.length>1){ echo "passWordConfirm : " . md5($passWordConfirm) . "<br />";}
	echo "checked : " . $checked . "<br />";
*/
	($checked=="on")?login($userName, $passWord):register($userName, $passWord, $email, $passWordConfirm);


	function register($user, $pass, $email, $confirm){
		global $dbP, $dbConn, $dbU;
		if($pass != $confirm){
//			echo "Passwords do not match...";
		//	header("Location: enter.php"); /* Redirect browser */
		//	exit();
		//	return;
		}else{

			//	header("Location: enter.php?register='success'"); /* Redirect browser */
			//	exit();
		}
		try {
  		  	$conn = new PDO($dbConn, $dbU, $dbP);
    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  	  		$statement  = $conn->prepare("INSERT INTO users (id, name, email, password, verrified) VALUES (:id, :user, :email, :passWord, :verified)");
					$res = $statement->execute(array(
						"id" => NULL,
    					"user" => $user,
    					"email" => $email,
				    	"passWord" => md5($pass),
				    	"verified" => FALSE
					));
			if( $res ){
//				echo "Success.";
			}
			else {
//				echo "Failed.";
			}
  		}
		catch(PDOException $e)
 	  	{
	    	echo "failed: " . $e->getMessage();
	    }
		$conn = null;
	}

	function login($userName, $passWord){
		global $dbP, $dbConn, $dbU;
//		echo "Var check ". $dbP . $dbConn . $dbU;
//		echo "Logging in..." . $userName . " P " . $passWord . " MD5d : " . md5($passWord). "<br />";  
	  	$conn = new PDO($dbConn, $dbU, $dbP);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  		$statement  = $conn->prepare("SELECT id, name FROM users WHERE name = :userName AND password = :passWord");
  		$statement->bindParam(':userName', $userName, PDO::PARAM_STR);
		$statement->bindParam(':passWord', md5($passWord), PDO::PARAM_STR);
			$res = $statement->execute();
			$result = $statement->fetchAll();
	//		echo $result . "<br/>";
//			echo count($result) ."<br/>";
			if(count($result)){
				session_start();
			    $_SESSION['userName'] = $result;
			    $_SESSION['userID'] = $result[0]['id'];
			    
			    $_SESSION['userName'] = $userName;
				header("Location: chat.php"); /* Redirect browser */
				exit();
			}
			else {
//				echo "Incorrect Username Or Password.";
//			    $_SESSION['userID'] =  				
				header("Location: enter.php"); /* Redirect browser */
				exit();
			}

	}
?>
