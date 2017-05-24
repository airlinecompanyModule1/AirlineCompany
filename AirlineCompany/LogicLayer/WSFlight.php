<?php
  
	if(isset($_GET['FlightId'])) 
	{
		
            $from = "Ankara";
            $to = "Izmir";
            $ddate = "05.06.2015";
            $tickets=array();
		 
			array_push( $tickets, array("from"=>$from, "to"=>$to, "time"=>"05:00","date"=>$ddate) );
			header('Content-type: application/json');
		  	echo json_encode(array("information" =>$tickets ));
		
	}
	

?>		