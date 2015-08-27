<?php ob_start(); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("Connections/tbconnection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php 

	// Selecting the Relevant freinds for this User ID selected - not built yet
	// just show all current users now
		//$profileid = $_REQUEST['profileid'];
		
        $query = "SELECT userId, firstname, lastname, userPic
	      FROM users";
    
        $result_set = mysql_query($query, $tbconnection);
	
	
?>  
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teambook Home Page</title>
<link href="mainstyles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<header>
<?php include("includes/header.php"); ?>
</header>
<div id="wrapper">
  <div id="mainContent">
      <div id="sidebar">
<?php include("includes/sidebar.php"); ?>       
    <!-- end #sidebar --></div>
  <div id="mainContRight">
            <h2>My Friends</h2>
            <div id="friendsdisplay">
                <?php
                    while($friend_data = mysql_fetch_array($result_set)){
		    			$friendid = $friend_data['userId'];
						$friend_first_name = $friend_data['firstname'];
                    	$friend_last_name = $friend_data['lastname'];
                    	$friend_status_pic = get_web_path($friend_data['userPic']);
                    	$friend_fullname = $friend_first_name . " " . $friend_last_name;
						
                    	$output = "<div class=\"friendbox\">
					<div class=\"statusprofpic\">
					<img class=\"statusimg\" src=\"{$friend_status_pic}\" width=\"50\" />
					</div>
					<div class=\"statustext\">
					<a href=\"profile.php?profileid=$friendid\"><p class=\"bold\">{$friend_fullname}</p></a>
					</div>
					</div>";
                    echo $output; 
                }                    
                ?>
                 <br class="clearfloat" />
            <!-- end #friendsdisplay --></div>   
 <br class="clearfloat" />
    <!-- end #mainContLeft --></div>
<!-- end #mainContent --></div>
    <br class="clearfloat" />
<?php include("includes/footer.php"); ?>
<?php ob_flush(); ?>