<html>  
<head>  
    <script type="text/javascript" src="FusionCharts.js"></script>  
    <script type="text/javascript" src="prototype.js"></script>  
</head>  
   
<body bgcolor="#ffffff">  
<center>Demo of Dynamic Price Fluctuation on FusionCharts Free<br/>  
Copyright © Sony AK Knowledge Center - www.sony-ak.com</center>  
    <div id="chartdiv" align="center"></div>  
    <script type="text/javascript">  
            var myChart = new FusionCharts("FCF_Line.swf", "myChartId", "600", "400", "0", "1");  
        myChart.setDataURL('get_latest_data.php');  
        myChart.render("chartdiv");  
    </script>  
</body>  
</html>  
<script type="text/javascript">  
    new PeriodicalExecuter(function getLatestData() {  
        new Ajax.Request('get_latest_data.php', {  
              method: 'get',  
              onSuccess: function(transport) {  
                updateChartXML('myChartId', transport.responseText);  
              }  
            });  
    }, 5);  
</script>  