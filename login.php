<?php
 session_start();
    // if( strcasecmp($_SERVER['REQUEST_METHOD'],"POST") === 0) {
    //      $_SESSION['postdata'] = $_POST;
    //     header("Location: ".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);
    // exit;
    // }
    if(isset($_SESSION['UserID'])){
        session_destroy();
    }if
    ( isset($_SESSION['postdata'])) {
        $_POST = $_SESSION['postdata'];
        unset($_SESSION['postdata']);
        $_SESSION = array();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/styles.css" />
      
<?php 
    include "includes/importStatements.inc.php"; 
    $loginInstance = new LoginGateway();
?>
        
    </head>
    <style type="text/css">
        .highlight {
    background-color: #FFE0B2;
}    
.error {
    background: #FFCDD2 url(/images/error.png) no-repeat 98% center !important;
    box-shadow: 0 0 5px #FF5252;
    /*border-color: #FF1744;    */
}
    </style>
    <body>
            <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawe mdl-layout--fixed-header">
    <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
            <h1 class="mdl-layout-title"><span>CRM</span> Admin</h1>
    </header>

<?php
    include "includes/loginFunctions.inc.php";
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
                    
                    <form id="mainForm" action ="/login.php" method="post">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input required hilightable" type="text" name="username">
                            <label class="mdl-textfield__label " for="username">Username</label>
                        </div>
                        
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input required hilightable" type="password" name="password">
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
<script>
    window.addEventListener('load', start);
function start(){
    var highlights = document.getElementsByClassName("hilightable");
    for (i=0; i<highlights.length; i++) {
        highlights[i].addEventListener("focus", function(){
            this.classList.toggle("hilightable");
        });
        highlights[i].addEventListener("blur", function(){
            if (this.value == '' && this.classList.contains("required")){
                this.classList.add("error");
            }else {
                this.classList.remove("error");
            }
            this.classList.toggle("hilightable");
        }); 
    }
    document.getElementById('mainForm').addEventListener("submit", function(e){
        e.preventDefault();
        var required = document.getElementsByClassName("required");
        var ready = false;
        for (i=0; i<required.length; i++) {
            if (required[i].value == ""){
               required[i].classList.add("error");
               required[i].addEventListener("input", function(){
                  this.classList.remove("error") ;
               });
               ready = false;
               break;
            } else {
                ready = true;
            }
        }    
        if (ready){
        $(this).unbind('submit').submit();}
    })

}
</script>

</body>
    
</html>