<?php 
	if(isset($_POST["firstName"])){

	}
	else{
		echo "<p>Please fill out your information</p>";
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
	#FormIn label{
		padding-right: 7px;
		padding-left: 7px;
	}
	
	#FormIn input[type~="text"]{
		padding: 5px;
	}

	#FormIn button[type="submit"]{
		padding: 9px;
		margin-left: 10px;
		margin-right: 10px;
	}
	</style>
	<title>Forms In</title>
</head>
<body>

<?php
	if( isset($_POST["firstName"]) ){
		echo "<h1>Hello " . $_POST["firstName"] . "</h1>";
	}
?>


<form action="formIn.php" method="post" id="FormIn" name="FormIn">

<?php

	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];

	if(isset($_POST["Submit"])){
		echo "<p>Assoc</p>";
		foreach($_POST as $k => $v){
			echo "[\"" . $k . "\"] = ";
			echo htmlEntities($v, ENT_QUOTES) . "<br />";
		}
		echo "<br />";
		echo "<p>JSON: </p>";
		echo htmlEntities(json_encode($_POST), ENT_QUOTES);
		echo "<input type='hidden' name='firstName' value='". $firstName . "' />";
		echo "<input type='hidden' name='lastName' value='". $lastName . "' />";
	}
	else{
		
	
		echo "<label for='firstName'>First Name: </label><input type='text' length='12' value='" . $firstName . "' name='firstName' />";

		echo "<label for='lastName'>Last Name: </label><input type='text' length='12' value='" . $lastName . "' name='lastName' />";

	}
?>
<br />
<br />
<br />
<button type="submit" name="Submit">Submit</button>
<button type="submit" name="Save">Save</button>
</form>
</body>
</html>
