<?php ob_start(); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teambook Home Page</title>
<link href="mainstyles.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="wrapper">
  <div id="head">
  <div id="header">
    <h1>Teambook</h1>
  <!-- end #header --></div>
  <!-- end #head --></div>
    <div id="globalnav">
       <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="events/index.php">Events</a></li>
      <li><a href="top5/index.php">Top 5s</a></li>
      <li><a href="food/index.php">Food</a></li>
      <li><a href="filmandtv/index.php">Film &amp; TV</a></li>
      <li><a href="music/index.php">Music</a></li>
      <li><a href="articles/index.php">Articles</a></li>
          <li><a href="Feed/index.html">Feed</a></li>
              <li><a href="myprofile/index.php">My Profile</a></li>
      <li><a href="links/index.php">Links</a></li>
    </ul>
  <!-- end #globalnav --></div>
  <div id="mainContent"><div id="mainContLeft">
      <div class="portmaincont">
  <div class="portmainconthdr">
    <h3>Hello: <?php echo $_SESSION['username']; ?></h3>
  <!-- end#portmainconthdr --></div>
<p></p>
 <!-- end#portmaincont --></div>
    <div class="portmaincont">
  <div class="portmainconthdr">
    <h3>Teambook News</h3>
  <!-- end#portmainconthdr --></div>
<p>This website is still a work in progress! Submit any ideas to webmaster <a href="mailto: kam@teambook.co.uk">Kam</a>.</p>
 <!-- end#portmaincont --></div>
 <br class="clearfloat" />
    <div class="portmaincont">
  <div class="portmainconthdr">
    <h3>Team Events</h3>
  <!-- end#portmainconthdr --></div>
  <ul>
    <li>Boys Night:
      <ul>
        <li><a href="http://www.doodle.com/" target="_blank">Doodle Date Links</a></li>
        <li><a href="events/boysnight.html">Ideas for Boys Night</a></li>
      </ul>
    </li>
  </ul>
<!-- end#portmaincont --></div>
<br class="clearfloat" />
<div class="portmaincont">
  <div class="portmainconthdr">
    <h3>Top 5s</h3>
  <!-- end#portmainconthdr --></div>
  <ul>
    <li><a href="top5/top5filmlist.php">In Film</a></li>
    <li><a href="top5/top5tvlist.php">In TV</a></li>
    <li>In Books</li>
    <li><a href="top5/index.php">More Top 5s</a></li>
  </ul>
<!-- end#portmaincont --></div>
<br class="clearfloat" />
<div class="portmaincont">
  <div class="portmainconthdr">
    <h3>Food</h3>
  <!-- end#portmainconthdr --></div>
  <ul>
    <li>Restaurants:
      <ul>
        <li><a href="http://www.bodeansbbq.com/" target="_blank">Bodeans</a></li>
        <li><a href="http://www.nandos.co.uk/" target="_blank">Nandos</a></li>
        <li><a href="http://www.tayyabs.co.uk/" target="_blank">Tayyabs</a></li>
      </ul>
    </li>
    <li><a href="http://www.razaweb.com/food/manvfood.html">Man vs Food Links</a></li>
    <li>BBQ</li>
    <li><a href="food/index.php">More Food Links</a></li>
  </ul>
<!-- end#portmaincont --></div>
<br class="clearfloat" />
    <!-- end #mainContLeft --></div>
    <div id="sidebar">
       <div class="quicklinkscont">
       <div class="quicklinkshdr">
      <h3>Quick links!</h3>
    <!-- end#quicklinkshdr --></div>
      <p><a href="https://www.dropbox.com/home/Team" target="_blank">Team Dropbox</a></p>
      <p>Denny Links</p>
      <ul>
        <li><a href="http://www.southbankcentre.co.uk/" target="_blank">You You Bum Bum Train</a></li>
        <li><a href="https://www.dropbox.com/s/f389cae3rwfqjhw/A%20Touch%20Of%20Cloth%20%5BFeature%20Length%5D%20%2828th%20August%202012%29%20%5BPDTV%28XviD%29%5D.avi" target="_blank">Touch of Cloth</a></li>
        </ul>
      <p>Kam Links</p>
     <ul>
                <li><a href="http://www.razaweb.com" target="_blank">Razaweb</a></li>
                <li><a href="http://www.bbc.co.uk/news/" target="_blank">BBC News</a></li>
        <li><a href="http://www.guardian.co.uk/" target="_blank">The Guardian</a></li>
        <li><a href="http://www.radiotimes.com/tv/tv-listings" target="_blank">Radio Times</a></li>
        <li><a href="http://www.theonion.com/" target="_blank">The Onion</a></li>
        <li><a href="http://marvel.com/">Marvel Comics</a></li>
        </ul>
<p>&nbsp;</p>
<p>Places</p>
      <ul>
        <li><a href="http://www.southbankcentre.co.uk/" target="_blank">Southbank Centre</a></li>
        <li><a href="http://www.royalacademy.org.uk/" target="_blank">Royal Academy of Arts</a></li>
        <li><a href="http://www.somersethouse.org.uk/" target="_blank">Somerset House</a></li>
        <li><a href="http://www.britishmuseum.org/" target="_blank">British Museum</a></li>
        <li><a href="http://www.bl.uk/" target="_blank">British Library</a></li>
        </ul>
      <p>In Media</p>
      <ul>
        <li><a href="http://www.bbc.co.uk/arts/" target="_blank">BBC Arts &amp; Culture</a></li>
        <li><a href="http://www.bbc.co.uk/6music/" target="_blank">BBC Radio 6</a></li>
        <li><a href="http://www.bbc.co.uk/radio4/" target="_blank">BBC Radio 4</a></li>
        <li><a href="http://www.bbc.co.uk/bbcfour">BBC 4</a></li>
        <li><a href="http://www.guardian.co.uk/culture" target="_blank">Guardian Culture</a></li>
        </ul>
      <p>General</p>
      <ul>
        <li>Arts Council</li>
        <li>Empire Movie Magazine</li>
      </ul>
    <!-- end#quicklinkscont --></div>
    <!-- end #sidebar --></div>
<!-- end #mainContent --></div>
    <br class="clearfloat" />
<?php include("includes/footer.php"); ?>
<?php ob_flush(); ?>
