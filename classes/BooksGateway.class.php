<?php
class BooksGateway extends AbstractTableGateway {    
    public function __construct(){
        parent::__construct();   
    }       
    protected function getSelectStatement(){    
        return "select BookID, ISBN10, ISBN13, Title, CopyrightYear, SubcategoryID, ImprintID,  PageCountsEditorialEst, Description, CoverImage, Imprints.Imprint as Imprint, SubcategoryName from Books JOIN Imprints using (ImprintID) JOIN Subcategories using (SubcategoryID) ";
    }    
    protected function getOrderFields(){
        return 'Subcategory';   
    }      
    protected function getKeyName() {
        return "BookID";    
    }
    public function getImprints(){
        return $this->getSpecific("select BookID, ISBN10, ISBN13, Title, CopyrightYear, SubcategoryID, ImprintID,  PageCountsEditorialEst, Description, CoverImage, Imprints.Imprint as Imprint, SubcategoryName from Books JOIN Imprints using (ImprintID) JOIN Subcategories using (SubcategoryID) order by Title");
    }
}
?>