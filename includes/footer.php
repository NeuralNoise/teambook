    <div id="footer">
    <ul>
      <li><a href="index.php">Home - News Feed</a> |</li>
      <li><a href="profile.php?profileid=<?php echo $_SESSION['user_id'] ?>">My Profile</a> |</li>
      <li><a href="friends.php?profileid=<?php echo $_SESSION['user_id'] ?>">My Friends</a> |</li>
      <li><a href="photos.php?profileid=<?php echo $_SESSION['user_id'] ?>">My Photos</a> |</li>
      <li><a href="videos.php?profileid=<?php echo $_SESSION['user_id'] ?>">My Videos</a> |</li>
      <li><a href="music.php?profileid=<?php echo $_SESSION['user_id'] ?>">My Music</a> |</li>
      <li><a href="events.php?profileid=<?php echo $_SESSION['user_id'] ?>">My Events</a> |</li>
      <li><a href="top5.php?profileid=<?php echo $_SESSION['user_id'] ?>">My Top 5s</a></li>
    </ul>
    <p><a href="mailto: kam@teambook.co.uk">E-mail: kam@teambook.co.uk</a></p>
    <p><a href="http://www.kamallatif.com">&copy; Kamal Raza Latif 2014</a></p>
    <!-- end #footer --></div>
    <!-- end #WRAPPER --></div>
</body>
</html>
<?php
    // 5. Close connection
    if (isset($tbconnection)){
        mysql_close($tbconnection);
    }
?> 