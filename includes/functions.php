<?php
    //This file is the place to store all basic functions
    
    function mysql_prep( $value ) {
        $magic_quotes_active = get_magic_quotes_gpc();
        $new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
        if( $new_enough_php ) { // PHP v4.3.0 or higher
            // undo any magic quote effects so mysql_real_escape_string can do the work
            if( $magic_quotes_active ) { $value = stripslashes( $value); }
            $value = mysql_real_escape_string( $value );
        } else { // before PHP v4.3.0
            // if magic quotes aren't already on then add slashes manually
            if( !$magic_quotes_active) { $value = addslashes( $value); }
            // if magic quotes are active, then the slashes already exist
        }
        return $value;
    }
    
    function redirect_to( $location = NULL) {
        if ($location != NULL) {
            header("Location: {$location}");
            exit;
        }

    }
    
    function confirm_query($result_set) {
        if (!$result_set) {
            die("Database query failed: " . mysql_error());
            }
    }
	
	// Set up debug mode
	define("DEBUG_MODE", true);
	
	// Site root
	define("SITE_ROOT", $_SERVER['DOCUMENT_ROOT'] . "teambook_v2/");
	//define("SITE_ROOT", "/home4/yellowta/www/phpMM/");
	
	// Error reporting
	if (DEBUG_MODE) {
	  error_reporting(E_ALL);
	} else {
	  // Turn off all error reporting
	  error_reporting(0);
	}
	
	function debug_print($message) {
	  if (DEBUG_MODE) {
		echo $message;
	  }
	}
	
	function handle_error($user_error_message, $system_error_message) {
	  //session_start();
	  //$_SESSION['error_message'] = $user_error_message;
	  //$_SESSION['system_error_message'] = $system_error_message;
	  header("Location: show_error.php?error_message={$user_error_message}&system_error_message={$system_error_message}");
	  //header("Location: " . get_web_path(SITE_ROOT) . "scripts/show_error.php");
	  exit();
	}

	function get_web_path($file_system_path) {
	  return str_replace($_SERVER['DOCUMENT_ROOT'], '/', $file_system_path);
	}
	
	function get_web_path_tn($file_system_path) {
	    $replace_section = $_SERVER['DOCUMENT_ROOT'] . "teambook/assets/images/uploads/profpic/";
	    return str_replace($replace_section, 'assets/images/uploads/profpic/tn/', $file_system_path);
	}
	
	// This function creates a log.txt file if nto exists and appends the log entry for login/ logout etc into file
	function log_action($action, $message="") {
	    $logfile = SITE_ROOT2.DS.'logs'.DS.'log.txt';
	    $new = file_exists($logfile) ? false : true;
		if($handle = fopen($logfile, 'a')) { // append
		    $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
		    $content = "{$timestamp} | {$action}: {$message}\n";
		    fwrite($handle, $content);
		    fclose($handle);
		    if($new) { chmod($logfile, 0755); }
	    } else {
		echo "Could not open log file for writing.";
	    }
	}

// IMAGE/ PHOTO FILE CREATION CODE:
function createthumbs ($origImagePath,$tnImagePath,$fname,$thumbWidth){
    	/* code to copy image file form originals folder uploaded to,
	    then reduce size to thumbnail,
	    then save in thumbnail directory */
    
    // 1. open the originals directory
        $origdir = opendir($origImagePath);
        
    // 2. Find the original imaeg file
    //$fname = "1397841364-KamalProfPic1.jpg";
    //echo "Creating thumbnail for {$origImagePath}{$fname} <br />";
        
    // 3. load image and get image size
        $img = imagecreatefromjpeg( "{$origImagePath}{$fname}" );
        $width = imagesx( $img );
        $height = imagesy( $img );

    // 4. calculate thumbnail size
        $new_width = $thumbWidth;
        $new_height = floor( $height * ( $thumbWidth / $width ) );

    // 5. create a new temporary image
        $tmp_img = imagecreatetruecolor( $new_width, $new_height );

     // 6. copy and resize old image into new image 
        //imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
	imagecopyresampled( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

    // 7. save thumbnail into a file
        imagejpeg( $tmp_img, "{$tnImagePath}{$fname}" );
        
    // 8. close the directory
        closedir( $origdir );       
}

function createlargepic ($origImagePath,$largeImagePath,$fname,$thumbWidth){
    	/* code to copy image file form originals folder uploaded to,
	    then reduce size to large,
	    then save in large directory */
    
    // 1. open the originals directory
        $origdir = opendir($origImagePath);
        
       
    // 2. load image and get image size
        $img = imagecreatefromjpeg( "{$origImagePath}{$fname}" );
        $width = imagesx( $img );
        $height = imagesy( $img );

    // 3. calculate thumbnail size
        $new_width = $thumbWidth;
        $new_height = floor( $height * ( $thumbWidth / $width ) );

    // 4. create a new temporary image
        $tmp_img = imagecreatetruecolor( $new_width, $new_height );

     // 5. copy and resize old image into new image 
        //imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
	 imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

    // 6. save large image into a file
        imagejpeg( $tmp_img, "{$largeImagePath}{$fname}" );
        
    // 7. close the directory
        closedir( $origdir );       
}
    
?>