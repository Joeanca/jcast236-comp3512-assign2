<html>
	<head>
		<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				var country = ["Australia", "Bangladesh", "Denmark", "Hong Kong", "Indonesia", "Netherlands", "New Zealand", "South Africa"];
				$("#country").select2({
				  data: country
				});
			});
		</script>
	</head>
	<body>
		<h1>DropDown with Search using jQuery</h1>
		<div>
			<select id="country" style="width:300px;">
			<!-- Dropdown List Option -->
			</select>
		</div>
	</body>
</html>



//   var searchText = document.getElementById("fixed-header-drawer-exp");
//   var searchString="";
//   searchText.addEventListener("keyup", function(event) {
//     event.preventDefault();
//     if (event.keyCode === 13) {
//         alert(searchText.value);
//     }else{
//         searchString+=String.fromCharCode(event.keyCode);
//         console.log(searchString);
//     }
//     });

  <script>
  $(function () {
        var dataSrc = ["32", "austria", "antartica", "argentina", "algeria"];
 
        $("#fixed-header-drawer-exp").autocomplete({
        source:dataSrc,
        select: function(event, ui) {
            var url = ui.item.id;
            if(url != '#') {
                location.href = '/browse-employees.php?id=' + ui.item.value;
            }
        },
 
        html: true, // optional (jquery.ui.autocomplete.html.js required)
 
      // optional (if other layers overlap autocomplete list)
        open: function(event, ui) {
            $(".ui-autocomplete").css("z-index", 1000);
        }
        });
    });
</script>