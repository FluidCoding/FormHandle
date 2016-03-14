<?php
	session_start();
	if(isset($_SESSION['userID'])){
		header("Location: chat.php"); /* Redirect browser */
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">

	body{
		font-family: Tahoma, Geneva, sans-serif;
		background-color: #ccc;
	}

	label{
		padding-right: 7px;
		padding-left: 7px;
	}
	
	input[type~="text"]{
		padding: 5px;
	}

	button[type="submit"]{
		padding: 9px;
		margin-left: 10px;
		margin-right: 10px;
	}

	</style>

	<script>
		function inputDrawer(){
			var dInputs = document.getElementsByClassName("register");
			var checkBox = document.getElementById("signIn");
			var login = document.getElementById("signInButton");
			for(var i=0; i<dInputs.length; i++){
				if(checkBox.checked){
					dInputs[i].style.display='none';
				}
				else{
					dInputs[i].style.display='inline';
				}
			}
		}
	</script>
	<title>Entrance</title>
</head>
<body>
<h1>
<?php echo "Hello Pls SignIn | SignUp" ?>
 </h1>


<?php
	include_once("vars.php");
	showLogin();
	if(isset($_GET['register'])){
		$regState = $_GET['register'];
		if($regState=="success"){
			echo "<p>Account Created! Please Login</p>";
		}
		else{
			echo "<p>Registration Failed</p>";
		}
	}
	function showLogin(){
		echo "<form id='login' method='post' name='login' action='login.php'>";
		echo "<label for='name'>Username: </label><input type='text' length='12' name='name' /><br />";
		echo "<span class='register' style='display:none;'><label for='name'>Email: </label><input type='text' length='12' name='email' /></span><br />";
		echo "<label for='passWord'>Password: </label><input type='password' length='12' name='passWord' /><br />";
		echo "<span class='register' style='display:none;'><label for='passWordConfirm'>Confirm Password: </label><input type='passWord' length='12' name='passWordConfirm' /></span><br />";
		echo "<label for='signIn'>I already have account</label> <input type='checkbox' id='signIn' name='signIn' onchange='inputDrawer();' checked='true' value='on' /><br />";
		echo "<button id='signInButton' type='submit'> Sign In </button>";
		echo "</form>";
	}

?>
</body>
</html>
