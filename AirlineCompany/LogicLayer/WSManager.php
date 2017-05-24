<?php
/**
* 
*/
class WSManager
{
	
	public static function callWSFlight($flightId)
	{
        $headers = array(
        "Content-Type: application/json"
        );
        // can be tested by web browser, http://md5.jsontest.com/?text=hello%20world
       $fields = array(
        "FlightId" => $flightId,

        );
       
        $url = "http://localhost:8080/AirlineCompany/LogicLayer/WSFlight.php/?" . http_build_query($fields);
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
      
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        // execute request
        $result = curl_exec($ch);
    
        curl_close($ch);
        $obj=json_decode($result);
        return $obj;
	}
}
?>