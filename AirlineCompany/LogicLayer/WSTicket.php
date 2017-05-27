<?php
  
	if(isset($_GET['type']) && isset($_GET['from']) && isset($_GET['to']) && isset($_GET['ddate']) && isset($_GET['rdate']) && isset($_GET['selAdult']) && isset($_GET['selChild']) && isset($_GET['selInfant']) ) 
	{
		
		
			$type = $_GET["type"];
            $from = $_GET["from"];
            $to = $_GET["to"];
            $ddate = $_GET["ddate"];
            $selAdult = $_GET["selAdult"];
            $selChild = $_GET["selChild"];
            $selInfant = $_GET["selInfant"];
			$tickets = array();
			$tickets2 = array();
		  for($i = 1; $i < 6; $i++) 
		  {
			array_push( $tickets, array("id"=>$i,"from"=>$from, "to"=>$to, "time"=>"5","price"=>50,"date"=>$ddate) );
			array_push( $tickets2, array("id"=>$i,"from"=>$from, "to"=>$to, "time"=>"5","price"=>50,"date"=>$ddate) );
		  }
			
		
			header('Content-type: application/json');
			$type=$_GET["type"];

		   echo json_encode(array("type"=>$type,array("TicketGoing" =>$tickets),array("TicketReturn" =>$tickets2)));
		
	}
	

?>		