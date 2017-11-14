<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <?php include "includes/importStatements.inc.php";
        include_once('includes/loginFunctions.inc.php');
        ?>
    </head>
    <body>
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawe mdl-layout--fixed-header">
            <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <h1 class="mdl-layout-title"><span>CRM</span> Admin</h1>
            </header>
 
            <style>
                .card-me{
                    padding-left:25px;
                    padding-right:25px;
                    padding-bottom:25px;
                }
            </style>
            
            <?php
                if(isset($_POST['username']) && isset($_POST['password']))
                {
                    
                    //If submit has data, send username and password over to validateUser in loginFunctions.inc.php
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    validateUser($userID,$password);
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