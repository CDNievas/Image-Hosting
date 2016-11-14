<?php
	
	require("db.php");

	session_start();
	if(isset($_SESSION["User"])){
		header("location:web/index.php");
	} else {

		if(empty($_POST["TXT_User"]) or empty($_POST["TXT_Pass"])){
			
			header("location:index.php?info=3");
			
		}  else {

			$user = $_POST["TXT_User"];
			$pass = $_POST["TXT_Pass"];
			$query = "SELECT * FROM `users` WHERE (`User` = '$user' AND `Password` = '$pass')";
			$result = mysql_query($query) or die(mysql_error());
		
			if (mysql_num_rows($result) > 0) {
			
			$_SESSION["User"] = $user;
				header("location:web/index.php");
			
			} else {
				header("location:index.php?info=1");
			}
				
		}
	}
?>