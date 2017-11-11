<?php
class UniversitiesGateway extends AbstractTableGateway {
    
    public function __construct(){
        parent::__construct();
    }

    protected function getSelectStatement(){
        return "select Name, Address, City, Zip, Website, UniversityID from Universities";
    }
    
    protected function getOrderFields(){
        return "UniversityID";
    }
    
    protected function getKeyName(){
        return "Name";
    }
    
    public function getStatesSelect(){
        return $this->getSpecific("Select StateId, StateName, StateAbbr from States");
    }
    
    public function getSpecificUniversities($state){
        
        return $this->getWithKeyValue("Select Name, Address, City, Zip, Website, UniversityID from Universities ", State, $state);
    }
    
    public function getTopTwentyUniversities(){
        return $this->getSpecific("select Name, Address, City, Zip, Website, UniversityID from Universities order by Name limit 20");
    }
}
?>