<!--There must be a page named aboutus.php. It should have your name, the course name and number, date, and anything else you’d like to put here. Somewhere on this page, provide a list of all resources you are using that you did not create (e.g. MDL, images, etc). Try to make it look nice and make it fit with MDL (or MDC) styles. -->
<?php

require_once('includes/config.php'); 
include_once('includes/bookFunctions.inc.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>About us</title>
    <?php include "includes/importStatements.inc.php"; ?>
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    <main class="mdl-layout__content  mdl-color--grey-50 pull_up">
        <div class="mdl-grid">
            <div class="card mdl-grid mdl-cell--10-col ">
                <div class="mdl-card mdl-cell--6-col mdl-grid--no-spacing unified ">
                    <div class="mdl-cell mdl-cell--12-col  mdl-grid--no-spacing">
                           <img class ="profile" src="images/myAvatar.svg"  border="0"  alt="profile.jpg" style="padding:0px;">  


                     </div>   
                </div>
       
                <div class="mdl-card mdl-cell--6-col mdl-grid--no-spacing unified">
               
                    <div class="mdl-cell mdl-card mdl-cell--12-col mdl-grid--no-spacing double-row ">
                        <div class="mdl-card__title mdl-color--orange">
                              <h2 class="mdl-card__title-text">About this Assignment</h2>
                        </div>
                        <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                          <div class="mdl-tabs__tab-bar">
                              <a href="#info-panel" class="mdl-tabs__tab is-active">My info</a>
                              <a href="#resources-panel" class="mdl-tabs__tab">Resources Used</a>
                        </div>
                        <div class="mdl-tabs__panel is-active" id="info-panel">
                            <ul class="mdl-list">
                                
                                 <!--It should have your name, the course name and number, date, and anything else you’d like to put here.-->
                                 
                                <li class='mdl-list__item'><h4>Jorge Castano</h4></li>
                                <li class='mdl-list__item'>COMP 3512 WEB II.</li>
                                <li class='mdl-list__item'>October 9th 2018.</li>
                                <li class='mdl-list__item'><a href="http://jorgecastano.com">Jorgecastano.com</a></li>
                                
                            </ul>
                        </div>
                        <div class="mdl-tabs__panel" id="resources-panel">
                            <ul class="mdl-list">
                                <li class='mdl-list__item'>Images and some of the framework provided by Randy Connolly.</li>
                                <li class='mdl-list__item'>MDL framework by google.</li>
                                <li class='mdl-list__item'>Material blue grey orange theme unknown source.</li>
                                <li class='mdl-list__item'>JQuery library found at: <a href="https://jquery.com/"> &nbsphttps://jquery.com/</a></li>
                                <li class='mdl-list__item'>Icons by Google.</li>
                                <li class='mdl-list__item'>Stack Overflow for ideas and snippets.</li>

                            </ul>
                        </div>
                    </div>
                    <!--<div class="mdl-cell mdl-card mdl-cell--12-col mdl-grid--no-spacing double-row mdl-shadow--2dp">-->
                    <!--</div>-->
                </div>
            </div>
        </div>
    </main>
 
        
  
</div>

</body>
</html>