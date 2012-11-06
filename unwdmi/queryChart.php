<?php
echo 'bier';


if(isset($_GET['id']))
{
	//query chart
	
	$m = new Mongo();
	$db = $m->unwdmi;
	
	$station = $_POST['select-box-stationID'];
	$currentTime = date('H:i:s',time());
	$thirtyseconds = date('H:i:s',time()-30);
	
		
	$query = array( "stationId" => $station, "tijd" => array( '$gt' => $thirtyseconds, '$lte' => $currentTime ));
	$result = $db->measurements->find($query);

	$masterArray = array();
	
	foreach($result as $row)
	{
		array_push($masterArray, '['.$row['tijd'].','.$row['windsnelheid'].','.$row['windrichting'].']');		
	}
	
	$js_array = json_encode($masterArray);
	$response = implode(' ',$js_array);
	
	
}

?>