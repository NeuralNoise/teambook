<?php

// OOP database class - db connection &
// mysqli_query, mysqli_fetch_assoc:
require_once("includes/database.php");

// OOP Session class - sets $_SESSION['userId']:                                                  
require_once("includes/session_class.php");

// OOP User class - instantiates a $user object,
// updatign attributes with user specific details - runs sql queries in db class
require_once("includes/user4.php");

require_once("includes/functions.php");

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