<?php
	include('include.php');
	include('session.php');
	
	

	
	
	//mongo 
	$m = new Mongo();
	$db = $m->unwdmi;
	$collection = $db->stations;	
	
	$keys = array("country" => 1);
	$initial = array("stations" => array());
	$reduce = "function(obj, prev){prev.stations.push(obj.name);}";
	
	$cursor = $collection->group($keys, $initial, $reduce);
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Andong College’s Research Institute of the Pacific</title>
	<link rel="stylesheet" href="default.css" type="text/css" />
	
	
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
/////// Get countries and stations.
var ajax = new Array();


function getStationList(sel)
{
	var countryName = sel.options[sel.selectedIndex].value;
	document.getElementById('select-box-stationID').options.length = 0;
	if(countryName.length>0){
	
		var index = ajax.length;
		
		ajax[index] = new sack();
		
		ajax[index].requestFile = 'getStationIds.php?country='+countryName;
		ajax[index].onCompletion = function() { createStations(index) };
		ajax[index].runAJAX();
	}
}

function createStations(index)
{
	var obj = document.getElementById('select-box-stationID');
	eval(ajax[index].response);
}

function getData()
{
	var stationId = document.getElementById('select-box-stationID').value;
	
	var index = ajax.length;
	ajax[index] = new sack();
	ajax[index].requestFile = 'queryChart.php?id='+stationId;
	
	ajax[index].onCompletion = function() { drawChart() };
	ajax[index].runAJAX();
}




//////// create graph.
// Load the Visualization API and the piechart package.
google.load('visualization', '1.0', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.

function drawChart(index) {

	// Create the data table.
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Time');
	data.addColumn('number', 'Wind Direction');
	data.addColumn('number','Wind Speed');
	data.addRows([
	  ['12:58:03', 3,1],
	  ['12:58:04', 2,1],
	  ['12:58:05', 4,1],
	  ['12:58:06', 1,1],
	  ['12:58:07', 2,1]
	]);



	// Set chart options
	var options = {'title':'Windspeed and Direction',
				   'width':715,
				   'height':400,
				  'pointSize':2
				   };

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
	chart.draw(data, options);
}




 function showMe (element) {
         document.getElementById("div1").style.display = element=="div1"?"block":"none"; 
       }

</script>
	
	
	
	
	
</head>
<body>
	<div class="wrapper">
		<div class="header">
		
			<div class="logo">
			</div>
			<div class="welcome">	
				Welcome <?php echo $_SESSION['name']; ?>.
			</div>
			<div class="menu">
				<ul>
					<li class="first"><a href="index.php">Home</a></li>
					<li><a href="#">Download CSV</a></li>
					<li><a href="change_pass.php">Change Password</a></li>
					<li class="last"><a href="logout.php">Logout</a></li>
				</ul>
			</div>
		</div><!--end header-->
		<div class="content">
			<div class="right">
				<h2>RAINFALL TOP 25 ASIA & THE PACIFIC</h2>
				<hr />
				
				
				
				
				<table>
					<tr>
						<td>COUNTRY</td>	<td>RAINFALL IN MM</td>
					</tr>

				</table>
			</div><!--end right-->
			
			<div class="left">
			<div class="leftcontent">
				<h2>REALTIME GRAPH WINDSPEED & DIRECTION</h2>
				<hr />
				<form action="" method="post" name="form1" >
				<select name="select-box-countries" id="select-box-countries" onchange="getStationList(this)">
					<option>Select a Country...</option>
					
				<?php
					foreach($cursor['retval'] as $obj)
					{
						echo '<option value="'.$obj["country"].'">' .$obj["country"].'</option>';	
					}
				?>
				
				</select>
			
				<select id="select-box-stationID" name="select-box-stationID" onchange="showMe('div1')">
				</select>
						
						<div id="div1" style="display:none">
							<input name="submit" type="submit" value="Show Graph" class="button" onclick="getData();" />
						</div>
				</form>
				
		

				
				<div id="chart_div"></div>
			</div>
			</div><!--end left-->
			
		</div><!--end content-->
		<div class="clear">
		</div>
	</div><!--end wrapper-->
		<div class="footer">
			<span>Designed & Created by: JCorp</span>
		</div><!--end footer-->
	
</body>
</html>