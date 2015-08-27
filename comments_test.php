<?php ob_start(); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("Connections/tbconnection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php 

	$fullname = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
	$query2 = "SELECT comment_id, comment, statusID, user_id, firstname, lastname
				FROM comments, status, users
				WHERE status.status_id = comments.statusID	
				AND users.userId = comments.userID
				ORDER BY comment_id DESC";
				
	$comment_set = mysql_query($query2, $tbconnection);			

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
    <p><?php echo $_SESSION['userPic']; ?></p>
  <!-- end#portmainconthdr --></div>
<p></p>
 <!-- end#portmaincont --></div>
            <h2>Comments</h2>
            <div id="usersdisplay">
                <?php
		    while ($comment_data = mysql_fetch_array($comment_set)){
			$comment = $comment_data['comment'];
			$comment_user = $comment_data['firstname'] . " " . $comment_data['lastname'];
			
			$comment_output = "<div class=\"commentbox\">
					<div class=\"commentuser\"><p>" . $comment_user . "</p></div>
					<div class=\"commenttext\"><p>" . $comment . "</p></div><br />
					</div>
					
					<div class=\"insertcommentdiv\">
					<label>" . $fullname . "</label>
					<textarea class=\"commenttextarea\" name=\"comment\" value=\"Write a comment here ... \">
					Write a comment ....</textarea>
					</div>";
					
			echo $comment_output;		
					
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
