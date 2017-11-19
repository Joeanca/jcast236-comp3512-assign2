<!-- User profile. Information -->
<?php
session_start();
if(empty($_SESSION['UserID'])){
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
    header("Location:/login.php");
}

require_once('includes/config.php'); 
include_once('includes/bookFunctions.inc.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>About us</title>
    <?php include "includes/importStatements.inc.php"; 
          $userInstance = new UserProfileGateway();?>
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
    <!-- $uname returns user info if set. Otherwise it returns our group info -->
    <?php 
        if(isset($_SESSION['UserID'])) {
            $user= $userInstance->getSpecificUser($_SESSION['UserID']);
        }
        else {$user = ['FirstName'=>'Push', 'LastName'=>'It', 'Address'=>'Mount Royal University', 'City'=>'Calgary', 'Region'=>'Alberta', 'Country'=>'Canada', 'Postal'=>'T2W5J9', 'Phone'=>'403-381-2233', 'Email'=>'pushit@pushit.ca'];}
    ?>
    
    <main class="mdl-layout__content  mdl-color--grey-50 pull_up">
        <div class="mdl-grid">
            <div class="card mdl-grid mdl-cell--12-col ">
                
               <!-- Users profile photo cell [All winking owl for now] -->
                <div class="mdl-card mdl-cell--6-col mdl-grid--no-spacing unified ">
                    <div class="mdl-cell mdl-cell--12-col  mdl-grid--no-spacing double-row">
                     <div class="mdl-card__title mdl-color--orange">
                              <h2 class="mdl-card__title-text"><?php echo $user['FirstName'].' '.$user['LastName'] ?></h2>
                        </div>
                        <div class="mdl-tabs__panel is-active" id="university-panel">
                           <img class ="profile" src="images/smiling-owl.jpg"  border="0"  alt="profile.jpg" style="padding:15px;">
                        </div>   
                        </div>
                     </div>   
                <div class="mdl-card mdl-cell--6-col mdl-grid--no-spacing unified">
                    
               <!-- Displays user information -->
                    <div class="mdl-cell mdl-card mdl-cell--12-col mdl-grid--no-spacing double-row ">
                        <div class="mdl-card__title mdl-color--orange">
                              <h2 class="mdl-card__title-text">About <?php echo $user['FirstName'].' '.$user['LastName'] ?></h2>
                        </div>
                            <ul class="mdl-list">
                                
                                 <!--It should have your name, the course name and number, date, and anything else you’d like to put here.-->
                                
                                <li class='mdl-list__item'>Tel: <?php echo $user['Phone'] ?></li>
                                <li class='mdl-list__item'>Email: <?php echo $user['Email'] ?></li>
                                <li class='mdl-list__item'>Location: <?php echo $user['Address'].', '.$user['City'].', '.$user['Region'].', '.$user['Country'].', '.$user['Postal'] ?></li>
                            </ul>
                        </div>
                    </div>
                    <!--<div class="mdl-cell mdl-card mdl-cell--12-col mdl-grid--no-spacing double-row mdl-shadow--2dp">-->
            </div>
        </div> 
    </main>
 
        
  
</div>

</body>
</html>