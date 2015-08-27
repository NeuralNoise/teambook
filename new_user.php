<?php require_once("Connections/tbconnection.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
    include_once("includes/form_functions.php");
    
    // START FORM PROCESSING
    if (isset($_POST['submit'])) { //Form has been submitted.
        $errors = array();
        
        // perform validations on the form data
        $required_fields = array('username', 'password');
        $errors = array_merge($errors, check_required_fields($required_fields, $_POST));
        
        $fields_with_lengths = array('username' => 30, 'password' => 30);
        $errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));
        
        $firstname = trim(mysql_prep($_POST['firstname']));
		$lastname = trim(mysql_prep($_POST['lastname']));
		$username = trim(mysql_prep($_POST['username']));
		$email = trim(mysql_prep($_POST['email']));
        $password = trim(mysql_prep($_POST['password']));
        $hashed_password = sha1($password);
		
		//files upload - profiel pic upload
		$originals_dir = "assets/images/uploads/profpic/originals/";
		$large_dir = "assets/images/uploads/profpic/large/";
		$large_width = 100;
		$thumb_dir = "assets/images/uploads/profpic/tn/";
		$thumb_width = 50;
		$upload_dir = SITE_ROOT . $originals_dir;
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
        
        // SQL query
        if ( empty($errors) ) {
            $query = "INSERT INTO users (
                            username, hashed_password, firstname, lastname, email, userPic 
                        ) VALUES (
                            '{$username}', '{$hashed_password}', '{$firstname}', '{$lastname}', '{$email}', '{$upload_filename}')";
            $result = mysql_query($query, $tbconnection);
            if ($result) {
                $message = "The user was successfully created.";
				// Redirect the user to the page that displays user information
				// header("Location: profile.php?profileid=" . mysql_insert_id());
            } else {
                $message = "The user could not be created.";
                $message .= "<br />" . mysql_error();
            }
        } else {
            if (count($errors) == 1) {
                $message = "There was 1 error in the form.";
            } else {
                $message = "There were " . count($errors) . " errors in the form.";
            }
        }
        
        } else { // Form has not been submitted
            $firstname = "";
	    $lastname = "";
	    $username = "";
	    $email = "";
            $password = "";
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teambook New User Sign Up Page</title>
<link href="mainstyles.css" rel="stylesheet" type="text/css" />
<style>
#loginform label.error {
	font-size: 0.9em;
	color: #F00;
	font-weight: bold;
	margin-left: 10px;
}

#loginform input.error, #signup select.error {
	background: #FFA9B8;
	border: 1px solid red;
}
.focusfield {
    background-color: #ADD7ED;
    border: solid 2px blue;
}
.idlefield {
    background-color: #FFF;
}
</style>
<script src="Scripts/_js/jquery-1.7.2.min.js"></script>
<script src="Scripts/_js/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {
	$(':text,:password').focus(function(){
	    $(this).addClass('focusfield');
	}); // end focus
	$(':text, :password').blur(function(){
	    $(this).removeClass('focusfield');
	}); // end focus
	$(':text:first').focus();
	$('#loginform').validate({
		rules: {
		  firstname: {
		    required: true  
		  },
		  lastname: {
		    required: true
		  },
		  email: {
		    required: true,
		    email: true
		  },
		  username: {
		    required: true
		  },
		  password: {
		    required: true,
		    rangelength:[8,16]
		  },
		  confirm_password: {
		    equalTo: '#password'	
		  }
		}, // end rules
		messages: {
		  firstname: {
		    required: "Please supply your First Name."
		  },
		  lastname: {
		    required: "Please supply your Last Name."
		  },
		  email: {
		    required: "Please supply your e-mail address.",
		    email: "This is not a valid e-mail address."
		  },
		  username: {
		    required: "Please supply a Username."
		  },
		  password: {
		    required: 'Please type a password',
		    rangelength: 'Password must be between 8 and 16 charcters long.'
		  },
		  confirm_password: {
		    equalTo: 'The two passwords do not match.'	
		  }
		}, // end messages
		errorPlacement: function(error, element) {
			if(element.is(":radio") || element.is(":checkbox")) {
				error.appendTo(element.parent());
			} else {
				error.insertAfter(element);
			}
		} // end errorPlacement
	}); // end validate
}); // end ready
</script>
</head>
<body>
<header>
<?php include("includes/header.php"); ?>
</header>
<div id="wrapper">
  <div id="mainContent">
<div id="loginbox">
      <h2>Sign up to Join Teambook</h2>
      <?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
      <?php if (!empty($errors)) { display_errors($errors); } ?>
      <form id="loginform" name="form1" method="post" action="new_user.php" enctype="multipart/form-data">
        <label for="firstname">First Name:</label>
        <input name="firstname" id="firstname" type="text" maxlength="30" value= "<?php echo htmlentities($firstname); ?>" />
        <br />
        <br />
        <label for="lastname">Last Name:</label>
        <input name="lastname" id="lastname" type="text" maxlength="30" value= "<?php echo htmlentities($lastname); ?>" />
        <br />
        <br />
        <label for="email">email:</label>
        <input name="email" id="email" type="text" maxlength="50" />
	<br />
        <br />
        <label for="userPic">Profile Picture:</label>
        <input name="userPic" type="file" />
        <br />
        <br />
        <label for="username">Username:</label>
        <input name="username" id="username" type="text" maxlength="30" value= "<?php echo htmlentities($username); ?>" />
        <br />
        <br />
        <label for="password">Password:</label>
        <input name="password" id="password" type="password" maxlength="30" value= "<?php echo htmlentities($password); ?>" />
	<br />
        <br />
        <label for="password">Confirm Password:</label>
        <input name="confirm_password" id="confirm_password" type="password" maxlength="30" />
        <br />
        <br />
        <input name="submit" type="submit" value="Join Teambook" />
        <input name="Reset" type="reset" value="Reset Form" />
        <br />
        <br />
      </form>
    </div>
<p>&nbsp;</p>
<!-- end #mainContent --></div>
    <br class="clearfloat" />
  <div id="footer">
    <p>&copy; Kamal Raza Latif 2013</p>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>
