<?php
require_once("Connections/tbconnection.php");

	//$profileid = $_REQUEST['profileid'];
        $profileid = 1;
        $query = "SELECT userId, firstname, lastname, userPic
	      FROM users
	      WHERE userId ={$profileid}";
    
        $result_set = mysql_query($query, $tbconnection);
	
	while($profile_data = mysql_fetch_array($result_set)){
		    $first_name = $profile_data['firstname'];
                    $last_name = $profile_data['lastname'];
                    $user_status_pic = $profile_data['userPic'];
                    $fullname = $first_name . " " . $last_name;
                                        
                    echo "{$first_name}<br />";
                    echo "{$last_name}<br />";
                    echo "{$user_status_pic}<br />";
                    echo "{$fullname}<br />";
        }

?>

