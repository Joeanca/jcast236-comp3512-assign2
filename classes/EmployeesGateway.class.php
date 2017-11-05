<?php
class EmployeesGateway extends AbstractTableGateway {    
    public function __construct()    {
        parent::__construct();   
        
    }       
    protected function getSelectStatement()   
    {    
        return "SELECT EmployeeID, FirstName, LastName, Address, City,                     
        Region, Country, Postal, Email FROM Employees ORDER BY LastName, FirstName ASC";   
        
    }    
    protected function getOrderFields()    {
        return 'LastName, FirstName';   
    }      
    protected function getKeyName() {
        return "EmployeeID";    
    }   
    
    public function getToDo($id){
        return $this ->GetWithKeyValue("select * from EmployeeToDo", "EmployeeID", $id);
    }
    public function getMessages($id){
        return $this->GetWithKeyValue("select * from EmployeeMessages", "EmployeeID", $id);
    }
    public function getContacts(){
        return $this->getSpecific("select ContactID, FirstName, LastName from Contacts");
    }

    
}
?>