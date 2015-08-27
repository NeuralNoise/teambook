<?php
// createthumbs() function is defined in the functions.php includes file
require_once("includes/functions.php"); 

if (isset($_POST['submit'])){
    
    //files upload - profile pic upload
		$originals_dir = "assets/images/uploads/profpic/originals/";
		$large_dir = "assets/images/uploads/profpic/large/";
		$large_width = 100;
		$thumb_dir = "assets/images/uploads/profpic/tn/";
		$thumb_width = 50;
                $upload_dir = SITE_ROOT . "assets/images/uploads/profpic/originals/";
		$image_fieldname = "userPic";
		
		$php_errors = array(1 => 'Maximum file size in php.ini exceeded',
                    2 => 'Maximum file size in HTML form exceeded',
                    3 => 'Only part of the file was uploaded',
                    4 => 'No file was selected to upload.');
		
		// Make sure we didn't have an error uploading the image
		($_FILES[$image_fieldname]['error'] == 0)
  			or handle_error("the server couldn't upload the image you selected.",
                  $php_errors[$_FILES[$image_fieldname]['error']]);

		// Is this file the result of a valid upload?
		@is_uploaded_file($_FILES[$image_fieldname]['tmp_name'])
		  or handle_error("you were trying to do something naughty. Shame on you!",
						  "Uploaded request: file named '{$_FILES[$image_fieldname]['tmp_name']}'");

		// Is this actually an image?
		@getimagesize($_FILES[$image_fieldname]['tmp_name'])
		  or handle_error("you selected a file for your picture that isn't an image.",
						  "{$_FILES[$image_fieldname]['tmp_name']} isn't a valid image file.");
		
		// Name the file uniquely
		$now = time();
		while (file_exists($upload_filename = $upload_dir . $now .
											 '-' .
											 $_FILES[$image_fieldname]['name'])) {
			//$userpic = $_FILES[$image_fieldname]['name'];
			$now++;
		}

		// Finally, move the file to its permanent location
		@move_uploaded_file($_FILES[$image_fieldname]['tmp_name'], $upload_filename)
		  or handle_error("we had a problem saving your image to its permanent location.",
						  "permissions or related error moving file to {$upload_filename}");
		  
		$original_filename = str_replace($upload_dir,'/',$upload_filename);
		createlargepic($originals_dir,$large_dir,$original_filename,$large_width);
                createthumbs($originals_dir,$thumb_dir,$original_filename,$thumb_width);  
    
    
    
    
    $message = "Congratulations! You successfully uploaded an image and turned it into a thumbnail!";
}


?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>PHP File upload and create thumnnail test</title>
        </head>
        <body>
            <h1>PHP File upload and create thumnnail test</h1>
            <form name="fileupload" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <P>
                    <label for="userPic">Profile Picture:</label>
                    <input name="userPic" type="file" />
                </P>
                <P>
                    <input name="submit" type="submit" value="UPLOAD FILE" />
                </P>
            </form>
            <p><?php if(!empty($message)){echo $message;} ?></p>
        </body>
    </html>