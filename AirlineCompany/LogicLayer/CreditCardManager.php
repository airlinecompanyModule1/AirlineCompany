<?php
require_once("CreditCard.php");

class CreditCardManager
{
	public static function insertCreditCard($newCard)
	{
		$db = new DB();

    		$id=$newCard->getID();
    		$name=$newCard->getCardHolderName();
    		$surname=$newCard->getCardHolderSurname();
    		$cardno=$newCard->getCardNo();
    		$exdate=$newCard->getExpirationDate();
    		$sno=$newCard->getSecurityNo();
    		
  	   		
   	   		$success = $db->executeQuery("INSERT into creditcards(ID,CardHolderName,CardHolderSurname,CardNo,SecurityNo,ExpirationDate) values(NULL,'$name','$surname','$cardno','$sno','$exdate')");
   	   		return $success;
	}
	public static function deleteCreditCard($id)
	{
      		$db=new DB();
          $success=1;
          $result = $db->getDataTable("select count(ID) as total from creditcards where ID='$id'");
          $total=0;
          if($row = $result->fetch_assoc())
          {
            $total=$row["total"];
          }
          if($total=1)
          {
            $success=$db->executeQuery("delete from creditcards where ID='$id'");
          }
      		
      		return $success;
	}
  public static function getCardByNo($cardno)
  {
          $db=new DB();
          $result = $db->getDataTable("select ID from creditcards where CardNo='$cardno'");
          $no=-1;
          if($row = $result->fetch_assoc())
          {
            $no=$row["ID"];
          }
          return $no;
  }

   public static function getCardById($id)
  {
          $db=new DB();

          $result = $db->getDataTable("select * from creditcards where ID='$id'");
          $card = new CreditCard(NULL,NULL,NULL,NULL,NULL,NULL);
          if($row = $result->fetch_assoc()) 
          {
            $holdername=$row['CardHolderName'];
            $holdersurname=$row['CardHolderSurname'];
            $exdate=$row['ExpirationDate'];
            $security=$row['SecurityNo'];
            $cardno=$row['CardNo'];
            $card = new CreditCard($id,$cardno,$holdername,$holdersurname,$exdate,$security);

           }

          return $card;
  }

}

?>