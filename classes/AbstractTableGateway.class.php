<?php
include('includes/config.php');



    abstract class AbstractTableGateway {
      // contains connection
   
   /*
      Constructor is passed a database adapter (example of dependency injection)
   */
   public function __construct() 
   {
      }
        // To set the select statement
        protected abstract function getSelectStatement();

        // pull the unique identifier for this object
        protected abstract function getKeyName();

       //To pull information using a query from db
        public function getAll(){
            echo "im inside get all";
            $dbType = "PDO";
            $connectionvalues = array(DBCONNSTRING,DBUSER,DBPASS);
            $adapter = AdapterFactory::createAdapter($dbType, $connectionValues);
            $results = $adapter->query($this->getSelectStatement());
            return $results;
        }
        
        // 
        public function getByKey($value){
            $adapter = AdapterFactory::createAdapter();
            $sql = $this -> getSelectStatement()."where".$this->getKeyName()."=?";
            return $adapter -> query($sql, $value);
        }
    }
?>