<?php

require_once("includes/database.php");   // database class/ object $db
require_once("includes/user3.php");      // User class

$user = User::find_by_id(1);  // Selects one User from DB and instantiates/ creates an object
                              // (usign a static method)  
                              // with that user's detaisl as object attributes!


echo "<h1>Display User Object Instance Attributes:</h1>";
echo "Username: ";
echo $user->username;  // Display an Object Instance Attribute/ property
echo "<br />";
echo "Fullname (from Instance Method): ";
echo $user->full_name();  // Call an object instance method

echo "<h1>Display Username Attribute from all user objects just instantiated:</h1>";
$users = User::find_all();
foreach($users as $user){
    echo "Username: " . $user->username . "<br />";
}


?>