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
		public static function insertNewPassenger($newPassenger)
		{
			$db = new DB();

    			$id=$newPassenger->getID();
    			$name=$newPassenger->getName();
  	   			$surname=$newPassenger->getSurname();
   	   			$gender=$newPassenger->getGender();
   	   			$brithdate=$newPassenger->getBrithdate();
   	   			$tc=$newPassenger->getTC();
   	   			$success = $db->executeQuery("INSERT into passengers(ID,Namee,Surname,Gender,Brithdate,TC) values(NULL,'$name','$surname','$gender','$brithdate','$tc')");
   	   			return $success;
		}
		public static function getMaxId()
   		{
		      $db=new DB();
		      $result = $db->getDataTable("select Max(ID) as max from passengers");
		      $id=-1;
		      if($row = $result->fetch_assoc())
		      {
		        $id=$row["max"];
		      }
		      return $id;
   		}

   		public static function deletePassenger($Id)
   		{
		      $db=new DB();
		      $result = $db->executeQuery("delete from passengers where ID='$Id' ");
		     
		      return $result;
   		}


   	}
?>