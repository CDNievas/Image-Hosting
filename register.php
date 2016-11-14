<?php
	
	require("db.php");

	session_start();
	if(isset($_SESSION["User"])){
		header("location:web/index.php");
	} else {

		if(empty($_POST["TXT_User"]) or empty($_POST["TXT_Pass"]) or empty($_POST["TXT_Pass2"])){
			
			header("location:index.php?info=3");
			
		} else {
			
			if($_POST["TXT_Pass"] !== $_POST["TXT_Pass2"]){
				header("location:index.php?info=2");
			} else {

				$user = $_POST["TXT_User"];
				$pass = $_POST["TXT_Pass"];
				$query = "SELECT * FROM `users` WHERE (`User` = '$user')";
				$resultado = mysql_query($query) or die(mysql_error());
		
				if (mysql_num_rows($resultado) > 0) {
					header("location:index.php?info=4");
				} else {
					$query = "INSERT INTO `users` (`User`, `Password`) VALUES ('$user', '$pass')";
					$resultado = mysql_query($query) or die(mysql_error());
					header("location:index.php?info=5");
				}
			}
			
		}

	}
?>