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
        
        $temp = $this->getWithKeyValue("Select Salt FROM UsersLogin", "UserName", $userName);
        $salt = $temp['Salt'];
        return $this ->getSpecific("Select UserID FROM UserLogin WHERE UserName = '" . $userName . "' AND Password =MD5( '" . $password . $salt . "')");

        
        //Not sure if this is even close to working or is even safe but the Password=MD5 part is correct. If the user enters abcd1234 and you concat the salt you will get the right info
    }
    
      
}
?>