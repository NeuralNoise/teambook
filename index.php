<?php ob_start(); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php 
    
    // C.R.U.D - CREATE/INSERT a new Status Record for the logged in User into Status Table
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
    
    // C.R.U.D. - RETRIEVE/SELECT all Status Update Records for all Users to display on Index Page
    $query = "SELECT status_id, status, user_id, firstname, lastname, userPic
	      FROM status, users
	      WHERE users.userId = status.user_id
	      ORDER BY status_id DESC";
    
    $result_set = mysqli_query($connection, $query);
	// $query2 = "SELECT user_pic_path FROM users";
	
    $comment_user = "";
    $comment = "";
	
			

?>  
<!DOCTYPE html>
<head>
<meta charset=utf-8" >
<title>Teambook Home Page</title>
<link href="mainstyles.css" rel="stylesheet" type="text/css" />
<style>
.focusfield {
    background-color: #ADD7ED;
    border: solid 2px blue;
}
</style>
<script src="Scripts/_js/jquery-1.7.2.min.js"></script>
<script src="Scripts/_js/jquery.validate.min.js"></script>
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
        <div class="portmaincont">
  <div class="portmainconthdr">
    <h3>Hello: <?php echo $_SESSION['username']; ?></h3>
  <!-- end#portmainconthdr --></div>
<p></p>
 <!-- end#portmaincont --></div>
             <div id="statusinput">
                <form id="userinputform" action="index.php" method="post">
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
                    while ($user_data = mysql_fetch_array($result_set)) {
				$status_id = $user_data['status_id'];
				$status = $user_data['status'];
				$profileid = $user_data['user_id'];
				$first_name = $user_data['firstname'];
				$last_name = $user_data['lastname'];
				$user_status_pic = get_web_path_tn($user_data['userPic']);
				$fullname = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
				
			$status_output = "<div class=\"statuscont\">
				<div class=\"statusprofpic\">
					<a href=\"profile.php?profileid={$profileid}\"><img class=\"statusimg\" src=\"{$user_status_pic}\" width=\"50\" /></a>
				</div>
				<div class=\"statustext\">
				<a href=\"profile.php?profileid={$profileid}\">
				<p class=\"bold\">" . $first_name . " " . $last_name . "</p>
				</a>
				<p>" . $status . "</p></div>
				<br class=\"clearfloat\" /></div>";
				
			echo $status_output;
				    
				 
				// Insertign and extracting comments:
				// $comment = $_POST['comment'];
				// $query = INSERT INTO comments ({$comment}, statusID, userID) VALUES ("This post is so cool Kam", 30, 1);
	
			    $query2 = "SELECT *";
			    $query2 .= " FROM comments, users ";
			    $query2 .= "WHERE comments.statusID = {$status_id} ";	
			    $query2 .= "AND users.userId = comments.userID ";
			    $query2 .= "ORDER BY comment_id DESC";
				
	$comment_set = mysql_query($query2, $tbconnection);    
				    
			    if(isset($comment_set)){
				while ($comment_data = mysql_fetch_array($comment_set)){
					$comment = $comment_data['comment'];
					$comment_user = $comment_data['firstname'] . " " . $comment_data['lastname'];
				    
				    $comment_output = "<div class=\"commentbox\">
				    <div class=\"commentuser\"><p>" . $comment_user . "</p></div>
				    <div class=\"commenttext\"><p>" . $comment . "</p></div><br />
				    </div>";
				    
				    echo $comment_output;
				    
				    }
				}
 
		    		$insert_comment_output = "<div class=\"insertcommentdiv\">";
				$insert_comment_output .= "<form method=\"post\" action=\"index.php\">";
				$insert_comment_output .= "<label>" . $fullname . "</label>";
				$insert_comment_output .= "<textarea class=\"commenttextarea\" name=\"comment\" value=\"Write a comment here ... \">Write a comment ....</textarea>";
				$insert_comment_output .= "<input type=\"submit\" name=\"commentsubmit\" />";
				$insert_comment_output .= "</form>";
				$insert_comment_output .= "</div>";
				    
				echo $insert_comment_output;
				
				if(isset($_POST['commentsubmit'])){
				    $comment_user_id = $_SESSION['user_id'];;
				    $comment_status_id = $status_id;
				    $comment_text = $_POST['comment'];
				    
				    $comment_query = "INSERT INTO comments ";
				    $comment_query .= "(comment, statusID, userID) ";
				    $comment_query .= "VALUES ('{$comment_text}',{$comment_status_id}, {$comment_user_id})";
				    
				    $insert_comment = mysql_query($comment_query, $tbconnection);
				}
		   
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
