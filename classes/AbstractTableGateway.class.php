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
        
        protected function createAdapter(){

            $dbType = "PDO";
            $connectionvalues = array(DBCONNSTRING,DBUSER,DBPASS);
            $adapter = AdapterFactory::createAdapter($dbType, $connectionValues);
            return $adapter;
            $adapter = null;

        }

       //To pull information using a query set in the getAll method of your gateway from db
        public function getAll(){
            $adapter = $this->createAdapter();
            $results = $adapter->query($this->getSelectStatement());
            return $results;
            $adapter = null;
        }
        
        //  use to query a paramatered sql statemnt from your gateway without binding or query injection for values
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
        // if you want to add a where statement with a default key set on your gateway implementation 
        public function getByKey($value){
            $adapter = $this->createAdapter();
            $sql = $this -> getSelectStatement()."where".$this->getKeyName()."=?";
            return $adapter -> query($sql, $value);
            $adapter = null;

        }
        
        // Use this function from your gateway to pass in the sql, a key which is a column on a table, and the value you want to find in that column. 
        //This will return an array of row objects which fields can be called as employee[column_name]
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
        
        protected function getWithWildCards($sql,$keyArray,$valueArray){
            $adapter = $this->createAdapter();
            for ($i = 0; $i < count($keyArray); $i++){
                if ($i == 0){
                    $sql = $sql." where ".$keyArray[$i]." LIKE :$i ";
                }else {
                    $sql.=" OR ".$keyArray[$i]." LIKE :$i ";
                }
            }
            $statement=$adapter->prepare($sql);
            for ($i=0; $i<count($valueArray); $i++){
                $statement->bindParam(":$i",$valueArray[$i]);
            }
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