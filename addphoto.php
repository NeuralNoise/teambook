<?php ob_start(); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("Connections/tbconnection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/classes.php"); ?>
<?php confirm_logged_in(); ?>
<?php 

	// Selecting the Relevant profile Details for Profile ID selected
		//$profileid = $_GET['profileid'];
		//$albumid = $_GET['albumid'];
		
		$profileid = 1;
		$albumid = 1;
		
		
        $query = "SELECT userId, firstname, lastname, userPic
	      FROM users
	      WHERE userId ={$profileid}";
    
        $result_set = mysql_query($query, $tbconnection);
	
		while($profile_data = mysql_fetch_array($result_set)){
		    		$profile_first_name = $profile_data['firstname'];
                    $profile_last_name = $profile_data['lastname'];
                    $profile_status_pic = $profile_data['userPic'];
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
		
		if(isset($_POST['submit'])){
		//$_FILES[] upload script
		
		$image_fieldname = "file_upload";
		$tmp_file = $_FILES[$image_fieldname]['tmp_name'];
		$target_file = time() . "-" . basename($_FILES[$image_fieldname]['name']);
		$upload_dir = "assets/images/uploads/albums/albumid{$albumid}";
		
		$file_upload = new FileUpload($tmp_file,$target_file,$upload_dir,$image_fieldname);
		$message = $file_upload->move_file();
		
		$photofilename = $target_file;
		$photodesc = trim(mysql_real_escape_string($_POST['desc']));
		
	
		$query = "INSERT INTO photos (album_id, user_id, photoFname, description) VALUES ({$albumid},{$profileid},'{$photofilename}','{$photodesc}')";
					
		$result_set = mysql_query($query, $tbconnection);
		
		if($result_set){
			//redirect to relevant photoalbum.php file*/
			redirect_to("photoalbum.php?profileid={$profileid}&albumid={$albumid}");
		} else {
				$sql_error = "Did nto update database" . mysql_error();
				
		
		}
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

  <div id="mainContent">
  <div id="mainContRight">
	<div id="profileheader">
		<div id="profileimage">
        			<img class="hdprofpic" src="assets/images/profpic/<?php echo $profile_status_pic; ?>" alt="kamal profile pic" />
        <!-- end #profileimage --></div>
        <div id="profileinfo">
  			<h2><?php echo $profile_fullname; ?>'s Photos</h2>
            <h3>Album: <?php echo $album_name; ?></h3>
        <!-- end#profileinfo --></div> 
  <!-- end #profileheader --></div>
	<div id="profilenav">
    <p>Select a Photo from your computer and click on Submit to upload it to this Photo Album</p>
    <?php if(!empty($message)) { echo "<p>{$message}</p>"; } ?>
    <?php if(!empty($sql_error)) { echo "<p>{$sql_error}</p>"; } ?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
	<input  type="hidden" name="MAX_FILE_SIZE" value="2000000" />
    <p><label for="file">File:</label>
    <input type="file" name="file_upload">
    </p>
    <p><label for="desc">Photo Description</label>
    <input type="text" name="desc" />
    </p>
    <p><input type="submit" name="submit"  /></p>
    </form>
    </div>  
 <br class="clearfloat" />
    <!-- end #mainContLeft --></div>
<!-- end #mainContent --></div>
    <br class="clearfloat" />

<?php ob_flush(); ?>