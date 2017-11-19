
<link rel="stylesheet" href="css/styles.css" />
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
                $uID = $tempUser[UserID];
                $_SESSION['UserID'] = $uID;
                if(isset($_SESSION['url'])) 
                    $url = $_SESSION['url'];
                else 
                    $url = "index.php"; 
                header("Location: $url");
                } else {
                //Echo incorrect password
                $_POST = array();
                echo "<script> alertify.alert('Oh no!', 'Seems your password is incorrect, please check your credentials and try again!');
                document.getElementByID('username').classList.add('error');
                </script>";
            }
        } else {
            $_POST = array();
                //echo incorrect login
                echo "<script> alertify.alert('Oh no!', 'Seems your credentials are incorrect, please check your login details and try again!');; </script>";

        }
    } 
 ?>