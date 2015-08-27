<?php

require_once("includes/database.php");
require_once("includes/user2.php");

$record = User::find_by_id(1);  // Selects one User from DB and creates array with record data

$user = new User();  // Instantiate an object instance of the User class
$user->userId = $record['userId'];  // updating this specific user object with data for this user
$user->username = $record['username'];
$user->hashed_password = $record['hashed_password'];
$user->firstname = $record['firstname'];
$user->lastname = $record['lastname'];

echo "<h1>Display User Object Instance Attributes:</h1>";
echo "Username: ";
echo $user->username;
echo "<br />";
echo "Fullname (from Instance Method): ";
echo $user->full_name();


?>