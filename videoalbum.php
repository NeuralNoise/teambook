<?php ob_start(); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("Connections/tbconnection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php 

	// Selecting the Relevant profile Details for Profile ID selected
		$profileid = $_REQUEST['profileid'];
		$valbumid = $_REQUEST['valbumid'];
		
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
				
		$query = "SELECT user_id, valbumId, valbumname 
					FROM videoalbum 
					WHERE user_id = {$profileid}
					AND valbumId={$valbumid}";
					
		$result_set = mysql_query($query, $tbconnection);
		
		while($valbum_data = mysql_fetch_array($result_set)){
		    		$valbum_name = $valbum_data['valbumname'];
        }	
		
		$query = "SELECT videoId, user_id, valbum_id, videoFname, videotitle 
					FROM videos 
					WHERE user_id = {$profileid}
					AND valbum_id={$valbumid}";
					
		$result_set = mysql_query($query, $tbconnection);
		
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
  			<h2><?php echo $profile_fullname; ?>'s Videos</h2>
            <h3>Video Album: <?php echo $valbum_name; ?></h3>
        <!-- end#profileinfo --></div> 
  <!-- end #profileheader --></div>
	<div id="videocontent">
    <?php
		while($video_data = mysql_fetch_array($result_set)) {
		//$videopath = "assets/videos/uploads/valbum{$valbumid}";	
		$videofilename = $video_data['videoFname'];
		$videotitle = $video_data['videotitle'];
    	$output = "<div class=\"videobox\"><p>{$videotitle}</p><video width=\"295\" height=\"164\" controls>
   <source src=\"assets/videos/uploads/valbum{$valbumid}/{$videofilename}\" type=\"video/mp4\">
    Your Browser does not support this file type
  </video></div>";
		echo $output;
		
		}
	?>	
  
    <div><a href="addvideo.php?profileid=<?php echo $profileid ?>&valbumid=<?php echo $valbumid ?>">Add Video</a></div>  
     <br class="clearfloat" />
        <!-- end #videocontent --></div>
 <br class="clearfloat" />
    <!-- end #mainContLeft --></div>
<!-- end #mainContent --></div>
    <br class="clearfloat" />
<?php include("includes/footer.php"); ?>
<?php ob_flush(); ?>