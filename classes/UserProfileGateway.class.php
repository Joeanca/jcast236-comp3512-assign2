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
    
    //Selects information for user when filtered by a specific email
    public function getSpecificUser($userID){
        return $this->getWithKeyValue("select UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email from Users", UserID, $userID)[0];
    }
}
?>