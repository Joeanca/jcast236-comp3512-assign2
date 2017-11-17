<!--Needs to be just SQL statements-->
<?php
class LoginGateway extends AbstractTableGateway {    
    public function __construct()    {
        parent::__construct();   
        
    }       
    //Gets all the information from the Users table in the db
    protected function getSelectStatement(){
        return "SELECT UserID, FirstName, LastName, Email FROM Users";
    }    
    protected function getOrderFields(){
        return "UserID";
    }      
    protected function getKeyName(){
        return "UserName";
    } 
    //Gets the Salt Value for a specific user
    public function getSalt($userName){
        return $this->getWithKeyValue("SELECT Salt FROM UsersLogin", "UserName", $userName);
    }
    //Gets the password for a specific user
    public function getPassword($userName){
        return $this->getWithKeyValue("SELECT Password FROM UsersLogin", "UserName", $userName);
    }
    public function getUserID($userName){
        return $this->getWithKeyValue("SELECT UserID FROM UsersLogin", "UserName", $userName);
    }
    public function getUserName($userName){
        return $this->getWithKeyValue("SELECT UserName FROM UsersLogin", "UserName", $userName);
    }
    public function getFirstName($userName){
        return $this->getWithKeyValue("SELECT FirstName FROM Users", "Email", $userName);
    }
    public function getLastName($userName){
        return $this->getWithKeyValue("SELECT LastName FROM Users", "Email", $userName);
    }
    public function getAll($userName){
        return $this->getWithKeyValue("SELECT UserID, UserName, Password, Salt FROM UsersLogin", "UserName", $userName);
    }

    }

    
    
?>