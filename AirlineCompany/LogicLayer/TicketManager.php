<?php
	require_once("../DataLayer/DB.php");
   	require_once("Ticket.php");

 /**
 * 
 */
 class TicketManager
 {
 	
           public static function getAllTickets() 
          {
          	
				$db = new DB();
				$result = $db->getDataTable("select p.TC,t.ID,PassengerId,p.Namee,p.Surname,ConnectionId,c.Phone,c.Email,FlightId,PNR,Price from tickets t,passengers p,connections c where t.PassengerId=p.ID and c.ID=t.ConnectionId order by ID");
			
				$alltickets = array();
		
				while($row = $result->fetch_assoc()) {
				$ticketObj = new Ticket($row["ID"], $row["PassengerId"], $row["ConnectionId"], $row["FlightId"], $row["PNR"], $row["Price"],$row["Namee"],$row["Surname"],$row["Email"],$row["Phone"],$row["TC"]);
				array_push($alltickets, $ticketObj);
				}
			
				return $alltickets;
		 }
		 public static function insertTicket($passId,$conId,$fId,$cardId,$pnr,$price)
		 {
    		 	$db = new DB();
   	   			$success = $db->executeQuery("INSERT into tickets(ID,PassengerId,ConnectionId,FlightId,CCardId,PNR,Price) values(NULL,'$passId','$conId','$fId','$cardId','$pnr','$price')");
   	   			return $success;
		 }

		    public static function getTicketByPnr($pnr) 
          {
          	
				$db = new DB();
				$result = $db->getDataTable("SELECT  FlightId,CCardId,Price,PassengerId,ConnectionId FROM tickets WHERE PNR='".$pnr."'");
				
				return $result;
		 }

			public static function deleteByPnr($Id)
   		{
		      $db=new DB();
		      $result = $db->executeQuery("delete from tickets where PNR='$Id' ");
		     
		      return $result;
   		}
 }
?>