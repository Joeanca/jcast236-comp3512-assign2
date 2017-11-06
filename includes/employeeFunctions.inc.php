<?php

/* This function requests anything from the database and returns it as an array */
function getFromDB($sql, $sanitizeMe){
   try {
        
         $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = $sql;
	   //   $sql	=	'select	*	from	Employees where	EmployeeID=:id';
			$statement	=	$pdo->prepare($sql);
			if ($sanitizeMe!='')
			$statement->bindParam(':id', $sanitizeMe);
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

function constructGenreLink($id, $label) {
	$link	=	'<a	href="?id=' .	$id	.	'">';
	$link	.=	$label;
	$link	.=	'</a>';
	return	$link;
}

function constructLink($qs,$id, $label) {
	$link	=	'<a	href="?' . $qs . '=' .	$id	.	'">';
	$link	.=	$label;
	$link	.=	'</a>';
	return	$link;
}

function getNeedle($array, $needle, $id){
    foreach ($array as $straw){
        if ($straw[ContactID] == $needle){
            return $straw;
        }
    }
}

?>