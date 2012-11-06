<?php  
  // script name: get_latest_data.php  
  // coder: Sony AK Knowledge Center - www.sony-ak.com  
  // code updated on Feb 26, 2010  
   
  $dbConn = mysql_connect('your_db_host', 'your_db_username', 'your_db_password') or die("Connection to database failed, perhaps the service is down !!");  
  mysql_select_db('your_db_name') or die("Database name not available !!");  
   
  $resultSet = mysql_query("SELECT *, date_format(update_datetime, '%H:%i') AS time_only FROM price_fluctuation ORDER BY update_datetime DESC LIMIT 5", $dbConn);  
  $rowCount = mysql_num_rows($resultSet);  
   
  $xmlData = "<graph caption='Price Fluctuation (in USD)' yAxisMinValue='1000' yAxisMaxValue='5000' animation='0' canvasBorderColor='FFFFFF' xAxisName='Time' yAxisName='Price' showNames='1' decimalPrecision='0' formatNumberScale='0'>";  
   
  $index = $rowCount - 1;  
  for ($i=0;$i<$rowCount;$i++) {  
    $updateDatetime = mysql_result($resultSet, $index, "time_only");  
    $price = mysql_result($resultSet, $index, "price");  
    $xmlData .= "<set name='" . $updateDatetime . "' value='" . $price . "' color='000000' />";  
    $index--;  
  }  
   
  $xmlData .= "</graph>";  
   
  // insert new data, to make fluctuation effect on the chart  
  mysql_query("INSERT INTO price_fluctuation (update_datetime, price) VALUES (now(), " . rand(1000, 5000) . ")", $dbConn);  
   
  echo $xmlData;  
?>