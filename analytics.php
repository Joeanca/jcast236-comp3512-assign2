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
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">
            <div class="mdl-grid">
              <!-- mdl-cell + mdl-card -->
                    <div class="mdl-cell mdl-cell--6-col card-lesson mdl-card  mdl-shadow--2dp">
                        <div class="mdl-card__title mdl-color--orange">
                          <h1 class="mdl-card__title-text">HI! thank you for visiting</h1>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <h3> Something cool might be coming here</h3>
                            <h4>Come back later please.</h4>
                        </div>
                    </div>
            </div>
        </section>
    </main>
</div>

</body>
</html>