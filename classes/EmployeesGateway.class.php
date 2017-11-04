<?php
class EmployeesGateway extends AbstractTableGateway {    
    public function __construct()    {
        parent::__construct();   
        
    }       
    protected function getSelectStatement()   
    {    
        return "SELECT EmployeeID, FirstName, LastName, Address, City,                     
        Region, Country, Postal, Email FROM Employees ";   
        
    }    
    protected function getOrderFields()    {
        echo "inside employeegateway.getorderfields";
        return 'LastName, FirstName';   
        
    }      
    protected function getKeyName() {
        return "EmployeeID";    
        
    }   

    
}
?>