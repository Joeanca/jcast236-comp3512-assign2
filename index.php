<!--There must be a page named index.php and must be the destination for the Dashboard link in your site. 
The text and links for the images on the home page can be hard-coded. 
This page will contain the following links formatting as MDL (Material Design Lite) Cards: BrowseUniversities, Browse Books, Browse Employees, and About with links to the appropriate pages. 
It might be nice to make the cards include an image-->
<?php
session_start();
if(empty($_SESSION['UserID'])){
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
    header("Location:/login.php");
}
$pages = array(array('name' => 'Dashboard','url' => 'index.php','pic' => 'index'), array('name' => 'Employees','url' => 'browse-employees.php','pic' => 'employee'   ),
    array('name' => 'Books','url' => 'browse-books.php','pic' => 'books'), array('name' => 'Universities','url' => 'browse-universities.php','pic' => 'universities'),   array(       'name' => 'Analytics','url' => 'analytics.php',      'pic' => 'universities'
),array('name' => 'About','url' => 'aboutus.php','pic' => 'aboutus'));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <?php include "includes/importStatements.inc.php"; ?>

</head>

<body>
    <div class=" mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
    <?php include 'includes/header.inc.php'; ?>
        <?php include 'includes/left-nav.inc.php'; ?>

<main class="index mdl-layout__content mdl-color--grey-50">
    <div class="mdl-grid cards">
	  <?php foreach($pages as $page){
	  ?>
      <!-- Wide card with share menu button -->
            <div class="mdl-cell mdl-card card mdl-cell--4-col"><a href="<?php echo $page[url]?>">
                    <div class="mdl-card__title img-container" style="padding:0px;">
                         <img class="dashboard-card" src="images/<?php echo $page[pic] ?>.png" />
                    </div>
                    <div class="mdl-card__supporting-text mdl-color--orange full-width">
                        <h2 class="mdl-card__title-text noTextDecor" style="color:white; text-decoration: none;"><?php echo $page[name]; ?></h2>
                    </div>
            </a></div>

          <?php
	            };
          ?>
</div>    <!-- / mdl-layout -->

</main>    
</body>
</html>

