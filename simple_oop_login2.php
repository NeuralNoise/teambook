<?php

// This runs the classes files - setting up objects
require_once("includes/initialize.php");


if($session->is_logged_in()){
    redirect_to("index_oop.php");
                                                    
}

// User autrhentication:
if(isset($_POST['submit'])){  // form has been submitted
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // check database to see if username/ password combo exists:
    $found_user = User::authenticate($username,$password);
    
    if($found_user){
        $session->login($found_user);
        log_action('Login',"{$found_user->username} logged in.");
        redirect_to("index_oop.php");
    } else {
        // username/ password combo was not foudn in the database
        $message = "Username/Password Combination was incorrect";
    }
    
    
    
} else {  // form has not been submitted
    $username = "";
    $password ="";
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
       <meta charset="utf-8">
        <title>Basic PHP</title>
        <link rel="stylesheet" type="text/css" href="main.css" >
    </head>
    <body>
        <div id="wrapper">
        <header>
            <h1>Simple PHP Teambook Login Form</h1>
        </header>
        <section>
            <h2><?php if(isset($message)){ echo $message;} ?></h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            
            <p>Username: <input type="text" name="username" /></p>
            <p>Password: <input type="password" name="password" /></p>
            <p><input type="submit" name="submit" /></p>
            </form>
        </section>
        <footer>
            <p>&copy; Kamal Latif</p>
        </footer>
        </div>
    </body>
</html>