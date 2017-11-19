<!--Your Admin Dashboard will need to display the following information: 
•A table displaying the top 15 country names and their count. Each BookVisits record contains the CountryCode of the visitor. You will need to do a group query by CountryCode and count them and sort them by this count. <<<<iNFOGRAPHIC WITH A X FOR COUNTRY Y FOR VISITS
•A list displaying the following information: a count of the total number of visits in June, the total number of unique countries the site had visitors from, the total number of employee to-dos in June 2017, and the total number of employee messages in June 2017. These should be formatted as a series of four horizontal boxes; with each containing a relevant icon, the number, and a label describing the number. These should be calculated from the database and not hard-coded.
•A table of the top ten adopted books. This table should contain thumbnail image of book cover, title, and a sum of the Quantity in AdoptionBooks. The title should be a link to the Single Book page with the ISBN as a querystring.I will expect this to be designed in a sensible and attractive way that is consistent with the design of the rest of the site.-->
<?php
session_start();
if(empty($_SESSION['UserID'])){
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
    header("Location:/login.php");
}
require_once('includes/config.php'); 
include_once('includes/analytics.inc.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>About us</title>
    <?php include "includes/importStatements.inc.php"; 
    $analyticsInstance = new AnalyticsGateway;
    $getVisits = $analyticsInstance->getVisitsCount();
    
?>

</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    <main class="mdl-layout__content mdl-color--grey-50">
    <div class='mdl-cell mdl-cell--middle mdl-cell--12-col mdl-card__title mdl-color--orange'><h3 class="mdl-card__title-text">Analytics</h3></div>

        <section class="page-content">
            <div class="mdl-grid containerBackground">
              <!-- mdl-cell + mdl-card -->
              
                    <div class="mdl-grid mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-color--purple-300" >
                        <div class="mdl-cell--12-col mdl-cell--top mdl-color-text--grey-50" style="height:auto;">Total visits</div>
                            <div class="mdl-cell--12-col">
                                <div class="mdl-grid mdl-grid--no-spacing">
                                    <div class="mdl-cell--4-col  mdl-cell--middle" style="text-align:center;">
                                        <i class="mdl-icon-toggle__label material-icons mdl-color-text--grey-50" style="font-size: 2.5em;">beenhere</i>
                                    </div>
                                    <div class="mdl-cell--8-col mdl-cell--middle">
                                    <div class="mdl-grid mdl-grid--no-spacing">
                                        <div class="mdl-cell--middle mdl-cell--12-col mdl-cell--middle mdl-color-text--grey-50" style="text-align:right;">
                                            <h3><span class="count mdl-color-text--grey-50"><?php echo $getVisits[visits]; ?></span></h3>
                                        </div>
                                        <div class="mdl-cell--middle mdl-cell--12-col mdl-cell--middle mdl-color-text--grey-50" style="text-align:right;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mdl-grid mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-color--teal-300" >
                        <div class="mdl-cell--12-col mdl-cell--top mdl-color-text--grey-50" style="height:auto;">Visiting countries </div>
                            <div class="mdl-cell--12-col">
                                <div class="mdl-grid mdl-grid--no-spacing">
                                    <div class="mdl-cell--4-col  mdl-cell--middle" style="text-align:center;">
                                        <i class="mdl-icon-toggle__label material-icons mdl-color-text--grey-50" style="font-size: 2.5em;">flight takeoff</i>
                                    </div>
                                    <div class="mdl-cell--8-col mdl-cell--middle">
                                    <div class="mdl-grid mdl-grid--no-spacing">
                                        <div class="mdl-cell--middle mdl-cell--12-col mdl-cell--middle mdl-color-text--grey-50" style="text-align:right;">
                                            <h3><span class="count mdl-color-text--grey-50"><?php echo $getVisits[uniqueCountries]; ?></span></h3>
                                        </div>
                                        <div class="mdl-cell--middle mdl-cell--12-col mdl-cell--middle mdl-color-text--grey-50" style="text-align:right;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                                       <div class="mdl-grid mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-color--grey-500" >
                        <div class="mdl-cell--12-col mdl-cell--top mdl-color-text--grey-50" style="height:auto;">To-Dos </div>
                            <div class="mdl-cell--12-col">
                                <div class="mdl-grid mdl-grid--no-spacing">
                                    <div class="mdl-cell--4-col  mdl-cell--middle" style="text-align:center;">
                                        <i class="mdl-icon-toggle__label material-icons mdl-color-text--grey-50" style="font-size: 2.5em;">assignment</i>
                                    </div>
                                    <div class="mdl-cell--8-col mdl-cell--middle">
                                    <div class="mdl-grid mdl-grid--no-spacing">
                                        <div class="mdl-cell--middle mdl-cell--12-col mdl-cell--middle mdl-color-text--grey-50" style="text-align:right;">
                                            <h3><span class="count mdl-color-text--grey-50"><?php echo $analyticsInstance->getToDo();?></span></h3>
                                        </div>
                                        <div class="mdl-cell--middle mdl-cell--12-col mdl-cell--middle mdl-color-text--grey-50" style="text-align:right;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="mdl-grid mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-color--green-A700" >
                        <div class="mdl-cell--12-col mdl-cell--top mdl-color-text--grey-50" style="height:auto;">Employee messages sent </div>
                            <div class="mdl-cell--12-col">
                                <div class="mdl-grid mdl-grid--no-spacing">
                                    <div class="mdl-cell--4-col  mdl-cell--middle" style="text-align:center;">
                                        <i class="mdl-icon-toggle__label material-icons mdl-color-text--grey-50" style="font-size: 2.5em;">chat bubble outline</i>
                                    </div>
                                    <div class="mdl-cell--8-col mdl-cell--middle">
                                    <div class="mdl-grid mdl-grid--no-spacing">
                                        <div class="mdl-cell--middle mdl-cell--12-col mdl-cell--middle mdl-color-text--grey-50" style="text-align:right;">
                                            <h3><span class="count mdl-color-text--grey-50"><?php echo $analyticsInstance->getMssgs();?></span></h3>
                                        </div>
                                        <div class="mdl-cell--middle mdl-cell--12-col mdl-cell--middle mdl-color-text--grey-50" style="text-align:right;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                            <div class='mdl-cell mdl-cell--6-col mdl-card__title-text'></div>
                            <div class='mdl-cell mdl-cell--middle mdl-cell--6-col mdl-cell--hide-phone mdl-cell--hide-tablet mdl-color--teal-300 mdl-color-text--grey-50' style="text-align:center; min-height: 50px; font-size: 1.5em;"><div style="padding-top: 20px;">Top 10 Adopted Books</div></div>
                    <?php $countryArray=$analyticsInstance->getTopFifteenUniversities();
                    analyticsJS($countryArray);?>
                    <div class="mdl-cell mdl-cell--6-col mdl-cell--top book-container demo-card-square" style="text-align:center">
                        <div class='mdl-cell mdl-cell--12-col mdl-card__title-text'>Top 15 Visiting Countries</div>
                        <div id="regions_div" style="width: 100%; height: auto;"></div>
                    </div>
                            <div class='mdl-cell mdl-cell--middle mdl-cell--12-col mdl-cell--hide-desktop mdl-color--teal-300 mdl-color-text--grey-50' style="text-align:center; min-height: 50px; font-size: 1.5em;"><div style="padding-top: 20px;">Top 10 Adopted Books</div></div>

                    <!--<div class="mdl-cell mdl-cell--6-col mdl-cell--top ">-->
                    <!--<div class="mdl-grid mdl-grid--no-spacing">-->
                    <?php 
                     $bookList = $analyticsInstance->getTopTenBooks();
                    foreach ($bookList as $book){
                        ?>
                <!--The list should contain a thumbnail of the cover, the title, the year, subcategory name, and imprint name.-->
                    <!-- Wide card with share menu button -->
                 <div class='mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--12-col-phone'>
                  <div class='book-container grow demo-card-square mdl-shadow--2dp card '>
                <a href="./single-book.php?i10=<?php echo $book['ISBN10']?>">
                <div class="mdl-card__title img-container" style="padding:0px;">
                         <img class="dashboard-card" src="book-images/medium/<?php echo $book['ISBN10'] ?>.jpg" />
                </div>
                </a>
                        <div class='mdl-card__supporting-text'>
                         <h5 class='mdl-card__title-text'><?php echo $book['Title']?></h5>
                        <div class="mdl-cell--bottom"><h6>
                        <?php 
                            // ISBN10, ISBN13, Title,  `BookID` , COUNT( * ) AS  `adopted`
                            echo "Number of adoptions: $book[adopted]<br>";
                            ?>
                            </h6></div>
                            <div class='mdl-card__supporting-text hideMe mdl-card__actions mdl-card--border'>
                          <a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect'>
                            See book details
                          </a>
                        </div>
                        </div>
                        <div class='mdl-card__supporting-text button-book mdl-card__actions mdl-card--border'>
                          <a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' href="./single-book.php?i10=<?php echo $book['ISBN10']?>">
                            See book details
                          </a>
                        </div>
              </div>            
              </div>
                <?php 
                ;
                }      ?>  
            </div>
            

        </section>
    </main>
</div>

<div></div>

<?php
echo counter();
?>
</body>
</html>