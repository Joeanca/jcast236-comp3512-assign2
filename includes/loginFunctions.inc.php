<?php
    session_start();
    if( strcasecmp($_SERVER['REQUEST_METHOD'],"POST") === 0) {
         $_SESSION['postdata'] = $_POST;
        header("Location: ".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);
    exit;
    }
    if(isset($_SESSION['UserID'])){
        session_destroy();
    }if
    ( isset($_SESSION['postdata'])) {
        $_POST = $_SESSION['postdata'];
    unset($_SESSION['postdata']);
    }

      if(isset($_POST['username']) && isset($_POST['password'])) {
        $uName =$_POST['username'];
        $object = $loginInstance->getUserName($uName);
        $checkIfExists = $object[0];
        if ($checkIfExists[UserName] != ""){
            $userName = $_POST['username'];
            $password = $_POST['password'];
            $tempUser = $loginInstance->getLoginDetails($userName)[0];
            $salt = $tempUser['Salt'];
            // $object2 = $loginInstance->getPassword($userName);
            $passwordCheck = $tempUser['Password'];
            $saltyPassword = md5($password.$salt);
            if ($saltyPassword == $passwordCheck){
                $email = $_POST['username'];
                // $firstName = $loginInstance->getFirstName($userName);
                // $lastName = $loginInstance->getLastName($userName);
                // $uID = $loginInstance->getUserID($uName);
                //setSession($uID);
                $firstName = $tempUser[FirstName];
                $lastName = $tempUser[LastName];
                $uID = $tempUser[UserID];
                $_SESSION['UserID'] = $uID['UserID'];
                $previousPage = $_SERVER['HTTP_REFERER'];
                header("Location:/index.php");
            }    else {
                //Echo incorrect password
                $_POST = array();
                echo "<script> alertify.alert('Oh no!', 'Seems your password is incorrect, please check your credentials and try again!');</script>";
            }
        } else {
            $_POST = array();
                //echo incorrect login
                echo "<script> alertify.alert('Oh no!', 'Seems your credentials are incorrect, please check your login details and try again!');; </script>";

        }
    } 
    ?>