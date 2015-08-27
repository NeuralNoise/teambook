<?php ob_start(); ?>
<?php require_once("../includes/session.php"); ?>
<?php require_once("../Connections/tbconnection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teambook Photos Homepage</title>
<link href="../mainstyles.css" rel="stylesheet" type="text/css" />
<script src="../Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>

<body>

<div id="wrapper">
<div id="header">
<div id="headerleft">
  <h1><a href="../index.php"><img src="../assets/images/teambook_header_title.gif" width="500" height="80" alt="Teambook Header Title" /></a></h1>
<!-- end #headerleft --></div>
<div id="#headerright">
  <a href="../logout.php">Logout</a>
<!-- end #headerright --></div>
<br class="clearfloat" />
<!-- end #header --></div>
  <div id="userheader"><img src="../assets/images/profpic/<?php echo $_SESSION['userPic']; ?>" alt="kamal profile pic" />
  <h1><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></h1>
    <!-- end#userheader --></div>
 <br class="clearfloat" />
    <div id="globalnav">
       <ul>
      <li><a href="../index.php">Home - Feed</a></li>
      <li><a href="../myprofile/index.php">My Profile</a></li>
      <li><a href="../events/index.php">Events</a></li>
      <li><a href="../top5/index.php">Top 5s</a></li>
      <li><a href="index.php">Photos</a></li>
      <li><a href="../videos/index.php">Videos</a></li>
      <li><a href="../music/index.php">Music</a></li>
    </ul>
  <!-- end #globalnav --></div>
  <div id="mainContent">
<h1>Photos    </h1>
<div class="frame">
  <a href="dennycottagestag/index.php"><img src="../assets/images/photos/dennystag/dennystag1_tn.jpg" width="191" height="127" alt="Denny Cottage Stag Do Kam Sausage" /></a>
  <p><a href="dennycottagestag/index.php">Denny Cottage Stag Do Album - February 2013</a></p>
<!-- end#frame --></div>
<div class="frame"><a href="picture2.html"><a href="picture2.html"><img src="../Assets/images/gallery2thumb_orig.jpg" width="191" height="127" alt="Natural stone landscaping in home garden with stairs" /></a>
  <!-- end#frame -->
</div>
    <br class="clearfloat"  />
<!-- end #mainContent -->
  </div>
    <br class="clearfloat" />
<?php include("../includes/footer.php"); ?>
<?php ob_flush(); ?>