<?php
    require_once('includes/config.php'); 
    function validateUser($userName, $password){
        $userDB = new LoginGateway();
        
        //should check if username exists first maybe? Quick DB query to see if username is in there
        
        //this should return a boolean if true or false
        $userInfo = $userDB->validate($userName, $password);
        
        
        //just to check if anything has been returned. Should use Header() to redirect if true
        if(isset($userInfo)){
            echo $userInfo;
        }
        else{
            echo "Broken";
        }

        }
        
    
    
    ?>