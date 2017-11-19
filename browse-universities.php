<!--There must be a page named browse‐universities.php. Like the browse‐employees page it should display a list of university names sorted by title. Because there are over 600 it should only display the top/first 20.  The page should also contain a drop down list of US state names (sorted alphabetically) along with a button beside the filter list. Our book database doesn’t contain a table of US Sate names, so you will have to create and populate this yourself (see http://kimbriggs.com/computer/mysql‐create‐us‐state‐table‐script for the relevant MySQL script). I have also added one to the GitHub repo. You can manually add this yourself if it wasn’t available when you started your workspace. Once the user clicks on the filter, it should perform the filter; that is, re‐request the page and update the university list to display only those universities from the requested state (still only the first 20). Be sure to make the first item in the list an option to remove the filter (i.e., see the first 20 universities from all states). Each university name should be a link back to the browse‐universities.php page with the selected university id as a query string parameter. Like with the browse‐employees page, once a university link has been clicked, the page will display the details (name, address, city, state, zip, website, latitude, and longitude) about the university in a separate card on the same page. 
-->

<?php
session_start();
if(empty($_SESSION['UserID'])){
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
    header("Location:/login.php");
}
require_once('includes/config.php'); 
include_once('includes/universityFunctions.inc.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Universities</title>
    <?php 
        include "includes/importStatements.inc.php"; 
        $universityInstance = new UniversitiesGateway();
    ?>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    <main class="books mdl-layout__content mdl-color--grey-50">
        <div class="mdl-grid ">
            
            <div class="mdl-cell mdl-cell--4-col card-lesson mdl-card  mdl-shadow--2dp">
                
                <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp drop-down">
                <div class="mdl-card__title mdl-color--orange">
                    <h2 class="mdl-card__title-text">State List</h2>
                </div>
                <div style="padding:20px; height:100%;">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height getmdl-select__fullwidth" style="width:100%">
                        <?php
                        /* Display current selected state, oherwise display message */
                        $states= $universityInstance->getStatesSelect();
                        $listLabel;
                        $stateAbbr=$_GET[state];
                        if(isset($_GET[state])){ 
                            $object = getNeedle($states, $stateAbbr, StateAbbr);
                            $listLabel= $object[StateName];
                        }else {$listLabel="Choose a state";}
                        ?>
                        <input class="mdl-textfield__input" type="text" id="state" value="<?php echo $listLabel;?>" readonly tabIndex="-1" >
                        <label for="state">
                            <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                        </label>
                        <label for="state" class="mdl-textfield__label">State</label>
                        <ul for="state" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                            <?php  
                           /* programmatically loop though states and display each name as a link. */
                              foreach ($states as $state){
                                  ?>
                                  <a href="?state=<?php echo $state[StateAbbr];?>">
                                 <li class='mdl-menu__item' data-val="<?php echo $state[StateAbbr]; ?>"><?php
                                    echo $state[StateName];
                                  ?></li></a>
                              <?php 
                              }
                         ?>        
                        </ul>
                    </div> 
                </div>    
            </div>  <!-- / mdl-cell + mdl-card -->
                

                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">University list</h2>
                </div><?php if(isset($_GET[state])){ ?>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored " onclick='clearSelections(true, false, false)' style="height:auto;">Clear State: <?php echo $listLabel; ?>
                </button> <?php }  ?>
                    <div class="mdl-card__supporting-text">
                        <!-- Colored raised button -->
                                        
                            <ul class="demo-list-item mdl-list">
                                 <?php  
                                /* programmatically loop through universities and display each name as a link. */
                                if (isset($_GET['state'])){
                                    $stateQueryVar = filter_var($_GET['state'], FILTER_SANITIZE_STRING);
                                    $currentState = getNeedle($states, $stateQueryVar, 'StateAbbr');
                                    $universities = $universityInstance->getSpecificUniversities($currentState[StateName]);
                                } else {$universities= $universityInstance->getTopTwentyUniversities();} 
                                foreach ($universities as $university){
                                ?>
                                <li class='mdl-list__item'><?php 
                                    if (isset($_GET['state'])){
                                        $stateQueryVar = filter_var($_GET['state'], FILTER_SANITIZE_STRING);
                                        $linkParameters = "state=$stateQueryVar&uid=$university[UniversityID]";
                                    }else {
                                        $linkParameters = "uid=$university[UniversityID]";
                                    }
                                echo constructLink($linkParameters, $university[Name] ); ?></li>
                                <?php 
                                }
                                ?>       
                            </ul>
                        </div>

                     </div>  <!-- / mdl-cell + mdl-card -->
                     
            <div class="mdl-cell mdl-cell--8-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">University Information</h2>
                </div>
                        <div class="mdl-card__supporting-text">
                        <!-- Colored raised button -->
                                        
                        <ul class="demo-list-item mdl-list">
                              
                           <?php   
                             // Display requested university information.
                             
                             
                            if (!empty($_GET[uid])){
                                $university = $universityInstance->getUniversityByUID($_GET[uid])[0];
                                echo "<h3>$university[Name]</h3>
                                    <p>$university[Address]<br>
                                    $university[City], $university[State]
                                    $university[Zip]<br><a href='http://$university[Website]'>$university[Website]</a></p>" ;
                                // Set lat & long for requested university. 
                                $long= $university['Longitude'];
                                $lat= $university['Latitude'];
                                echo        "<div id='map'></div><script>";
                                //   JavaScript (Google Maps API's) to create map.
                                include     "includes/jscriptMapFunctions.inc.js";
                                echo        "setLatLong($lat, $long)";
                                echo        "</script>";

                                echo '<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCseky1QGSaTkBVmSpG7UaIsR46oV6JAOc&callback=initMap"></script>';
                                
                            }else{
                                echo "<h4>Select from the University list to display details</h4>";
                            }
                           ?>
                                
                    </ul>
                </div>
         </div>  <!-- / mdl-cell + mdl-card -->
         

            </div>
        </div>
    </main>
    
    
</div>

<script>
     function clearSelections(c, s, i) {
            var temp = "<?php clearState()?>";
            if (!temp == ''){
                window.location.href = temp;
            }
    }
</script>
</body>
</html>