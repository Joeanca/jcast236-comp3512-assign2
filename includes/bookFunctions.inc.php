<?php

/* This function requests anything from the database and returns it as an array */
function getFromDB($sql, $c){
   try {
        
         $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	   //   $sql	=	'select	*	from	Employees where	EmployeeID=:id';
			$statement	=	$pdo->prepare($sql);
			if ($c!=''){$statement = $pdo->bindValue(1,$c);}
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

function getBooks($c, $s, $i) {
    try {
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "select BookID, ISBN10, ISBN13, Title, CopyrightYear, SubcategoryID, ImprintID,  PageCountsEditorialEst, Description, CoverImage, Imprints.Imprint as Imprint, SubcategoryName from Books JOIN Imprints using (ImprintID) JOIN Subcategories using (SubcategoryID) ";
    if (!$s=='' && $i==''){
        $sql.= " Where SubcategoryID= :s ";
    }else if ($s == '' && !$i==''){
        $sql.= " Where ImprintID= :i ";
    }else if (!$s=='' && !$i==''){
        $sql.= ' Where SubcategoryID = :s AND ImprintID = :i ';

    } 
    $sql.= " order by Title limit 0, 20";

	$statement=$pdo->prepare($sql);

    if (!$s=='' && $i==''){
        $statement->bindParam(":s",$s);
    }else if ($s == '' && !$i==''){
        $statement->bindParam(":i",$i);
    }else if (!$s=='' && !$i==''){
        $statement->bindParam(':s',$s);
        $statement->bindParam(':i',$i);
    } 
		$statement->execute();
        $bookArray = array();
		while	($row	=	$statement->fetch())	{
			array_push($bookArray,$row);		      
        }
        return $bookArray;
        $pdo = null;
             
    }catch (PDOException $e) {
      die( $e->getMessage() );
   }
}

function getBySpecific($booklist, $c, $s, $i){
    $selected = array();
    if ($c=="" && $s=="" && $i==""){
        return $booklist;
    }
    else if ($s!="" && $i!=""){
        foreach ($booklist as $book){
            if ($book[SubcategoryID] == $s && $book[ImprintID]== $i){
                $selected[]=$book;
            }
        }
    }
    else if ($s!="" && $i==""){
        foreach ($booklist as $book){
            if ($book[SubcategoryID] == $s){
                $selected[]=$book;
            }
        }
    }
    else if ($s=="" && $i!=""){
        foreach ($booklist as $book){
            if ($book[ImprintID] == $i){
                $selected[]=$book;
            }
        }
    }
    return $selected;
}


// constructLink("cat", $subcategory[CategoryID], $subcategory[CategoryName] 
function constructLink($id, $value, $label) {
    if ($id == 'cat'){
        $params['cat']=$value;
    }else{
    
    
    $params = $_GET;
    if (isset($params[$id])){
        $params[$id] = $value; 
    } else {
        $params[$id] = $value;
    }
    }
    $query = http_build_query($params);
    
	$link	=	'<a	href="?' .	$query	.	'">';
	$link	.=	$label;
	$link	.=	'</a>';
	return	$link;
}
function getNeedle($haystack, $needle, $id){
    foreach ($haystack as $straw){
        if ($straw[$id] == $needle){
            return $straw;
        }
    }
}

function clearGet($toClear){
    $toReturn;
    if ($toClear != 'cat'){
    if (isset($_GET[$toClear])){
        $params= $_GET;
        unset($params[$toClear]);
    }else {
        $params = $_GET;
    }  
    $query = http_build_query($params);
   $actual_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
   $toReturn = $actual_url.parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)."?$query";
    } else {
        $params = array();
        $query = http_build_query($params);
   $actual_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
   $toReturn = $actual_url.parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)."?$query";
        
    }
    echo $toReturn;
}

?>