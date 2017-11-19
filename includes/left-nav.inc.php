<?php
include "includes/importStatements.inc.php";
include "includes/loginFunctions.inc.php";
$loginInfo = new LoginGateway();

$userInfo = $loginInfo->getLeftNav($_SESSION['UserID']);

?>


  <div class="mdl-layout__drawer mdl-color--blue-grey-800 mdl-color-text--blue-grey-50">
       <div class="profile">
           <img src="images/smiling-owl.jpg" class="avatar" id="profile">
           <h4><?php echo $userInfo[0]['FirstName'] . ' ' . $userInfo[0]['LastName'];?> </h4>           
           <span><?php echo $userInfo[0]['Email'];?></span>
       </div>

    <nav class="mdl-navigation mdl-color-text--blue-grey-300">
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="./index.php"><i class="material-icons" role="presentation">dashboard</i> Dashboard</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="./userProfile.php"><i class="material-icons" role="presentation">account_circle</i> User Profile</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="./browse-employees.php"><i class="material-icons" role="presentation">group</i> Employees</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="./browse-books.php"><i class="material-icons" role="presentation">book</i> Books</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="./browse-universities.php"><i class="material-icons" role="presentation">account_balance</i> Universities</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="./analytics.php"><i class="material-icons" role="presentation">assessment</i> Analytics</a>
        <a class="mdl-navigation__link mdl-color-text--blue-grey-300" href="./aboutus.php"><i class="material-icons" role="presentation">announcement</i> About</a>
    </nav>
  </div>
  