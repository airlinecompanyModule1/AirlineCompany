<?php
 require_once("../DataLayer/DB.php");
 require_once("Connection.php");

class ConnectionManager
{
	
	public static function getAllConnections()
	{
        $db = new DB();
		$result = $db->getDataTable("select ID,Namee,Surname,Email,Phone from connections order by ID");
			
		$allConnections = array();
		while($row = $result->fetch_assoc()) 
		{
			$conObj = new Connection($row["ID"], $row["Namee"], $row["Surname"], $row["Phone"] ,$row["Email"]);
			array_push($allConnections, $conObj);
		}
			
		return $allConnections;
	}
	public static function updateConnection($updatedConnection)
	{
		$db = new DB();

    	$id=$updatedConnection->getID();
    	$name=$updatedConnection->getName();
  	    $surname=$updatedConnection->getSurname();
   	   	$phone=$updatedConnection->getPhone();
       	$email=$updatedConnection->getEmail();
      
		$success = $db->executeQuery("UPDATE connections SET Namee='$name',Surname='$surname',Email='$email',Phone='$phone' where ID='$id'");
		
		return $success;
	}
}
?>