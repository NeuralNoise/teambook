<?php ob_start(); ?>
<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../Connections/tbconnection.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teambook Photos Homepage</title>
<link href="../../mainstyles.css" rel="stylesheet" type="text/css" />
<link href="../../Scripts/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css"/>
<script src="../../Scripts/swfobject_modified.js" type="text/javascript"></script>
<script src="../../Scripts/_js/jquery-1.7.2.min.js"></script>
<script src="../../Scripts/_js/jquery.easing.1.3.js"></script>
<script src="../../Scripts/fancybox/jquery.fancybox-1.3.4.min.js"></script>
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

<div id="wrapper">
<div id="header">
<div id="headerleft">
  <h1><a href="../index.php"><img src="../../assets/images/teambook_header_title.gif" width="500" height="80" alt="Teambook Header Title" /></a></h1>
<!-- end #headerleft --></div>
<div id="#headerright">
  <a href="../../logout.php">Logout</a>
<!-- end #headerright --></div>
<br class="clearfloat" />
<!-- end #header --></div>
  <div id="userheader"><img src="../../assets/images/profpic/<?php echo $_SESSION['userPic']; ?>" alt="kamal profile pic" />
  <h1><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></h1>
    <!-- end#userheader --></div>
 <br class="clearfloat" />
    <div id="globalnav">
       <ul>
      <li><a href="../../index.php">Home - Feed</a></li>
      <li><a href="../../myprofile/index.php">My Profile</a></li>
      <li><a href="../../events/index.php">Events</a></li>
      <li><a href="../../top5/index.php">Top 5s</a></li>
      <li><a href="../../photos/index.php">Photos</a></li>
      <li><a href="../../videos/index.php">Videos</a></li>
      <li><a href="../../music/index.php">Music</a></li>
    </ul>
  <!-- end #globalnav --></div>
  <div id="mainContent">
<h1>Denny Cottage Stag Do Photo Gallery</h1>
<div id="gallery">
  <a href="../../assets/images/photos/dennystag/dennystag1.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag1_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Do Kam Sausage" /></a>
  <a href="../../assets/images/photos/dennystag/dennystag2.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag2_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Sausages Cooking" /></a>
    <a href="../../assets/images/photos/dennystag/dennystag3.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag3_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Do Kam Sausage" /></a>
  <a href="../../assets/images/photos/dennystag/dennystag4.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag4_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Sausages Cooking" /></a>
    <a href="../../assets/images/photos/dennystag/dennystag5.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag5_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Do Kam Sausage" /></a>
  <a href="../../assets/images/photos/dennystag/dennystag6.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag6_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Sausages Cooking" /></a>
      <a href="../../assets/images/photos/dennystag/dennystag7.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag7_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Do Kam Sausage" /></a>
  <a href="../../assets/images/photos/dennystag/dennystag8.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag8_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Sausages Cooking" /></a>
      <a href="../../assets/images/photos/dennystag/dennystag9.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag9_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Do Kam Sausage" /></a><a href="../../assets/images/photos/dennystag/dennystag10.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag10_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Sausages Cooking" /></a><a href="../../assets/images/photos/dennystag/dennystag11.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag11_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Do Kam Sausage" /></a>
  <a href="../../assets/images/photos/dennystag/dennystag12.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag12_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Sausages Cooking" /></a>
      <a href="../../assets/images/photos/dennystag/dennystag13.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag13_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Do Kam Sausage" /></a>
  <a href="../../assets/images/photos/dennystag/dennystag14.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag14_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Sausages Cooking" /></a>
    <a href="../../assets/images/photos/dennystag/dennystag15.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag15_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Matt Onesie" /></a>
      <a href="../../assets/images/photos/dennystag/dennystag16.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag16_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Sausages Cooking" /></a>
        <a href="../../assets/images/photos/dennystag/dennystag17.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag17_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Sausages Cooking" /></a>
          <a href="../../assets/images/photos/dennystag/dennystag18.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag18_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Sausages Cooking" /></a>
            <a href="../../assets/images/photos/dennystag/dennystag19.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag19_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Sausages Cooking" /></a>
                        <a href="../../assets/images/photos/dennystag/dennystag20.jpg" rel="gallery" title="Denny Stag"><img src="../../assets/images/photos/dennystag/dennystag20_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Sausages Cooking" /></a>
  <br class="clearfloat" />
<!-- end#gallery--></div>
<!-- end #mainContent --></div>
    <br class="clearfloat" />
<?php include("../../includes/footer.php"); ?>
<?php ob_flush(); ?>