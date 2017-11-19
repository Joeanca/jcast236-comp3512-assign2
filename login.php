
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
    include "includes/importStatements.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
            <?php include "includes/importStatements.inc.php"; 
            $loginInstance = new LoginGateway();
?>
        
    </head>
    <body>
            <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawe mdl-layout--fixed-header">
    <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
            <h1 class="mdl-layout-title"><span>CRM</span> Admin</h1>
    </header>

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
        <main class="mdl-layout__content">
            <div class="page-content">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--4-col"></div>
                    <div class="mdl-cell mdl-cell--4-col"></div>
                    <div class="mdl-cell mdl-cell--4-col"></div>
                </div>
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--4-col"></div>
                    <div class="mdl-cell mdl-cell--4-col">
                    
                <div class="demo-card-wide mdl-card mdl-shadow--8dp card-me">
                        <h4 align="center">Login</h4>
                <div align="center">
                    
                    <form action ="/login.php" method="post">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" name="username">
                            <label class="mdl-textfield__label" for="username">Username</label>
                        </div>
                        
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="password" name="password">
                            <label class="mdl-textfield__label" for="password">Password</label>
                        </div>
                        
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit">Login</button>
                        
                    </form>
                </div>
                
                </div>
                
                    </div>
            
            <div class="mdl-cell mdl-cell--4-col"></div>
            </div>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col"></div>
            <div class="mdl-cell mdl-cell--4-col"></div>
            <div class="mdl-cell mdl-cell--4-col"></div>
        </div>
        
        </div>
            
        </main>

        </div>
        
</body>
    
</html>