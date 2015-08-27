<?php

// Define the core FILESYSTEM paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a php pre-defined constant
// (\ for windows, / for UNIX)
defined('DS') ? null: define('DS',DIRECTORY_SEPARATOR);
defined('SITE_ROOT2') ? null: define('SITE_ROOT2', 'C:\wamp\www\teambook_v3');

// Library Path - to all Include Files
defined('LIB_PATH') ? null: define('LIB_PATH',SITE_ROOT2.DS.'includes');



require_once(LIB_PATH.DS."config.php");
require_once(LIB_PATH.DS."functions.php");

// OOP Session class - sets $_SESSION['userId']:                                                  
require_once(LIB_PATH.DS."session_class.php");

// OOP database class - db connection &
// mysqli_query, mysqli_fetch_assoc:
require_once(LIB_PATH.DS."database.php");
require_once(LIB_PATH.DS."database_object.php");

// OOP User class - instantiates a $user object,
// updatign attributes with user specific details - runs sql queries in db class
require_once(LIB_PATH.DS."user5.php");










?>