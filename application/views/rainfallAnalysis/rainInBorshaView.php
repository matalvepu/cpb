<div class="wrapper col6">
    <div id="chart_div" style="width: 900px; height: 600px;"></div>
    <div id ="error_message"><?php print_r($error)?></div>
</div>



    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php
        echo $array;
        ?>);

        var options = {
          title: '<?php echo $title;?>'
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
   