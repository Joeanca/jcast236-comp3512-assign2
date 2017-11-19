<?php
class UserProfileGateway extends AbstractTableGateway {
    
    public function __construct(){
        parent::__construct();
    }

    protected function getSelectStatement(){
        return "select UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email from Users";
    }
    
    protected function getOrderFields(){
        return "FirstName";
    }
    
    protected function getKeyName(){
        return "UserID";
    }
    
    //Select information for all users
    public function getUsers(){
        return $this->getSpecific("select FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email from Users");
    }
    
    //Selects information for user when filtered by a specific email
    public function getSpecificUser($email){
        return $this->getWithKeyValue("select FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email from Users", State, $email);
    }
}
?>