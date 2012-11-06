<?php

if(isset($_GET['country'])){
  
  $country = $_GET['country'];
  
  $m = new Mongo();
	$db = $m->unwdmi;
	$collection = $db->stations;
	
	$cursor = $collection->find(array("country" => $country));
  
	echo "obj.options[obj.options.length] = new Option('Kies een station');\n";
	

	foreach($cursor as $obj)
	{	
		echo "obj.options[obj.options.length] = new Option('".$obj['stn']."','".$obj['stn']."');\n";
	}
  
	
 
}
?>
