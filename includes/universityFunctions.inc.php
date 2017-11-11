<?php

/* This function requests anything from the database and returns it as an array */
function getFromDB($sql,$state){
   try {
        
         $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = $sql;
			$statement	=	$pdo->prepare($sql);
			if ($state != ''){$statement->bindParam(':state', $state);}
			$statement->execute();
            $toReturn = array();
			while	($row	=	$statement->fetch())	{
					array_push($toReturn,$row);		      
             }
             return $toReturn;
             $pdo = null;
      
   }
   catch (PDOException $e) {
      die( $e->getMessage() );
   }
}

function constructLink($id, $label) {
	$link	=	'<a	href="?' .	$id	.	'">';
	$link	.=	$label;
	$link	.=	'</a>';
	return	$link;
}
function getNeedle($array, $needle, $id){
    foreach ($array as $straw){
        if ($straw[$id] == $needle){
            return $straw;
        }
    }
}
function clearState(){
    if(!isset($_GET['state'])){
      echo "";
   }else {
   $params = $_GET;  
   unset($_GET['state']);
   unset($params['state']);
   $query = http_build_query($params);
   
   $actual_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
   echo $actual_url.parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)."?$query";
      
   }
}

?>