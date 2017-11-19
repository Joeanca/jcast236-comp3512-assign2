<!--There must be a page named browse-books.php. This page displays a list of multiple bookssorted by the title. The list should contain a thumbnail of the cover, the title, the year, subcategory name, and imprint name. Because there are hundreds of books, only show the top 20. Each of the thumbnails and titles must be links with the ISBN10 field as the query string to thesingle-book   .php page (see below). 

Initially, this page must display all the books in the books table. The user should be able to filter the list by specifying the subcategory or imprint in two lists of links, populated from the subcategory (sorted by name), and imprints (sorted by name) tables. Each list should be in its own card. As with the unfiltered list, only display the top 20 matches for the filter. The first item in each list should be All Imprints/Subcategories: if the user clicks on this link, it should perform the filter. Be sure to make the first item in the lists an option to remove the filter (i.e., see all the subcategories/imprints).
-->

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
    <title>Books</title>
    <?php include "includes/importStatements.inc.php"; 
    $bookInstance = new BooksGateway();
?>
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
    <main class="books mdl-layout__content mdl-color--grey-50">
        <div class="mdl-grid">
            <div class=" mdl-cell mdl-cell--3-col mdl-cell--12-col-phone">
                 <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                        <div class="mdl-card__title mdl-color--orange">
                          <h3 class="mdl-card__title-text">Imprints</h3>
                        </div>
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick='clearImp()'>
                                  Clear Imprint Choice
                        </button> 
                        <div class="mdl-card__supporting-text">
                            <ul class="demo-list-item mdl-list">
                                   <?php
                                    
                                        $publishers = $bookInstance->getImprints();
                                        foreach ($publishers as $publisher){
                                            echo " <li class='mdl-list__item'>";
                                            echo constructLink("imp",$publisher[ImprintID], $publisher[Imprint] );
                                            echo "</li>";
                                        }
                                        
                                 ?>       
                           </ul>
                        </div>
                 </div>  <!-- / mdl-cell + mdl-card -->
                 <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-phone  mdl-shadow--2dp">
                        <div class="mdl-card__title mdl-color--orange">
                          <h3 class="mdl-card__title-text">SubCategories</h3>
                        </div>
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored clear" onclick='clearSub()'>
                                  Clear Subcategory Choice
                                </button> 
                        <div class="mdl-card__supporting-text">
                            <ul class="demo-list-item mdl-list">
                                <?php  
                                   /* programmatically loop though employees and display each
                                      name as <li> element. */
                                     $subcategories = $bookInstance->getSubcategories();
                                     $subList=array();
                                    if (isset($_GET['cat'])){
                                        $c = filter_var($_GET[cat], FILTER_SANITIZE_STRING);
                                        foreach($subcategory as $sub){if ($sub[CategoryID]==$c)$subList[]=$sub;};
                                    } 
                                    else $subList=$subcategories;
                                    $indexSubCat = 0;
                                    foreach ($subcategories as $subcategory){
                                        if ($indexSubCat < 20){
                                            $indexSubCat++;
                                    ?>
                                    <li class='mdl-list__item'><?php 
                                        echo constructLink("scat", $subcategory[SubcategoryID], $subcategory[SubcategoryName] ); ?></li>
                                      <?php 
                                        }
                                    }
                                 ?>       
                            </ul>
                        </div>
                 </div>  <!-- / mdl-cell + mdl-card -->
                
             </div>
             <div class="book mdl-cell--9-col mdl-cell--6-col-tablet mdl-cell--12-col-phone content-grid">
                 <div class="mdl-grid">
             <?php 
   $c = "";
   $s = "";
   $i = "";
   if (isset($_GET[cat])){
      $c = filter_var($_GET[cat], FILTER_SANITIZE_STRING);
    }if (isset($_GET[scat])){
      $s = filter_var($_GET[scat], FILTER_SANITIZE_STRING);
   }if (isset($_GET[imp])){
      $i = filter_var($_GET[imp], FILTER_SANITIZE_STRING);
   }
                $bookList = getBySpecific($bookInstance->getBooks(), $c, $s, $i);
                //$bookList = getBooks($c,$s,$i);
                $indexBook = 0;
                foreach ($bookList as $book){
                    if ($indexBook < 20){
                        $indexBook++;
                ?>
                
                <!--The list should contain a thumbnail of the cover, the title, the year, subcategory name, and imprint name.-->
                    <!-- Wide card with share menu button -->
                 <div class='mdl-cell mdl-cell--3-col mdl-cell--12-col-phone'>
                  <div class='book-container grow demo-card-square mdl-shadow--2dp card '>
                <a href="./single-book.php?i10=<?php echo $book['ISBN10']?>">
                <div class="mdl-card__title img-container" style="padding:0px;">
                         <img class="dashboard-card" src="book-images/medium/<?php echo $book['ISBN10'] ?>.jpg" />
                </div>
                </a>
                        <div class='mdl-card__supporting-text'>
                         <h5 class='mdl-card__title-text'><?php echo $book['Title']?></h5>
                        <?php 
                            echo "$book[CopyrightYear]<br>";
                            echo "$book[SubcategoryName]<br>";
                            echo "$book[Imprint]<br>";
                            ?>
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
                ;}
                }
            ?>
            </div>
            </div>



      

            </div>
        </div>
    </main>
    
    
</div>
<script>

     function clearCat() {
        var temp = "<?php echo clearGet('cat'); ?>";
        document.location.href = temp;
     }
     function clearSub() {
        var temp = "<?php echo clearGet(scat); ?>";
        document.location.href = temp;
     }function clearImp() {
        var temp = "<?php echo clearGet(imp); ?>";
        document.location.href = temp;
     }
     </script>
     <script type="text/javascript" src="scripts/custom.javascript.js"></script>
</body>
</html>