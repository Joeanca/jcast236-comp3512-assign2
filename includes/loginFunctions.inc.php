<?php
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
                $firstName = $tempUser[FirstName];
                $lastName = $tempUser[LastName];
                $_SESSION['UserID'] = $tempUser['UserID'];;
                $previousPage = $_SERVER['HTTP_REFERER'];
                header("Location:/index.php");
            } else {
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