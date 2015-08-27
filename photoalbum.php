<?php ob_start(); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("Connections/tbconnection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php 

	// Selecting the Relevant profile Details for Profile ID selected
		$profileid = $_REQUEST['profileid'];
		$albumid = $_REQUEST['albumid'];
		
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
				
		$query = "SELECT user_id, albumId, albumname 
					FROM photoalbum 
					WHERE user_id = {$profileid}
					AND albumId={$albumid}";
					
		$result_set = mysql_query($query, $tbconnection);
		
		while($album_data = mysql_fetch_array($result_set)){
		    		$album_name = $album_data['albumname'];
        }	
		
		$query = "SELECT photoId, user_id, album_id, photoFname 
					FROM photos 
					WHERE user_id = {$profileid}
					AND album_id={$albumid}";
					
		$result_set = mysql_query($query, $tbconnection);
		
?>  
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teambook Home Page</title>
<link href="mainstyles.css" rel="stylesheet" type="text/css" />
<link href="Scripts/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css"/>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<script src="Scripts/_js/jquery-1.7.2.min.js"></script>
<script src="Scripts/_js/jquery.easing.1.3.js"></script>
<script src="Scripts/fancybox/jquery.fancybox-1.3.4.min.js"></script>
<script>
$(document).ready(function() {
	$('#gallery a').fancybox({
		overlayColor : '#060',
		overlayOpacity : .3,
		transitionIn: 'elastic',
		transitionOut: 'elastic',
		easingIn: 'easeInSine',
		easingOut: 'easeOutSine',
		titlePosition: 'outside',
		cyclic: true
	});
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
  			<h2><?php echo $profile_fullname; ?>'s Photos</h2>
            <h3>Album: <?php echo $album_name; ?></h3>
        <!-- end#profileinfo --></div> 
  <!-- end #profileheader --></div>
	<div id="gallery">
    <?php
		while($photo_data = mysql_fetch_array($result_set)) {
		$photofilename = $photo_data['photoFname'];
    	$output = "<a href=\"assets/images/uploads/albums/albumid{$albumid}/originals/{$photofilename}\" rel=\"gallery\" title=\"Denny Stag\">
		<img src=\"assets/images/uploads/albums/albumid{$albumid}/tn/{$photofilename}\" ></a>";
		echo $output;
		
		}
	?>	  
     <br class="clearfloat" />
    <!-- end#gallery--></div>
	    <div><a href="addphoto.php?profileid=<?php echo $profileid ?>&albumid=<?php echo $albumid ?>">Add Photo</a></div>
    
 <br class="clearfloat" />
    <!-- end #mainContLeft --></div>
<!-- end #mainContent --></div>
    <br class="clearfloat" />
<?php include("includes/footer.php"); ?>
<?php ob_flush(); ?>