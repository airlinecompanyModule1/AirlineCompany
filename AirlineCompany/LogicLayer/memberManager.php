<?php
   require_once("../DataLayer/DB.php");
   require_once("Member.php");

   class MemberManager {



   	      public static function updateMemberById($member)
   	      {
    			$db = new DB();

    			$id=$member->getID();
    			$name=$member->getName();
  	   			$surname=$member->getSurname();
   	   			$phone=$member->getPhoneNumber();
       			$flightmoney=$member->getFlightMoney();
       			$password=$member->getPassword();
       			$email=$member->getEmail();
       			$isAdmin=$member->getIsAdmin();
				$success = $db->executeQuery("UPDATE members SET IsAdmin='$isAdmin',Namee='$name',Surname='$surname',Email='$email',PhoneNo='$phone',FlightMoney='$flightmoney' where ID='$id'");
				
				
				return $success;
   	      }
   	        public static function updateMemberByIdMember($member)
   	      {
   	      	
    			$db = new DB();

    			$id=$member->getID();
    			$name=$member->getName();
  	   			$surname=$member->getSurname();
   	   			$phone=$member->getPhoneNumber();
       			$email=$member->getEmail();
				$success = $db->executeQuery("UPDATE members SET Namee='$name',Surname='$surname',Email='$email',PhoneNo='$phone' where ID='$id'");
				
				
				return $success;
   	      }
   	      public static function deleteMemberById($id)
   	      {
      			$db=new DB();
      			$success=$db->executeQuery("delete from members where ID='$id'");
      			return $success;
   	      }

          public static function getAllMembers() 
          {
          	
				$db = new DB();
				$result = $db->getDataTable("select ID, IsAdmin,Namee,Surname,Email,PhoneNo,Passwordd,FlightMoney,Gender from members order by ID");
			
				$allMembers = array();
			
				while($row = $result->fetch_assoc()) {
				$memObj = new Member($row["ID"], $row["Namee"], $row["Surname"], $row["Passwordd"], $row["Email"], $row["PhoneNo"], $row["Gender"], $row["FlightMoney"],$row["IsAdmin"]);
				array_push($allMembers, $memObj);
				}
			
				return $allMembers;
		 }
		  public static function getMemberById($id) 
          {
          	
				$db = new DB();
				$result = $db->getDataTable("select ID, IsAdmin,Namee,Surname,Email,PhoneNo,Passwordd,FlightMoney,Gender from members where ID='$id'");
			
				
			    $memObj= new Member(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
				if($row = $result->fetch_assoc()) {
				$memObj = new Member($row["ID"], $row["Namee"], $row["Surname"], $row["Passwordd"], $row["Email"], $row["PhoneNo"], $row["Gender"], $row["FlightMoney"],$row["IsAdmin"]);
				
				}
			
				return $memObj;
		 }
		public static function insertNewMember($name,$surname,$email,$phone,$gender,$password) 
		{
				$db = new DB();
				#$mdpassword=md5($password);
				$success = $db->executeQuery("INSERT INTO members(ID, IsAdmin, Namee,Surname,Email,PhoneNo,Passwordd,FlightMoney,Gender)VALUES (NULL,'N', '$name','$surname','$email','$phone','$password',0,'$gender')");
				#$success=$db->executeQuery("INSERT into deneme(number,no)VALUES('5',541)");
				
				return $success;
		}
        public static function controlLogin($phone,$password)
        {
 				$db=new DB();
 				#$mdpassword=md5($password);
 				$query="select ID ,IsAdmin from members where PhoneNo='$phone' and Passwordd='$password'";
 				$result = $db->getDataTable("select ID ,IsAdmin from members where PhoneNo='$phone' and Passwordd='$password'");
			
				
			   $memObj1= new Member(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
				if($row = $result->fetch_assoc()) 
				{
					$memObj2 = new Member($row["ID"],NULL,NULL,NULL,NULL,NULL,NULL,NULL,$row["IsAdmin"]);
					return $memObj2;
				}
			
				return $memObj1;
        }

        public static function updateFlightMoney($memberId,$money)
        {
        	$db=new DB();
        	$success = $db->executeQuery("UPDATE members SET FlightMoney='$money' where ID='$memberId'");

			return $success;
        }





   }

?>