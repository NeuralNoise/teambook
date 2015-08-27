<?php ob_start(); ?>
<?php require_once("Connections/tbconnection.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php

    if (logged_in()) {
        redirect_to("index.php");
    }

    include_once("includes/form_functions.php");
    
    // START FORM PROCESSING
    if (isset($_POST['submit'])) { //Form has been submitted.
        $errors = array();
        
        // perform validations on the form data
        $required_fields = array('username', 'password');
        $errors = array_merge($errors, check_required_fields($required_fields, $_POST));
        
        $fields_with_lengths = array('username' => 30, 'password' => 30);
        $errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));
        
        $username = trim(mysql_prep($_POST['username']));
        $password = trim(mysql_prep($_POST['password']));
        $hashed_password = sha1($password);
        
        // SQL query
        if ( empty($errors) ) {
            // Check database to see if username and the hashed password exist there.
            $query = "SELECT userId, username, firstname, lastname, userPic ";
            $query .= "FROM users ";
            $query .= "WHERE username = '{$username}' ";
            $query .= "AND hashed_password = '{$hashed_password}' ";
            $query .= "LIMIT 1";
            $result_set = mysql_query($query);
            confirm_query($result_set);
            if (mysql_num_rows($result_set) == 1) {
                // username/password authenticated
                // and only 1 match
                $found_user = mysql_fetch_array($result_set);
                $_SESSION['user_id'] = $found_user['userId'];
                $_SESSION['username'] = $found_user['username'];
				$_SESSION['firstname'] = $found_user['firstname'];
				$_SESSION['lastname'] = $found_user['lastname'];
				$_SESSION['userPic'] = $found_user['userPic'];
				//$_SESSION['userPic_tn'] = $found_user['userPicTn'];
                redirect_to("index.php");
            } else {
                // username/password combo was not found in the database
                $message = "Username/password combination incorrect.<br />
                    Please make sure your caps lock key is off and try again.";
            }
        } else {
            if (count($errors) == 1) {
                $message = "There was 1 error in the form.";
            } else {
                $message = "There were " . count($errors) . " errors in the form.";
            }
        }
        
        } else { // Form has not been submitted
            if (isset($_GET['logout']) && $_GET['logout'] == 1) {
                $message = "You are now logged out.";
            }
            $username = "";    
            $password = "";
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset=utf-8" >
<title>Teambook Homepage</title>
<link href="mainstyles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<header>
<?php include("includes/header.php"); ?>
</header>
<div id="wrapper">
  <div id="mainContent">
<div id="loginbox">
      <h2>Login</h2>
      <?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
      <?php if (!empty($errors)) { display_errors($errors); } ?>
      <form id="loginform" name="form1" method="post" action="login.php">
        <label for="username">Username:</label>
        <input name="username" type="text" />
        <br />
        <br />
        <label for="password">Password:</label>
        <input name="password" type="password" />
        <br />
        <br />
        <input name="submit" type="submit" value="Login" />
        <br />
        <br />
      </form>
        <p>Not a user and want to join Team book? <a href="new_user.php">Click Here To Sign Up</a></p>
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
<?php ob_flush(); ?>
