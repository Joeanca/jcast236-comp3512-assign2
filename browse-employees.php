<?php
session_start();
if(empty($_SESSION['UserID'])){
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
    header("Location:/login.php");
}

require_once('includes/config.php'); 
include_once('includes/employeeFunctions.inc.php');

?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <title>Employees</title>
    <?php 
        include "includes/importStatements.inc.php"; 
        $empDB = new EmployeesGateway();
    ?>

     <script>
        function showSearch(){
            if(document.getElementById("searchDiv").style.display=="none"){
                document.getElementById("searchDiv").style.display="inline";
            }
            else{
                document.getElementById("searchDiv").style.display="none";
            }
        }
    </script>
    
</head>

<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
     <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
        <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">
            <div class="mdl-grid">
                
              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Employees</h2>
                </div>
                
                
                
                    <div class="mdl-card__title mdl-color--blue-grey">
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="showSearch()">
                            Show Employee Filters
                        </button>
                    </div>
                    <form action ="/browse-employees.php" method="get" id="searchDiv" style="display:none">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" >
                        <select class="mdl-textfield__input" id="city" name="city"><label class="mdl-textfield__input" for="city">City filter</label>
                            <option></option>
                             <?php
                                $city = $empDB->getCities();
                                foreach($city as $c){
                                    echo '<option value="'. $c[0] . '">' . $c[0] . '</option>';
                                }
                            ?>
                                
                        </select>
                        
                    <label class="mdl-textfield__label" for="city">Search by city</label>
                    </div>
                    
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
                        <!--<label class="mdl-button mdl-js-buttom mdl-button--icon" for="searchName">-->
                        <!--    <i class="material-icons">search</i>-->
                        <!--</label>-->
                        <div class="mdl-textfield  mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" name="lastname" id="searchName"/>
                            <label class="mdl-textfield__label" for"searchName">Search by Last Name</label>
                        </div>
                    </div>
                    <div class="">
                        <button class="mdl-button  mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">Search</button>
                    </div>
                    
                    <div class="mdl-card__actions mdl-card--border">
                    </div>
                    </form>

                
                
                
                <div class="mdl-card__supporting-text">
                    <ul class="demo-list-item mdl-list">
                         <?php 
                            if (isset($_POST['search'])){
                                $employees = $empDB->getByLastName($_POST['search']);
                                usort($employees, function($a, $b) {
                                    if($cmp = strnatcasecmp($a['LastName'], $b['LastName'])) return $cmp;
                                    return strnatcasecmp($a['FirstName'], $b['FirstName']);
                                });
                            }
                            else{    
                               if(isset($_GET['city']) && empty($_GET['lastname'])){
                                    $id=$_GET['city'];
                                    $employees=$empDB->citySearch($id);
                                }
                                else if(isset($_GET['lastname']) && empty($_GET['city'])){
                                    $id=$_GET['lastname'];
                                    $employees=$empDB->getByIncompleteName($id);
                                }
                                else if(isset($_GET['lastname']) && isset($_GET['city'])){
                                    $city=$_GET['city'];
                                    $lastName=$_GET['lastname'];
                                    $employees=$empDB->cityAndLastNameSearch($city,$lastName);
                                }
                                else{
                                    $employees = $empDB->getEverything();
                                }
                            }
                                 usort($employees, function($a, $b) {
                                    if($cmp = strnatcasecmp($a['LastName'], $b['LastName'])) return $cmp;
                                    return strnatcasecmp($a['FirstName'], $b['FirstName']);
                                });
                              foreach ( $employees as $employee ){
                         ?> 
                               <li class='mdl-list__item'><?php echo constructGenreLink($employee[EmployeeID],$employee[FirstName]." ".$employee[LastName]); ?></li>
                        <?php
                             }
                        ?>
                    </ul>
                </div>
              </div>  <!-- / mdl-cell + mdl-card -->
              
              <!-- mdl-cell + mdl-card -->
              <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--orange">
                      <h2 class="mdl-card__title-text">Employee Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                          <div class="mdl-tabs__tab-bar">
                              <a href="#address-panel" class="mdl-tabs__tab is-active">Address</a>
                              <a href="#todo-panel" class="mdl-tabs__tab">To Do</a>
                              <a href="#message-panel" class="mdl-tabs__tab">Messsage Panel</a>

                          </div>
                        
                          <div class="mdl-tabs__panel is-active" id="address-panel">
                              
                           <?php   
                             /* display requested employee's information */
                            if (isset($_GET[id])){
                                $details = $empDB->getEmployeeByID($_GET[id])[0];
                            }
                            if (!empty($details)){
                                
                            echo    "<h3>$details[FirstName] $details[LastName]</h3>
                                    <p>$details[Address]<br>
                                    $details[City], $details[Region]<br>
                                    $details[Country], $details[Postal]<br>
                                    $details[Email]</p>" ;
                            }else{
                                echo "<h4>Select an employee from the employee list</h4>";
                            }
                           ?>
                          </div>
                          <div class="mdl-tabs__panel" id="todo-panel">
                               <?php                       
                                 /* retrieve for selected employee;
                                    if none, display message to that effect */
                                    if (isset($_GET[id])){
                                        $id = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
                                        $empToDo=$empDB->getToDo($id);
                                        
                                        //$toDos = getFromDB("select * from EmployeeToDo where EmployeeID=:id order by DateBy", $id);
                                    }else $empToDo;
                                    $isEmpty = empty($empToDo);
                                    if (!$isEmpty){
                                    //usort($toDos, "sortByDate");
                               ?>                                  
                                <table class="mdl-data-table  mdl-shadow--2dp">
                                  <thead>
                                    <tr>
                                      <th class="mdl-data-table__cell--non-numeric">Date</th>
                                      <th class="mdl-data-table__cell--non-numeric">Status</th>
                                      <th class="mdl-data-table__cell--non-numeric">Priority</th>
                                      <th class="mdl-data-table__cell--non-numeric">Content</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php /*  display TODOs  */ 
                                            foreach ($empToDo as $toDo){
                                                        $time = strtotime( $toDo[DateBy] );
                                                        $myDate = date( 'Y-M-d', $time );                                                
                                                        echo "<tr>
                                                         <td class='mdl-data-table__cell--non-numeric'>".$myDate."</td>
                                                         <td class='mdl-data-table__cell--non-numeric'>$toDo[Status]</td>
                                                         <td class='mdl-data-table__cell--non-numeric'>$toDo[Priority]</td>
                                                         <td class='mdl-data-table__cell--non-numeric'>$toDo[Description]</td>
                                                       </tr>";
                                            }
                                        }  else {
                                            echo "<h4>No to do's were found</h4>";
                                        }
                                    ?>
                                  </tbody>
                                </table>
                          </div>
                           <div class="mdl-tabs__panel" id="message-panel">
                           <?php                       
                                 /* retrieve for selected employee;
                                    if none, display message to that effect */
                                    if (isSet($_GET[id])){
                                        $id	= $_GET[id];
                                        $empMessages=$empDB->getMessages($id);
                                        //$mssgs = getFromDB("select * from	EmployeeMessages where EmployeeID= :id order by MessageDate", $id);
                                    }else $empMessages;
                                    $isEmpty = empty($empMessages);
                                    if (!$isEmpty){
                               ?>                                  
                                <table class="mdl-data-table  mdl-shadow--2dp">
                                  <thead>
                                    <tr>
                                      <th class="mdl-data-table__cell--non-numeric">Date</th>
                                      <th class="mdl-data-table__cell--non-numeric">Category</th>
                                      <th class="mdl-data-table__cell--non-numeric">From</th>
                                      <th class="mdl-data-table__cell--non-numeric">Messages</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php /*  display Messages  */ 
                                            $contacts = $empDB->getContacts();
                                            foreach ($empMessages as $mssg){
                                                        $time = strtotime( $mssg[MessageDate] );
                                                        $myDate = date( 'Y-M-d', $time );                           
                                                        $contact = getNeedle($contacts, $mssg[ContactID],ContactID);
                                                        echo "<tr>
                                                         <td class='mdl-data-table__cell--non-numeric'>".$myDate."</td>
                                                         <td class='mdl-data-table__cell--non-numeric'>$mssg[Category]</td>
                                                         <td class='mdl-data-table__cell--non-numeric'>$contact[FirstName] $contact[LastName]</td>
                                                         <td class='mdl-data-table__cell--non-numeric'>".substr($mssg[Content],0,40)."</td>
                                                       </tr>";
                                            }
                                        }  else {
                                            echo "<h4>No messages were found </h4>";
                                        }
                                    ?>
                                  </tbody>
                                </table>
                          </div>
                        </div>                         
                    </div>    
              </div>  <!-- / mdl-cell + mdl-card -->   
            </div>  <!-- / mdl-grid -->    
        </section>
    </main>     
</div>    <!-- / mdl-layout --> 
</body>
</html>