<?php
include('includes/config.php');



    abstract class AbstractTableGateway {
      // contains connection
   
   /*
      Constructor is passed a database adapter (example of dependency injection)
   */
   public function __construct(){}
        // To set the select statement
        protected abstract function getSelectStatement();

        // pull the unique identifier for this object
        protected abstract function getKeyName();
        
        // 
        protected function createAdapter(){
            $dbType = "PDO";
            $connectionvalues = array(DBCONNSTRING,DBUSER,DBPASS);
            $adapter = AdapterFactory::createAdapter($dbType, $connectionValues);
            return $adapter;
        }

       //To pull information using a query from db
        public function getAll(){
            $adapter = $this->createAdapter();
            $results = $adapter->query($this->getSelectStatement());
            return $results;
            $adapter = null;
        }
        protected function getSpecific($sql){
            $adapter = $this->createAdapter();
            $statement=$adapter->prepare($sql);
            $statement->execute();
            $toReturn = array();
			while	($row	=	$statement->fetch())	{
					array_push($toReturn,$row);		      
             }
            return $toReturn;
            $adapter = null;
        }
        // 
        public function getByKey($value){
            $adapter = $this->createAdapter();
            $sql = $this -> getSelectStatement()."where".$this->getKeyName()."=?";
            return $adapter -> query($sql, $value);
        }
        protected function getWithKeyValue($sql,$key,$value){
            $adapter = $this->createAdapter();
            $sql = $sql." where ".$key." =:1 ";
            $statement=$adapter->prepare($sql);
            $statement->bindParam(":1",$value);
            $statement->execute();
            $toReturn = array();
			while	($row	=	$statement->fetch())	{
					array_push($toReturn,$row);		      
             }
            return $toReturn;
            $adapter = null;
        }
   }
?>