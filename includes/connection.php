<?php

require 'config.php';

//Database Connection and selection - mysqli
$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_DBNAME);
if(!$connection){
    die("Database failed to connect " . mysqli_connect_error());
}

?>