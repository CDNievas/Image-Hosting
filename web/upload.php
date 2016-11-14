<?php

	require("../db.php");
	require("config.php");

	//Create the folder for the user
	@mkdir("uploads/$user");

	// Function to generate a random name for the image
	function RandomName($number){ 
		
		//Under the string $Caracteres you write all the characters you want to be used to randomly generate the code. 
		$Char = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 
		$CantChar = strlen($Char); 
		$CantChar--; 

		$Hash=NULL; 
			for($x=1;$x<=$number;$x++){ 
				$Poss = rand(0,$CantChar); 
			        	$Hash .= substr($Char,$Poss,1); 
			   } 

		return $Hash; 
	} 
	
	// Continue only if $_POST is set and it is a Ajax request
	if(isset($_POST)){				

		// Check $_FILES not empty
		if(!isset($_FILES['FILE_Image']) or !is_uploaded_file($_FILES['FILE_Image']['tmp_name'])){
			header("location:index.php?error=1");
		}

		$image_name=$_FILES['FILE_Image']['name'];            	// Name of image
		$image_type=$_FILES['FILE_Image']['type'];              	// Type of image
		$image_tmp=$_FILES['FILE_Image']['tmp_name'];   	// Temp image directory
		$image_bytes=$_FILES['FILE_Image']['size']; 		// File size (in Bytes)
		$image_size_info = getimagesize($image_tmp);  	// Image dimensions

		$ext_file = pathinfo($image_name);			// To get only the file extension
		$image_ext = $ext_file['extension'];			// To get only the file extension
	
		// Check if the file is an image
		if ($image_size_info) {

			// Check the file size
			if($image_bytes <= $max_image_bytes){

				// Check the image dimensions
				if(($image_size_info[0] <= $max_image_width) and ($image_size_info[1] <= $max_image_height)){

					// Search in array if the extension of the file is included on the "Permitted" list
					if(in_array($image_ext, $extension_used)){

						// To generate a random name for the image without using
						$new_name = RandomName(20);
						$query = "SELECT * FROM `images` WHERE (`User` = '$user' AND `URL` = '$new_name')";
						$result = mysql_query($query) or die(mysql_error(header("location:./index.php")));

						while (mysql_num_rows($result) !== 0){
							$new_name = RandomName(20);
							$query = "SELECT * FROM `images` WHERE (`User` = '$user' AND `URL` = '$new_name')";
							$result = mysql_query($query) or die(mysql_error(header("location:./index.php")));
						}

						// Save the image
						$image_final = $destination_folder.$new_name.'.'.$image_ext;
						move_uploaded_file($image_tmp, $image_final)	;
						
						// Upload DB
						$url = $new_name.'.'.$image_ext;
						$date = date("Y-m-d");
						$query = "INSERT INTO `images` (`User`, `URL`, `Date`) VALUES ('$user', '$url', '$date')";
						$result = mysql_query($query) or die(mysql_error());

						header("location:index.php");

					} else {
						imagedestroy($image_tmp);
						header("location:index.php?error=2");
					}

				} else {
					imagedestroy($image_res);
					header("location:index.php?error=3");
				}

			} else {
				imagedestroy($image_tmp);
				header("location:index.php?error=4");
			}

		} else {
			imagedestroy($image_tmp);
			header("location:index.php?error=5");
		}

	}

?>