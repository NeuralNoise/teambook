<?php

require_once("includes/database.php");
require_once("includes/user.php");

if(isset($db)){
    echo "true";
} else {
    echo "false";
}
echo "<br />";

echo "<h1>Using the Database Class Only</h1>";

echo $db->mysql_prep("It's Working<br />");

$sql = "SELECT * FROM users";
$result = $db->query($sql);

echo "Teambook Users in Database:<br />";
echo "<ul>";
while($user_data = mysqli_fetch_assoc($result)){
    $username = $user_data['username'];
    echo "<li>{$username}</li>";
}
echo "</ul>";

$sql2 = "SELECT * FROM users";
$result = $db->query($sql2);

echo "Teambook Users in Database:<br />";
echo "<ul>";
while($user_data2 = $db->fetch_assoc($result)){
    $username = $user_data2['username'];
    echo "<li>{$username}</li>";
}
echo "</ul>";

echo "<br />";
echo "<h1>Using the User Class</h1>";
echo "<h2>Using an instance method and object instance:</h2>";

$user = new User();
$found_user = $user->find_by_id(1);
echo $found_user['username'];

echo "<hr />";
echo "<h2>Using a static/class method - less code</h2>";

$found_user = User::find_by_id_static(1);
echo $found_user['username'];

echo "<hr />";
echo "<h2>Using a static/class method - find_by_sql method</h2>";

$sql3 = "SELECT * FROM users WHERE userId=2";
$result_set = User::find_by_sql($sql3);
$found_user = $db->fetch_assoc($result_set);
echo $found_user['username'];

?>