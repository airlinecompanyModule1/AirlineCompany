<?php
	require_once("../DataLayer/DB.php");
   	require_once("Passenger.php");
   	/**
   	* 
   	*/
   	class PassengerManager
   	{
   		 public static function getAllPassengers() 
        {
          	
			$db = new DB();
			$result = $db->getDataTable("select ID,Namee,Surname,Gender,Brithdate,TC from passengers order by ID");
			
			$allpassengers = array();
		

		    while($row = $result->fetch_assoc()) {
				$passObj = new Passenger($row["ID"], $row["Namee"], $row["Surname"], $row["Gender"], $row["Brithdate"], $row["TC"]);
				array_push($allpassengers, $passObj);
				}
			
				return $allpassengers;
		}
		public static function updatePassenger($updatedPassenger)
		{
			$db = new DB();

    			$id=$updatedPassenger->getID();
    			$name=$updatedPassenger->getName();
  	   			$surname=$updatedPassenger->getSurname();
   	   			$gender=$updatedPassenger->getGender();
   	   			$brithdate=$updatedPassenger->getBrithdate();
   	   			$tc=$updatedPassenger->getTC();
				$success = $db->executeQuery("UPDATE passengers SET Namee='$name',Surname='$surname',Gender='$gender',Brithdate='$brithdate',TC='$tc' where ID='$id'");
				
				return $success;
		}

   	}
?>