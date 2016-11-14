<?php

	session_start();
	if(!isset($_SESSION["User"])){
		header("location:../index.php");
	}

	$user = $_SESSION["User"];

################################################## Configuration ##################################################

	$max_image_bytes = 2097152; 						// Maximum image size (on Bytes)
	$max_image_height = 3000;							// Maximum image height
	$max_image_width = 3000;							// Maximum image width
	$destination_folder = "./uploads/$user/"; 					// Upload directory (ends with "/","slash")
	$extension_used= array("png","gif","jpg","bmp","PNG","GIF","JPG","BMP");	// Extensions permitted

################################################################################################################

?>