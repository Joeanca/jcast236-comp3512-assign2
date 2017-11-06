<?php
    include "includes/config.php";
    
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $searchTerm=$_GET['term'];
    
    $select = "SELECT * from Employees WHERE LastName LIKE '%".$searchTerm."%'");
     $result = $pdo->query($sql);
    while ($row = $result->fetch()){
        $data[] = $row['LastName'];
    }
    
    echo json_decode($data);
?>