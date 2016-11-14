<?php
	
	require("db.php");

	session_start();
	if(isset($_SESSION["User"])){
		header("location:web/index.php");
	}
	
?>

<html>
	<head>
		<title>Image Hosting - CDNievas</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
		<div id="center">
			<center>
				<?php
					if(isset($_GET["info"])) {
						$i = $_GET["info"];
						switch ($i) {
						    case 1:
						        echo "<p style='margin-bottom:10px; color:red'>Incorrect User/Pass. Please try again</p>";
						        break;
						    case 2:
						        echo "<p style='margin-bottom:10px; color:red'>Password dont match. Please try again</p>";
						        break;
						    case 3:
						        echo "<p style='margin-bottom:10px; color:red'>Empty fields. Please try again</p>";
						        break;
						    case 4:
						        echo "<p style='margin-bottom:10px; color:red'>Username already in use. Please try with another</p>";
						        break;
						    case 5:
						        echo "<p style='margin-bottom:10px; color:green'>Successful registration. Please log in</p>";
						        break;
						}	
					}
				?>
			</center>
			<div id="col" style="border-right:5px solid #ccc; padding-right:10px;">
				<h1>Register</h1>
				<form method="post" action="register.php">
					<input name="TXT_User" type="text" maxlenght="16" placeholder="Username"><br>
					<input name="TXT_Pass" type="password" placeholder="Password"><br>
					<input name="TXT_Pass2" type="password" placeholder="Re-Password"><br>
					<center><input type="submit" value="Sign Up"></center>
				</form>
			</div>
			<div id="col">
				<h1>Login</h1>
				<form method="post" action="login.php">
					<input name="TXT_User" type="text" maxlenght="16" placeholder="Username"><br>
					<input name="TXT_Pass" type="password" placeholder="Password"><br>
					<center><input type="submit" value="Log In"></center>
				</form>
			</div>
		</div>
	</body>
</html>