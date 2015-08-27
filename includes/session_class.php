<?php

// Sessions are files saved on server that contain user data like user id
// You access and update Session file on server using the sesison cookie PHPSESSID saved on users browser/ PC
// Sessions use a Session cookie but save data on server file rather than cookie file directly
// Accessing user data on session file is faster than accessing that data from database
// Only store certain User data liek Id on session file as other data for user may change on database,
// and not change immediately on session


// This is a class to help work with sessions
// In our case, primarily to manage logging users in and out

// Keep in mind when working with sessions that it is generally
// inadvisable to store DB-related objects in sessions

// defining the Session class:
class Session {
    
    private $logged_in=false;
    public $user_id;
    
    function __construct(){
        session_start();
        $this->check_login();
    }
    
    public function is_logged_in(){
        return $this->logged_in;
    }
    
    public function login($user){
        // database should find user based on username/ password
        if($user){
            $this->user_id = $_SESSION['userId'] = $user->userId;
            $this->logged_in = TRUE;
        }
        
    }
    
    public function logout(){
        unset($_SESSION['userId']);
        unset($this->user_id);
        $this->logged_in = FALSE;
    }
    
    private function check_login(){
        if(isset($_SESSION['userId'])){
            $this->user_id = $_SESSION['userId'];
            $this->logged_in = TRUE;
        } else {
            unset($this->user_id);
            $this->logged_in = FALSE;
        }
    }        
}

$session = new Session();    // Instantiate an object of the Session class

?>