<?php
class EmployeesGateway extends AbstractTableGateway {    
    public function __construct()    {
        parent::__construct();   
    }       
    protected function getSelectStatement(){    
        return "SELECT EmployeeID, FirstName, LastName, Address, City,                     
        Region, Country, Postal, Email FROM Employees ORDER BY LastName, FirstName ASC";   
    }    
    protected function getOrderFields(){
        return 'LastName, FirstName';   
    }      
    protected function getKeyName() {
        return "EmployeeID";    
    } 
    public function getByIncompleteName($string){
        $string = "%".$string."%";
        return $this->getWithWildCards("select FirstName,EmployeeID,LastName,Address,City,Region,Country,Postal,Email from Employees", array("FirstName", "LastName"), array($string, $string));
    }
    public function getByLastName($string){
        $string = $string."%";
        return $this->getWithWildCards("select FirstName,EmployeeID,LastName,Address,City,Region,Country,Postal,Email from Employees", array("LastName"), array($string));
    }
    public function getEmployeeByID($id){
        return $this->getWithKeyValue("select FirstName,EmployeeID,LastName,Address,City,Region,Country, Postal, Email from Employees ","EmployeeID", $id);
    }
    public function getEverything(){
        return $this->getSpecific("SELECT EmployeeID, FirstName, LastName, Address, City,                     
        Region, Country, Postal, Email FROM Employees ORDER BY LastName, FirstName ASC");
    }
    public function getToDo($id){
        return $this ->getWithKeyValue("select * from EmployeeToDo", "EmployeeID", $id);
    }
    public function getMessages($id){
        return $this->getWithKeyValue("select * from EmployeeMessages", "EmployeeID", $id);
    }
    public function getContacts(){
        return $this->getSpecific("select ContactID, FirstName, LastName from Contacts");
    }
    public function getCities(){
        return $this->getSpecific("Select Distinct City From Employees ORDER BY City ASC");
    }
    public function citySearch($id){
        return $this->getWithKeyValue("Select FirstName, LastName, EmployeeID FROM Employees", "city", $id);
    }
    public function cityAndLastNameSearch($city,$lastName){
        return $this->getSpecific("Select FirstName, LastName, EmployeeID FROM Employees WHERE City = '" . $city . "' AND LastName LIKE '" . $lastName . "%'");
    }
}
?>