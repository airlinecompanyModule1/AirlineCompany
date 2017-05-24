<?php
$headers = array("Content-Type: application/json");
        // can be tested by web browser, http://md5.jsontest.com/?text=hello%20world
	       			$fields = array("FlightId" => "1");
       
			        $url = "http://localhost:8080/AirlineCompany/LogicLayer/WSFlight.php/?" . http_build_query($fields);
			        $ch = curl_init();
			        
			        curl_setopt($ch, CURLOPT_URL, $url);
			        curl_setopt($ch, CURLOPT_POST, false);
			        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			        
			        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
			      
			        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			        
			        // execute request
			        $result = curl_exec($ch);
			        $obj = json_decode($result, true);
			        curl_close($ch);
			        $from=$obj["information"][0]["from"];
			        $to=$obj["to"];
			        $date=$obj["date"];
			        $time=$obj["time"];
			        echo"elma:".$from;

?>