<!--Your Admin Dashboard will need to display the following information: 
•A table displaying the top 15 country names and their count. Each BookVisits record contains the CountryCode of the visitor. You will need to do a group query by CountryCode and count them and sort them by this count. <<<<iNFOGRAPHIC WITH A X FOR COUNTRY Y FOR VISITS
•A list displaying the following information: a count of the total number of visits in June, the total number of unique countries the site had visitors from, the total number of employee to-dos in June 2017, and the total number of employee messages in June 2017. These should be formatted as a series of four horizontal boxes; with each containing a relevant icon, the number, and a label describing the number. These should be calculated from the database and not hard-coded.
•A table of the top ten adopted books. This table should contain thumbnail image of book cover, title, and a sum of the Quantity in AdoptionBooks. The title should be a link to the Single Book page with the ISBN as a querystring.I will expect this to be designed in a sensible and attractive way that is consistent with the design of the rest of the site.-->
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
            <div class="mdl-grid containerBackground">
              <!-- mdl-cell + mdl-card -->
                    <div class="mdl-grid mdl-cell mdl-cell--3-col mdl-color--teal-300" >
                        <div class="mdl-cell--12-col mdl-cell--top mdl-color-text--grey-50" style="height:auto;">Visits</div>
                            <div class="mdl-cell--12-col">
                                <div class="mdl-grid mdl-grid--no-spacing">
                                    <div class="mdl-cell--4-col  mdl-cell--middle" style="text-align:center;">
                                        <i class="mdl-icon-toggle__label material-icons mdl-color-text--grey-50" style="font-size: 2.5em;">person pin</i>
                                    </div>
                                    <div class="mdl-cell--8-col mdl-cell--middle">
                                    <div class="mdl-grid mdl-grid--no-spacing">
                                        <div class="mdl-cell--middle mdl-cell--12-col mdl-cell--middle mdl-color-text--grey-50" style="text-align:right;">
                                            <h3><span class="count mdl-color-text--grey-50">1000</span></h3>
                                        </div>
                                        <div class="mdl-cell--middle mdl-cell--12-col mdl-cell--middle mdl-color-text--grey-50" style="text-align:right;">
                                            20% up
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                                       <div class="mdl-grid mdl-cell mdl-cell--3-col mdl-color--grey-500" >
                        <div class="mdl-cell--12-col mdl-cell--top mdl-color-text--grey-50" style="height:auto;">Visits</div>
                            <div class="mdl-cell--12-col">
                                <div class="mdl-grid mdl-grid--no-spacing">
                                    <div class="mdl-cell--4-col  mdl-cell--middle" style="text-align:center;">
                                        <i class="mdl-icon-toggle__label material-icons mdl-color-text--grey-50" style="font-size: 2.5em;">person pin</i>
                                    </div>
                                    <div class="mdl-cell--8-col mdl-cell--middle">
                                    <div class="mdl-grid mdl-grid--no-spacing">
                                        <div class="mdl-cell--middle mdl-cell--12-col mdl-cell--middle mdl-color-text--grey-50" style="text-align:right;">
                                            <h3><span class="count mdl-color-text--grey-50">1000</span></h3>
                                        </div>
                                        <div class="mdl-cell--middle mdl-cell--12-col mdl-cell--middle mdl-color-text--grey-50" style="text-align:right;">
                                            20% up
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="mdl-grid mdl-cell mdl-cell--3-col mdl-color--purple-300" >
                        <div class="mdl-cell--12-col mdl-cell--top mdl-color-text--grey-50" style="height:auto;">Visits</div>
                            <div class="mdl-cell--12-col">
                                <div class="mdl-grid mdl-grid--no-spacing">
                                    <div class="mdl-cell--4-col  mdl-cell--middle" style="text-align:center;">
                                        <i class="mdl-icon-toggle__label material-icons mdl-color-text--grey-50" style="font-size: 2.5em;">person pin</i>
                                    </div>
                                    <div class="mdl-cell--8-col mdl-cell--middle">
                                    <div class="mdl-grid mdl-grid--no-spacing">
                                        <div class="mdl-cell--middle mdl-cell--12-col mdl-cell--middle mdl-color-text--grey-50" style="text-align:right;">
                                            <h3><span class="count mdl-color-text--grey-50">1000</span></h3>
                                        </div>
                                        <div class="mdl-cell--middle mdl-cell--12-col mdl-cell--middle mdl-color-text--grey-50" style="text-align:right;">
                                            20% up
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="mdl-grid mdl-cell mdl-cell--3-col mdl-color--green-A200" >
                        <div class="mdl-cell--12-col mdl-cell--top mdl-color-text--grey-50" style="height:auto;">Visits</div>
                            <div class="mdl-cell--12-col">
                                <div class="mdl-grid mdl-grid--no-spacing">
                                    <div class="mdl-cell--4-col  mdl-cell--middle" style="text-align:center;">
                                        <i class="mdl-icon-toggle__label material-icons mdl-color-text--grey-50" style="font-size: 2.5em;">person pin</i>
                                    </div>
                                    <div class="mdl-cell--8-col mdl-cell--middle">
                                    <div class="mdl-grid mdl-grid--no-spacing">
                                        <div class="mdl-cell--middle mdl-cell--12-col mdl-cell--middle mdl-color-text--grey-50" style="text-align:right;">
                                            <h3><span class="count mdl-color-text--grey-50">1000</span></h3>
                                        </div>
                                        <div class="mdl-cell--middle mdl-cell--12-col mdl-cell--middle mdl-color-text--grey-50" style="text-align:right;">
                                            20% up
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
    </main>
</div>
<div></div>
<script>
    $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 1000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
</script>
</body>
</html>