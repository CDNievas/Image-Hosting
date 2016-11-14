<?php
	
	require("../db.php");
	require("config.php");

	$folder = "./uploads/$user";

?>

<html>
	<head>
		<title>Image Hosting - CDNievas</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
		<div id="header">
			<div id="sub_head">
				<p><h1>Welcome, <?php echo $user; ?></h1></p>
				<p><a href="logout.php">Log out</a></p>
			</div>
		</div>

		<div id="body">

			<div id='upload'>
				<center>	

					<h3>Choose an image to upload</h3>
					<form action='upload.php' method='post' enctype='multipart/form-data'>
						<input name='FILE_Image' id='imageInput' type='file' /><br>		
						<input type='submit' id='upload_btn' value='Upload' />
					</form>

					<?php

						if(isset($_GET["error"])) {
							$i = $_GET["info"];
							switch($i){
								case 1:
									echo "You didn't choose any file to upload. Please try again";
								break;
								case 2:
									echo "Unsupported image format. Please try with another";
								break;
								case 3:
									echo "Dimensions of image are too big (Max. '.$max_image_width.'x'.$max_image_height.'). Please try with another";
								break;
								case 4:
									echo "Image too big (Max '.$max_image_size.'MB). Please try with another";
								break;
								case 5:
									echo "Unsupported format. Please try with another";
								break;
							}
						}

					?>

				</center>	
			</div>

			<?php

				if(file_exists($folder) and count(scandir($folder)) > 2) {

					echo " <div id='images'>
					<h2>Images Uploaded:</h2>";

					$query = "SELECT * FROM `images` WHERE `User` = '$user' ORDER BY `ID` DESC";
					$result = mysql_query($query) or die(mysql_error());
					while($row = mysql_fetch_array($result)){ 

						$id = $row[0];
						$urlimage = $row[2];
						echo "

						<div id='image' class='image'>
							<a href='http://localhost/Image Hosting/v1.2/web/uploads/$user/$urlimage' target='_blank'><img src='http://localhost/Image Hosting/v1.2/web/uploads/$user/$urlimage' height='150px' width='150px'></a><br>
							<input type='text' value='http://localhost/Image Hosting/v1.2/web/uploads/$user/$urlimage' class='image' disabled>
							<a href='destroy_image.php?id=$id'><div id='eliminate' class='eliminate'>
								<img src='images/cross.png' width='30px' height='30px'>
							</div></a>
						</div>";

					}

				echo "</div>";

				}  
			?>

		</div>

	</body>
</html>