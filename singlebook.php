<!--10.There must be a page named single-book   .ph  p. It should display the details for a single book specified by the ISBN10 value passed in as a query string. This should include a larger version of the cover as well as the following information: ISBN10, ISBN13, Title, CopyrightYear, SubCategory, Imprint, Production Status, Binding Type, Trim Size, Page Count, and Description. Don’t display the foreign keys; display the relevant name. For instance, you wouldn’t want to display the SubcategoryID field value of 16; instead you would want to display its related name (“  Principles of Economics”) from the Subcategory table. This must be accomplished with a single query with multiple inner joins. All of this information should be contained within a single MDL Card element. This page must include two other cards. Each of these will require separate queries. One of these will contain a list of authors for the book, sorted by the Order field. The other card will display a list of universities that have adopted the book.-->

<?php
session_start();
if(empty($_SESSION['UserID'])){
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
    header("Location:/login.php");
}
require_once('includes/config.php'); 
include_once('includes/bookFunctions.inc.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book Info</title>
    <?php include "includes/importStatements.inc.php"; ?>
</head>

<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    i
    <?php 
    
    // ISBN10, ISBN13, Title, CopyrightYear, SubCategory, Imprint, Production Status, Binding Type, Trim Size, Page Count, and Description
    
    //One of these will contain a list of authors for the book, sorted by the Order field. The other card will display a list of universities that have adopted the book
    if (isset($_GET[i10])){$i10 = $_GET[i10];}
    $object = getFromDB("SELECT BookID, ISBN10, ISBN13, Title, CopyrightYear, TrimSize, PageCountsEditorialEst AS PageCount, Description, STATUS , SubcategoryName, Imprint, BindingType FROM Books
JOIN Statuses ON ( Books.ProductionStatusID = Statuses.StatusID ) JOIN Subcategories ON ( Books.SubcategoryID = Subcategories.SubcategoryID ) JOIN Imprints USING ( ImprintID ) JOIN BindingTypes USING  (BindingTypeID) WHERE ISBN10 = '$i10'"); 
    $book = $object[0];
    ?>
    <main class="mdl-layout__content  mdl-color--grey-50 pull_up">
        <div class="mdl-grid center">
        <div class="mdl-cell--6-col  mdl-grid--no-spacing center">
            <div class="mdl-cell mdl-card mdl-cell--11-col mdl-shadow--2dp">
                <!--<div class="mdl-card__title single_book" style="background:URL(/book-images/medium/<?php echo $i10?>.jpg) top/cover"></div>-->
                <div class="mdl-card single_book" style="padding:0px;">
                         <img class="dashboard-card" src="book-images/medium/<?php echo $book['ISBN10'] ?>.jpg" />
                </div>
                <div class="mdl-card__supporting-text">
                    <h2 class="mdl-card__title-text"><?php echo $book[Title]; ?></h2>
                    <!--ISBN10, ISBN13, Title, CopyrightYear, SubCategory, Imprint, Production Status, Binding Type, Trim Size, Page Count, and Description-->
                    <!--//One of these will contain a list of authors for the book, sorted by the Order field. The other card will display a list of universities that have adopted the book-->
                    <hr />
                    <p>Description:&nbsp <?php echo $book[Description]; ?></p>
                    <p>ISBN10:&nbsp <?php echo $book[ISBN10]; ?></p>
                    <p>ISBN30:&nbsp <?php echo $book[ISBN13]; ?></p>
                    <p>Copyright Year:&nbsp <?php echo $book[CopyrightYear]; ?></p>
                    <p>SubCategory:&nbsp <?php echo $book[SubcategoryName]; ?></p>
                    <p>Imprint:&nbsp <?php echo $book[Imprint]; ?></p>
                    <p>Production Status:&nbsp <?php echo $book[STATUS]; ?></p>
                    <p>Binding Type:&nbsp <?php echo $book[BindingType]; ?></p>
                    <p>Trim Size:&nbsp <?php echo $book[TrimSize]; ?></p>
                    <p>Page Count:&nbsp <?php echo $book[PageCount]; ?></p>
                </div>
            </div>
        </div>
        <div class="mdl-cell--6-col  mdl-grid--no-spacing ">
        <?php $authors=getFromDB("SELECT Authors.FirstName as FirstName, Authors.LastName as LastName, Authors.Institution as Institution FROM Books JOIN BookAuthors using (BookID) JOIN Authors using (AuthorID) WHERE BookID = $book[BookID]"); ?>
            <div class="mdl-cell mdl-card mdl-shadow--2dp mdl-cell--11-col double-row">
                <div class="mdl-card__title "></div>
    
                <div class="mdl-card__supporting-text">
                    <h1 class="mdl-card__title-text">Book Authors</h1>
                </div>
                <ul class="demo-list-three mdl-list ">                   <hr />

                    <?php foreach ($authors as $author){?>
                         <li class="mdl-list__item mdl-list__item--three-line contacto">
                            <span class="mdl-list__item-primary-content">
                              <i class="material-icons mdl-list__item-avatar">person</i>
                              <span><?php echo "$author[FirstName] $author[LastName]"; ?></span>
                              <span class="mdl-list__item-text-body">
                                <?php if ($author[Institution]==''){echo "No University affiliation";}else{echo $author[Institution];} ?>
                            </span>
                        </span>
    
                      </li>
                        <?php
                             }
                        ?>
                    </ul>
            </div>
            <div class="mdl-cell mdl-card mdl-shadow--2dp mdl-cell--11-col double-row">
                <!-- The other card will display a list of universities that have adopted the book. -->
                <div class="mdl-card__title "></div>
                    <div class="mdl-card__supporting-text">
                        <h2 class="mdl-card__title-text">Universities who adopted this book</h2>
                    </div>
                    <ul class="demo-list-three mdl-list ">                   <hr />
                    <?php $adoptions=getFromDB("SELECT Universities.Name as Name, Adoptions.ContactID as ContactID, Adoptions.AdoptionDate as AdoptionDate, Contacts.FirstName as FirstName, Contacts.LastName as LastName, Contacts.Email as Email FROM Adoptions JOIN Universities using (UniversityID) JOIN AdoptionBooks using (AdoptionID) JOIN Contacts using (ContactID) WHERE AdoptionBooks.BookID =$book[BookID]"); ?>
                    <?php foreach ($adoptions as $adoption){?>
                         <li class="mdl-list__item mdl-list__item--three-line pop-up" onmouseenter="animateMe(this)" onmouseleave="backToNormal(this)">
                            <span class="mdl-list__item-primary-content">
                                  <i class="material-icons mdl-list__item-avatar">account_balance</i>
                                  <div><span class="wrap-me"><?php echo "$adoption[Name]"; ?></span></div><br><br>
                                  <span class="mdl-list__item-text-body hideMe"><br>
                                       Book adoption date: <?php echo date( 'Y-M-d',strtotime( $adoption[AdoptionDate] )); ?><br>
                                       Contact Person: <?php echo "$adoption[FirstName] $adoption[LastName]"; ?><br>
                                       Email: <?php echo "$adoption[Email]"; ?>
                                   </span>
                            </span>
                            
                          </li>
                        <?php
                             }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </main>
 
        
  
</div>
<script>
    function animateMe($this){
        $($this).children(".mdl-list__item-primary-content").css("height", "auto");
        $child = $($this).children().children(".hideMe");
        $child.removeClass("hideMe").addClass("showed");
        $child.css("height", "auto");
    }
    function backToNormal($this){
            $($this).children().children(".showed").removeClass("showed").addClass("hideMe");
            $($this).children(".mdl-list__item-primary-content").css("height", "52px");
    }
</script> 
</body>
</html>