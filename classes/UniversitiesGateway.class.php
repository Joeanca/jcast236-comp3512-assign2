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
    
    //Selects list of states from DB
    public function getStatesSelect(){
        return $this->getSpecific("Select StateId, StateName, StateAbbr from States");
    }
    
    //Selects universities when filtered by a specifc state
    public function getSpecificUniversities($state){
        return $this->getWithKeyValue("Select Name, Address, City, Zip, Website, UniversityID from Universities", State, $state);
    }
    
    //Lists the top twenty universities (unfiltered)
    public function getTopTwentyUniversities(){
        return $this->getSpecific("select Name, Address, City, Zip, Website, UniversityID from Universities order by Name limit 20");
    }
    
    //Selects universities filter by UniversityID
    public function getUniversityByUID($uid){
        return $this->getWithKeyValue("Select Name, Address, City, Zip, Website, UniversityID, Longitude, Latitude from Universities ", UniversityID, $uid);
    }
}
?>