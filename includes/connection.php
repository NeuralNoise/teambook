<?php

require 'app_config.php';

//Database Connection and selection - mysqli
$connection = mysqli_connect(DATABASE_HOST,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
if(!$connection){
    die("Database failed to connect " . mysqli_connect_error());
}

?>