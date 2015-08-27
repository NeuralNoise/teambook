<?php require_once("Connections/tbconnection.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
    include_once("includes/form_functions.php");
    
	  //session_start();

	  if (isset($_SESSION['error_message'])) {
		$error_message = preg_replace("/\\\\/", '', $_SESSION['error_message']);
	  } else {
		$error_message = "something went wrong, and that's how you ended up here.";
	  }
	
	  if (isset($_SESSION['system_error_message'])) {
		$system_error_message = preg_replace("/\\\\/", '', $_SESSION['system_error_message']);
	  } else {
		$system_error_message = "No system-level error message was reported.";
	  }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teambook New User Sign Up Page</title>
<link href="mainstyles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<header>
<?php include("includes/header.php"); ?>
</header>
<div id="wrapper">
  <div id="mainContent">
<div id="loginbox">
      <h2>Upload Error Page</h2>
          <h1>We're really sorry...</h1>
            <p><img src="assets/images/error.jpg" class="error" />...but something's gone wrong. Apparently, <span class="error_message"><?php echo $error_message; ?></span></p>
            <p>If you want to go back to the page that caused the problem, you can do that <a href="javascript:history.go(-1);">by clicking here.</a> If the same problem occurs, though, you may want to Email the administrator <a href="mailto: kam@teambook.co.uk">kam@teambook.co.uk</a></p>
            <p>And again, we're really sorry for the inconvenience.</p>
            <?php
              debug_print("<hr />");
              debug_print("<p>The following system-level message was received: <b>{$system_error_message}</b></p>");
            ?>
    <!-- end #loginbox --></div>
<p>&nbsp;</p>
<!-- end #mainContent --></div>
    <br class="clearfloat" />
  <div id="footer">
    <p>&copy; Kamal Raza Latif 2013</p>
  <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>
