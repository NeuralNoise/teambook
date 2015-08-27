<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
// 1. Create Database connection

require 'app_config.php';

$tbconnection = mysql_pconnect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD) or trigger_error(mysql_error(),E_USER_ERROR); 

// 2. Select a database to use
$db_select = mysql_select_db(DATABASE_NAME, $tbconnection);
if(!$db_select) {
    die("Database selection failed: " . mysql_error());
}
?>