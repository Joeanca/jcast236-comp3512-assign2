  <?php 
    $startupInstance= new StartupGateway;
    $employeeArray = $startupInstance->getEmployees();
    
  ?>
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
     <h1 class="mdl-layout-title"><span>CRM</span> Admin</h1>
 

     
      <div class="mdl-layout-spacer"></div>
      
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                  mdl-textfield--floating-label mdl-textfield--align-right">
                  
<label id="tt2" class="material-icons mdl-badge mdl-badge--overlap" data-badge="5">account_box</label>  
<div class="mdl-tooltip" for="tt2">Messages</div>                     
                 
<label id="tt3" class="material-icons mdl-badge mdl-badge--overlap" data-badge="4">notifications</label> 
 <div class="mdl-tooltip" for="tt3">Notifications</div>           
                  
        <label class="mdl-button mdl-js-button mdl-button--icon"
               for="fixed-header-drawer-exp">
          <i class="material-icons">search</i>
        </label>
        <div class="mdl-textfield__expandable-holder">
            <input class="mdl-textfield__input" type="text" name="sample"
                 id="fixed-header-drawer-exp">
                
        </div>
        <div>
        </div>
            
        </div>
    </div>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      </header>
  <script>
    function post(path, params, method) {
    method = method || "post"; 
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}
  
    var searchText = document.getElementById("fixed-header-drawer-exp");
    var searchString="";
    searchText.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        var params =  {search: searchText.value};
        post('browse-employees.php', params, 'post')
    }
    });

  
  $(function () {
        // var dataSrc = ["32", "austria", "antartica", "argentina", "algeria"];
         var dataSrc = <?php echo json_encode($employeeArray); ?>;
        $("#fixed-header-drawer-exp").autocomplete({
        source:dataSrc,
        select: function(event, ui) {
            event.preventDefault();
            $("#fixed-header-drawer-exp").val(ui.item.label);
                location.href = '/browse-employees.php?id=' + ui.item.value;
        },
        focus: function(event, ui) {
        event.preventDefault();
        $("#customer-search").val(ui.item.label);
        },
        html: true, // optional (jquery.ui.autocomplete.html.js required)
         // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            $(".ui-autocomplete").css("z-index", 1000);
        }
        });
    });
</script>