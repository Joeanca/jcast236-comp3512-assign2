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
    public function getByIncompleteName($string){
        $string = "%".$string."%";
        return $this->getWithWildCards("select FirstName,EmployeeID,LastName,Address,City,Region,Country,Postal,Email from Employees", array("FirstName", "LastName"), array($string, $string));
    }
}
?>