<?php

/**
* 
*/
class CreditCard
{
	private $ID;
	private $CardNo;
	private $CardHolderName;
	private $CardHolderSurname;
	private $ExpirationDate;
	private $SecurityNo;
	function __construct($ID=NULL,$CardNo=NULL,$CardHolderName=NULL,$CardHolderSurname=NULL,$ExpirationDate=NULL,$SecurityNo=NULL)
	{
		$this->ID=$ID;
		$this->CardNo=$CardNo;
		$this->CardHolderName=$CardHolderName;
		$this->CardHolderSurname=$CardHolderSurname;
		$this->ExpirationDate=$ExpirationDate;
		$this->SecurityNo=$SecurityNo;
	}


	public function getID()
	{
		return $this->ID;
	}
	public function getCardNo()
	{
		return $this->CardNo;
	}
	public function getCardHolderName()
	{
		return $this->CardHolderName;
	}
	public function getCardHolderSurname()
	{
		return $this->CardHolderSurname;
	}
	public function getExpirationDate()
	{
		return $this->ExpirationDate;
	}
	public function getSecurityNo()
	{
		return $this->SecurityNo;
	}
}
?>