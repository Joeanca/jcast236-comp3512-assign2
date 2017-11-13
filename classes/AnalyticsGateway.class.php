
<?php
class AnalyticsGateway extends AbstractTableGateway {    
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
    
    public function getCountry(){
        return $this->getSpecific("Select Distinct CountryName FROM Countries");
    }
    
    public function getVisits(){
        return $this->GetSpecific("Select VisitID, CountryName from BookVisits JOIN Countries on Countries.CountryCode = BookVisits.CountryCode");
    }
    public function getTopTenBooks(){
        return $this->getSpecific("SELECT ISBN10, ISBN13, Title,  `BookID` , COUNT( * ) AS  `adopted` FROM AdoptionBooks JOIN Books USING ( BookID ) GROUP BY  `BookID` ORDER BY adopted DESC LIMIT 10");
    }
    public function getTopFifteenUniversities(){
         return $this->getSpecific("SELECT  `CountryName` , COUNT( * )  AS  `adopted` FROM BookVisits JOIN Countries  USING (CountryCode) GROUP BY  `CountryCode` ORDER BY adopted DESC LIMIT 15");
    }
    public function getVisitsCount(){
        return $this->getSpecific("SELECT COUNT( * ) AS  `visits`, COUNT( DISTINCT  `CountryCode` ) AS  `uniqueCountries` FROM BookVisits WHERE  `DateViewed` >  '06/01/2017' AND  `DateViewed` <  '06/31/2017'")[0];
    }
    public function getMssgs(){
        return $this->getSpecific("SELECT COUNT( * ) AS  `messagescount` FROM EmployeeMessages WHERE  `MessageDate` >  '2017-06-01*' AND  `MessageDate` <  '2017-06-31*'")[0][messagescount];
    }
    public function getToDo(){
        return $this->getSpecific("SELECT COUNT( * ) AS  `todocount` FROM EmployeeToDo WHERE  `DateBy` >  '2017-06-01*' AND  `DateBy` <  '2017-06-31*'")[0][todocount];
    }
    
}


?>