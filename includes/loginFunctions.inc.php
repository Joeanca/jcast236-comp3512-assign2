<?php
    require_once('includes/config.php'); 
    function validateUser($userName, $password){
        $userDB = new LoginGateway();
        
        //should check if username exists first maybe?
        
        $userInfo = $userDB->validate($userName, $password);
        
        
        
        if(isset($userInfo)){
            echo $userInfo;
        }
        else{
            echo "Broken";
        }

        }
        
    
    
    ?>