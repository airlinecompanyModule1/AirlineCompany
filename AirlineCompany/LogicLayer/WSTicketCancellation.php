<?php

 require_once("../DataLayer/DB.php");
 require_once("TicketManager.php");
 require_once("CreditCardManager.php");
  require_once("PassengerManager.php");
  require_once("ConnectionManager.php");
	if(isset($_GET['PNR'])) 
	{
		
			
			$pnr=$_GET['PNR'];
			
			$result = TicketManager::getTicketByPnr($pnr);
			$FlightId=-1;
			if($row = $result->fetch_assoc()) 
			{
				$FlightId = $row['FlightId'];
				$CCardId=$row['CCardId'];
				$price=$row['Price'];
				$passId= $row['PassengerId'];
				$connectionId = $row['ConnectionId'];
				
				$card=CreditCardManager::getCardById($CCardId);
			   
			    if($card->getID()!="NULL") 
			    {
			    	$holdername=$card->getCardHolderName();
			    	$holdersurname=$card->getCardHolderSurname();
			    	$exdate=$card->getExpirationDate();
			    	$security=$card->getSecurityNo();
			    	$cardno=$card->getCardNo();

				    $headers = array("Content-Type: application/json");
			        // can be tested by web browser, http://md5.jsontest.com/?text=hello%20world
			        $fields = array(
			        "type" => "cancellation",
			        "name" => $holdername,
			        "surname" => $holdersurname,
			        "cardno" => $cardno,
			        "security" => $security,
			        "exdate" => $exdate,
			        "totalprice" =>$price

			        );
			     $url = "http://localhost:8080/AirlineCompany/LogicLayer/WSPayment.php/?" . http_build_query($fields);
			         //$con='http://localhost:8080/AirlineCompany/LogicLayer/WSPnrValidation.php/?PNR='.$original_text;
			        // $jsondata=file_get_contents($url);
			        // initialize a cURL session
			        $ch = curl_init();
			        
			        // set the url, number of GET vars, GET data
			        curl_setopt($ch, CURLOPT_URL, $url);
			        curl_setopt($ch, CURLOPT_POST, false);
			        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			        // TRUE to return the transfer as a string of the return value of curl_exec() 
			        // instead of outputting it out directly
			        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
			        // FALSE to stop cURL from verifying the peer's certificate.
			        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			        
			        // execute request
			        $result = curl_exec($ch);
			        $obj = json_decode($result, true);
			       
			        curl_close($ch);
			        $control=$obj["result"];


			        if($control=="false")
			        {
			        	$FlightId=-1;
			        }
			        else
			        {
			        	$pass=PassengerManager::deletePassenger($passId);
			        	$con=ConnectionManager::deleteConnection($connectionId);
			        	$cardcontrol=CreditCardManager::deleteCreditCard($CCardId);
			        	$ticket=TicketManager::deleteByPnr($pnr);
			        }

			    }
			}
			header('Content-type: application/json');
			$arr = array("FlightId" =>$FlightId);
		    echo json_encode($arr);
		
	}

?>