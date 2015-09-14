<?php ob_start(); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php 

	// Selecting the Relevant profile Details for Profile ID selected
		$profileid = $_REQUEST['profileid'];
				
        $query = "SELECT userId, firstname, lastname, userPic
	      FROM users
	      WHERE userId ={$profileid}";
    
        $result_set = mysql_query($query, $tbconnection);
	
		while($profile_data = mysql_fetch_array($result_set)){
		    		$profile_first_name = $profile_data['firstname'];
                    $profile_last_name = $profile_data['lastname'];
                    $profile_status_pic = get_web_path($profile_data['userPic']);
                    $profile_fullname = $profile_first_name . " " . $profile_last_name;
        }
?>  
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teambook Home Page</title>
<link href="mainstyles.css" rel="stylesheet" type="text/css" />
<style>
.focusfield {
    background-color: #ADD7ED;
    border: solid 2px blue;
}
</style>
<script src="myprofile/Scripts/_js/jquery-1.7.2.min.js"></script>
<script src="myprofile/Scripts/_js/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {
	$(':text').focus(function(){
	    $(this).addClass('focusfield');
	}); // end focus
	$(':text').blur(function(){
	    $(this).removeClass('focusfield');
	}); // end focus
	$(':text:first').focus();
}); // end ready	
</script>	
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
	<div id="profileheader">
		<div id="profileimage">
        			<a href="profile.php?profileid=<?php echo $profileid ?>"><img class="hdprofpic" src="<?php echo $profile_status_pic; ?>" alt="kamal profile pic" /></a>
        <!-- end #profileimage --></div>
        <div id="profileinfo">
  			<h2><?php echo $profile_fullname; ?>'s Top 5 Lists</h2>
        <!-- end#profileinfo --></div> 
  <!-- end #profileheader --></div>
	<div id="profilenav">
    	<div id="profilenavbox"><p><a href="photoalbum.php?profileid=<?php echo $profileid ?>&albumid=1">Top 5 US TV Drama's</a></p>
    	</div>
        <div id="profilenavbox"><p><a href="photoalbum.php?profileid=<?php echo $profileid ?>&albumid=2">Top 5?</a></p>
        </div>
        <div id="profilenavbox"><p><a href="photoalbum.php?profileid=<?php echo $profileid ?>&albumid=3">Top 5?</a></p>
        </div>
        <div id="profilenavbox"><p><a href="photoalbum.php?profileid=<?php echo $profileid ?>&albumid=1">Top 5?</a></p>
        </div>
    </div>  
 <br class="clearfloat" />
    <!-- end #mainContLeft --></div>
<!-- end #mainContent --></div>
    <br class="clearfloat" />
<?php include("includes/footer.php"); ?>
<?php ob_flush(); ?>