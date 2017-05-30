<?php
  
	if(isset($_GET['FlightId']) && isset($_GET['PassCount'])) 
	{
		
            
			header('Content-type: application/json');
			$result="true";
		  	echo json_encode(array("result" =>$result ));
		
	}
	

?>	