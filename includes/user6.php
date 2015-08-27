<?php

require_once("database.php");  // database class/ object $db

class User extends DatabaseObject {
    
    protected static $table_name = "users";
    public $userId;
    public $username;
    public $hashed_password;
    public $firstname;
    public $lastname;
    
    public function full_name(){
        if(isset($this->firstname)&& isset($this->lastname)){
            return $this->firstname . " " . $this->lastname;
        } else {
            return "";
        }
    }
    
    
    public static function authenticate($username="", $password=""){
        global $db;
        $username = $db->mysql_prep($username);
        $password = $db->mysql_prep($password);
        $hashed_password = sha1($password);
        
        $sql = "SELECT * FROM users ";
        $sql .= "WHERE username = '{$username}' ";
        $sql .= "AND hashed_password = '{$hashed_password}' ";
        $sql .= "LIMIT 1";
        
        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array): false;
    }
    
    
    // Common Database Methods
    
    public static function find_all(){
        return self::find_by_sql("SELECT * FROM " . self::$table_name);
    }
    
  
    public static function find_by_id($userId=0){
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE userId={$userId} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array):false;
    }
    
    public static function find_by_sql($sql=""){
        global $db;
        $result_set = $db->query($sql);
        $object_array = array();  // each record_set row will become an object living inside an
                                    // array element in the object_array
        while($row = $db->fetch_assoc($result_set)){
            // this creates an object for each user/ db row and
            // inserts this object into the $object_array in a new index element
            $object_array[] = self::instantiate($row); 
        }
        return $object_array;
    }
    
    private static function instantiate($record){
        // could check that $record exists and is an array
        // this is simple long form approach
        
        $object = new self;  // Instantiate an object instance of the User class
        
        // updating this specific user object with data for this user
        //$object->userId = $record['userId'];  
        //$object->username = $record['username'];
        //$object->hashed_password = $record['hashed_password'];
        //$object->firstname = $record['firstname'];
        //$object->lastname = $record['lastname'];
        
        // more dynamic short-form approach,
        // using loop - attribute name must be same as db fieldname:
        foreach($record as $attribute=>$value){
            if($object->has_attribute($attribute)){
                $object->$attribute = $value;
            }
        }
        
        return $object;
    }
    
    private function has_attribute($attribute){
        //get_object_vars() returns an associative array with all the attributes
        // (incl private ones!) as the keys and their current valeus as the value
        
        $object_vars = get_object_vars($this);  // grabs all the attributes of this object instance only
        // We don't care abotu the value, we just want to knwo if they key exists
        // Will return True or False
        
        return array_key_exists($attribute, $object_vars);
    }
    
    // C.R.U.D. Instance Methods - need to instantiate object instance to run these
    public function create(){
        global $db;
        $sql = "INSERT INTO users(";
        $sql .= "username, password, first_name, last_name";
        $sql .= ") VALUES ('";
        $sql .=  $db->mysql_prep($this->username). "', '";
        $sql .=  $db->mysql_prep($this->password). "', '";
        $sql .=  $db->mysql_prep($this->first_name). "', '";
        $sql .=  $db->mysql_prep($this->last_name). "')";
        
        if($db->query($sql)){
            $this->userId= $db->insert_id();
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function update(){
        
    }
    
    public function delete(){
        
    }
    
    
    
    
    
    
} // end of User class

?>