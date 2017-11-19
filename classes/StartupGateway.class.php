<?php
class StartupGateway extends AbstractTableGateway {    
    public function __construct()    {
        parent::__construct();   
        
    }       
    protected function getSelectStatement(){
        return "SELECT EmployeeID, FirstName, LastName FROM Employees";
    }    
    protected function getOrderFields(){}      
    protected function getKeyName(){} 
    public function getEmployees(){
        return $this->getSpecific("SELECT EmployeeID as value, CONCAT(FirstName, ' ', LastName) As label, LastName as lastName FROM Employees");
    }
}
?>