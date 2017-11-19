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
        return "CategoryID";    
    }
    public function getBooks(){
        return $this->getSpecific("select BookID, ISBN10, ISBN13, Title, CopyrightYear, SubcategoryID, ImprintID,  PageCountsEditorialEst, Description, CoverImage, Imprints.Imprint as Imprint, SubcategoryName from Books JOIN Imprints using (ImprintID) JOIN Subcategories using (SubcategoryID) order by Title");
    }
    public function getImprints(){
        return $this->getSpecific('select Imprint, ImprintID from Imprints Order by Imprint');
    }
    
    public function getSubcategories(){
        return $this->getSpecific("select SubcategoryID, SubcategoryName from Subcategories order by SubcategoryName");
    }
    public function getSingleBook($i10){
        return $this->getWithKeyValue("SELECT ImprintID, Books.SubcategoryID as subID, BookID, ISBN10, ISBN13, Title, CopyrightYear, TrimSize, PageCountsEditorialEst AS PageCount, Description, STATUS , SubcategoryName, Imprint, BindingType FROM Books
            JOIN Statuses ON ( Books.ProductionStatusID = Statuses.StatusID ) JOIN Subcategories USING (SubcategoryID) JOIN Imprints USING ( ImprintID ) JOIN BindingTypes USING  (BindingTypeID)", "ISBN10", $i10);
    }
    public function getAuthors($bID){
        return $this->getWithKeyValue("SELECT Authors.FirstName as FirstName, Authors.LastName as LastName, Authors.Institution as Institution FROM Books JOIN BookAuthors using (BookID) JOIN Authors using (AuthorID)","BookID",$bID);
    }
    public function getUniversities($bID){
         return $this->getWithKeyValue("SELECT Universities.Name as Name, Universities.UniversityID as uid, Adoptions.ContactID as ContactID, Adoptions.AdoptionDate as AdoptionDate, Contacts.FirstName as FirstName, Contacts.LastName as LastName, Contacts.Email as Email FROM Adoptions JOIN Universities using (UniversityID) JOIN AdoptionBooks using (AdoptionID) JOIN Contacts using (ContactID)", "BookID",$bID);
    }
}
?>