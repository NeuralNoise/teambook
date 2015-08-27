<?php

require_once("database.php");

class User {
    
    public function find_all(){
        global $db;
        $result_set = $db->query("SELECT * FROM users");
        return $result_set;
    }
    
    public function find_by_id($userId=0){
        global $db;
        $result_set = $db->query("SELECT * FROM users WHERE userId={$userId}");
        $found = $db->fetch_assoc($result_set);
        return $found;
    }
    
    public static function find_by_id_static($userId=0){
        global $db;
        $result_set = $db->query("SELECT * FROM users WHERE userId={$userId}");
        $found = $db->fetch_assoc($result_set);
        return $found;
    }
    
    public static function find_by_sql($sql=""){
        global $db;
        $result_set = $db->query($sql);
        return $result_set;
    }
    
    
}



?>