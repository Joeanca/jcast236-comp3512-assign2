<?php

function analyticsJS($countryArray){
    // https://developers.google.com/chart/interactive/docs/gallery/geochart
    
    // http://blog.jonathanargentiero.com/material-design-lite-color-classes-list/
    
    
echo "<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
<script>
      google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Visitors'],";
        foreach ($countryArray as $country){
                echo "['$country[CountryName]',$country[adopted]],";
        };
          echo "
          
        ]);

        var options = {
            backgroundColor: '#fafafa',
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    </script>
    
    
    ";

}
function counter(){
    return "<script>
    $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 1500,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
</script>";
}
?>
