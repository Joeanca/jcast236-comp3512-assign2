<?php
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

// redirect header 
//Redirect('http://example.com/', false);
function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    exit();
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