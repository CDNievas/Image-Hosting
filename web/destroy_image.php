<?php
	
	include("../db.php");
	
	session_start();
	if(!isset($_SESSION["User"])){
		header("location:../index.php");
	}

	if(!isset($_GET["id"])){
		header("location:./index.php");
	} elseif ($_GET["id"] == "") {
		header("location:./index.php");
	} else {

		$id = $_GET["id"];
		$user = $_SESSION["User"];

		$query = "SELECT * FROM `images` WHERE (`ID` = '$id' AND `User` = '$user')";
		$result = mysql_query($query) or die(mysql_error(header("location:./index.php")));

		if (mysql_num_rows($result) == 0) {
			header("location:./index.php");
		} else {
			$result = mysql_fetch_row($result);
			$urlimage = $result[2];
			unlink("uploads/$user/$urlimage");

			$query = "DELETE FROM `images` WHERE (`ID` = '$id' AND `User` = '$user')";
			$result = mysql_query($query) or die(mysql_error(header("location:./index.php")));
		}

	}

?>

<html>
	<head>
		<title>Image Hosting - CDNievas</title>
		<META HTTP-EQUIV="Refresh" CONTENT="2; URL=./index.php">
		<link rel="stylesheet" type="text/css" href="./styles.css">
	</head>
	<body>
		
		<div id="header">
			<div id="sub_head">
				<p><h1>Welcome, <?php echo $user; ?></h1></p>
				<p><a href="logout.php">Log out</a></p>
			</div>
		</div>

		<div id="body">
			<div style='position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%); background:#F2F2F2; padding:20px;'>
				<center>
					<h3 style="padding:0; margin:0;">The image has been succesfully deleted. You will be redirected in a seconds.</h3>
				</center>		
			</div>
		</div>
	</body>
</html>