<?php
abstract class Session{
    
    //Start session
    public function startSession(){
        session_start();
    }
    
    //To be used ONLY ONCE USER VALIDATED
    public function setSession(){
        $_SESSION['user']=$_POST['username'];
    }   
    
    //Returns true if session matches credentials, false if not (false value should return user to the login page)
    public function checkSession(){
        if($_SESSION['user'] == $_POST['username']){
            return true;   
        }
        else{
            return false;
        }
    }
    
    //Close session
    public function closeSession(){
        session_destroy(); 
    }
}

?>