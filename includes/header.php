<div id="headerwrapper2">
        <div id="headerleft">
          <h1><a href="index.php"><img src="assets/images/teambook_header_title.gif" width="500" height="80" alt=			"Teambook Header Title" /></a></h1>
        <!-- end #headerleft --></div>
        <div id="#headerright">
        <?php
        
        if(logged_in()){
			
        $headerpic = get_web_path_tn($_SESSION['userPic']);
		$profileid = $_SESSION['user_id'];
        $headerright = "<a href=\"profile.php?profileid={$profileid}\"><img class=\"hdprofpic\"";
        $headerright .= "src=\"{$headerpic}\""; 
        $headerright .=	" alt=\"kamal profile pic\" width=\"50\" /></a>";
        $headerright .= "<h3>{$_SESSION['firstname']}". " " ."{$_SESSION['lastname']}</h3>";
        $headerright .= "<a href=\"logout.php\">Logout</a>";
        
        echo $headerright;
        }
        
        ?>
        <!-- end #headerright --></div>
   <!-- end #headerwrapper2 --></div>