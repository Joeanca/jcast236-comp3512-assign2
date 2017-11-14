<?php
class LoginGateway extends AbstractTableGateway {    
    public function __construct()    {
        parent::__construct();   
        
    }       
    protected function getSelectStatement(){
        return "SELECT UserID, UserName, Password, Salt, State, DateJoined, DateLastModified";
    }    
    protected function getOrderFields(){}      
    protected function getKeyName(){} 
    
    public function userNameCheck($username){
       
    }
    
    public function validate($userName, $password){
        
        //K so, first thing you want to do is get the salt from the username that logged in
        
        $temp = $this->getWithKeyValue("Select Salt FROM UsersLogin", "UserName", $userName);
         //I was having issues getting the salt array from the query into a variable but jorge says this shold fix it
        $salt = $temp[0]['Salt'];
       
        //this query will work if the correct salt is selected and that variable isn't empty.
        //instead of returning, should put in a variable. If variable isn't empty, return true, if empty, return false
        //Then in previous function you can do the if else. 
        
        return $this ->getSpecific("Select UserID FROM UserLogin WHERE UserName = '" . $userName . "' AND Password =MD5( '" . $password . $salt . "')");

        
        
    }
    
      
}
?>