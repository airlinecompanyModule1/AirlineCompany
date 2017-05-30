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

	public static function deleteConnection($id)
	{
      	  $db=new DB();
          $success=1;
          $result = $db->getDataTable("select count(ID) as total from connections where ID='$id'");
          $total=0;
          if($row = $result->fetch_assoc())
          {
            $total=$row["total"];
          }
          if($total=1)
          {
            $success=$db->executeQuery("delete from connections where ID='$id'");
          }
      		
      		return $success;
	}
	public static function insertNewConnection($newConnection)
	{
			$db = new DB();

    			
    			$name=$newConnection->getName();
  	   			$surname=$newConnection->getSurname();
   	   			$phone=$newConnection->getPhone();
   	   			$email=$newConnection->getEmail();
   	   			$success = $db->executeQuery("INSERT into connections (ID,Namee,Surname,Phone,Email) values(NULL,'$name','$surname','$phone','$email')");
   	   			return $success;
	}
	public static function getMaxId()
   {
      $db=new DB();
      $result = $db->getDataTable("select Max(ID) as max from connections");
      $id=-1;
      if($row = $result->fetch_assoc())
      {
        $id=$row["max"];
      }
      return $id;
   }
}
?>