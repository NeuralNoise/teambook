<?php ob_start(); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php 

	// Selecting the Relevant profile Details for Profile ID selected
	$user_id = $_SESSION['user_id'];
	$profileid = !empty($_GET['profileid']) ? (int)$_GET['profileid'] : $user_id;
		
        $query = "SELECT userId, firstname, lastname, userPic
	      FROM users
	      WHERE userId ={$profileid}";
    
        $result_set = mysqli_query($connection, $query);
	
		while($profile_data = mysqli_fetch_assoc($result_set)){
		    		$profile_first_name = $profile_data['firstname'];
                    $profile_last_name = $profile_data['lastname'];
                    $profile_status_pic = get_web_path($profile_data['userPic']);
                    $profile_fullname = $profile_first_name . " " . $profile_last_name;
        }
	

    if (isset($_POST['submit'])) {
        
        $status = trim($_POST['status']); //add mysql_real_escape_string?
		$user_id = $_SESSION['user_id'];
		//$user_status_pic = $_SESSION['userPic'];
		$first_name = $_SESSION['firstname'];
		$last_name = $_SESSION['lastname'];
        
        $query = "INSERT INTO status (status, user_id) 
				  VALUES ('{$status}',{$user_id})";
        
  		$result_set = mysqli_query($connection, $query);
		
		$to = "razakam79@gmail.com, kamal_latif@hotmail.com" . ", ";
		$to .= "anthony@dhanendran.net, nathanrusson@yahoo.co.uk" . ", ";
		//$to .= "jamesofwalsh@gmail.com, pablohoney_uk@yahoo.co.uk, mattbriant@yahoo.co.uk, 		topcav@gmail.com";
		$subject = "Teambook Status Update by " . $first_name . " " . $last_name;
		$mailmessage = $first_name . " " . $last_name . " said: " . $status;
		$headers = "From: kam@teambook.co.uk";
    	//mail($to, $subject, $mailmessage, $headers);
        
    }
    
    $query = "SELECT status_id, status, user_id, firstname, lastname, userPic
	      FROM status, users
	      WHERE status.user_id = {$profileid} 
		  AND users.userId = status.user_id
	      ORDER BY status_id DESC";
    
    $result_set = mysqli_query($connection, $query);
	// $query2 = "SELECT user_pic_path FROM users";

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
  			<h2><?php echo $profile_fullname; ?></h2>
            <ul>
            <li>Age: 35</li>
            <li>Location: New Malden</li>
            <li>Profession: Trainee PHP Developer</li>
            </ul>
        <!-- end#profileinfo --></div> 
  <!-- end #profileheader --></div>
	<div id="profilenav">
    	<div id="profilenavbox"><p><a href="friends.php?profileid=<?php echo $profileid; ?>"><?php echo $profile_first_name; ?>'s Friends</a></p></div>
        <div id="profilenavbox"><p><a href="photos.php?profileid=<?php echo $profileid; ?>"><?php echo $profile_first_name; ?>'s Photos</a></p></div>
        <div id="profilenavbox"><p><a href="videos.php?profileid=<?php echo $profileid; ?>"><?php echo $profile_first_name; ?>'s Videos</a></p></div>
        <div id="profilenavbox"><p><a href="music.php?profileid=<?php echo $profileid; ?>"><?php echo $profile_first_name; ?>'s Music</a></p></div>
        <div id="profilenavbox"><p><a href="top5.php?profileid=<?php echo $profileid; ?>"><?php echo $profile_first_name; ?>'s Top 5's</a></p></div>
        <div id="profilenavbox"><p><a href="events.php?profileid=<?php echo $profileid; ?>"><?php echo $profile_first_name; ?>'s Events</a></p></div>
    </div>
             <div id="statusinput">
                <form id="userinputform" action="myprofile/index.php" method="post">
                    <fieldset>
                        <label for="status">Status:</label>
                        <input type="text" name="status" size="80" /><br />
                    </fieldset>
                    <fieldset>
                        <input type="submit" name="submit" value="Update Status" />
                    </fieldset>
                </form>
            </div>
            <h2>Status News Feed</h2>
            <div id="usersdisplay">
                <?php
                    while ($user_data = mysqli_fetch_assoc($result_set)) {
                    $status = $user_data['status'];
					$profileid = $user_data['user_id'];
					$first_name = $user_data['firstname'];
					$last_name = $user_data['lastname'];
					$user_status_pic = get_web_path_tn($user_data['userPic']);
					$fullname = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                    $output = "<div class=\"statuscont\">
					<div class=\"statusprofpic\">
					<a href=\"profile.php?profileid=$profileid\"><img class=\"statusimg\" src=\"{$user_status_pic}\" width=\"50\" /></a>
					</div>
					<div class=\"statustext\">
					<p class=\"bold\">" . $first_name . " " . $last_name . "</p>
					<p>" . $status . "</p></div>
					<br class=\"clearfloat\" />
					<div class=\"commentbox\">
					<label>" . $fullname . "</label>
					<textarea class=\"commenttextarea\" name\"comment\" value\"Write a comment here ... \"/>
					Write a comment ....</textarea>
					</div>
					</div>";
                    echo $output; 
                }                    
                ?>
                 <br class="clearfloat" />
            </div>   
 <br class="clearfloat" />
    <!-- end #mainContLeft --></div>
<!-- end #mainContent --></div>
    <br class="clearfloat" />
<?php include("includes/footer.php"); ?>
<?php ob_flush(); ?>