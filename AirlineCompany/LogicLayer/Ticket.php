<?php


class Ticket 
{
	private $ID;
	private $PassengerId;
	private $ConnectionId;
	private $FlightId;
	private $PNR;
	private $Price;
	private $pName;
	private $pSurname;
	private $Email;
	private $Phone;
	private $pTc;

	function __construct($ID=NULL,$PassengerId=NULL,$ConnectionId=NULL,$FlightId=NULL,$PNR=NULL,$Price=NULL,$pName=NULL,$pSurname=NULL,$Email=NULL,$Phone=NULL,$pTC=NULL)
	{
		$this->ID=$ID;
		$this->PassengerId=$PassengerId;
		$this->ConnectionId=$ConnectionId;
		$this->FlightId=$FlightId;
		$this->PNR=$PNR;
		$this->Price=$Price;
		$this->pName=$pName;
		$this->pSurname=$pSurname;
		$this->Email=$Email;
		$this->Phone=$Phone;
		$this->pTC=$pTC;
	}


    public function getpName()
    {
    	return $this->pName;
    }
    public function getpSurname()
    {
    	return $this->pSurname;
    }
    public function getEmail()
    {
    	return $this->Email;
    }
    public function getPhone()
    {
    	return $this->Phone;
    }
    public function getpTC()
    {
    	return $this->pTC;
    }
	public function getID()
	{
		return $this->ID;
	}
	public function getPassengerId()
	{
		return $this->PassengerId;
	}
	public function getConnectionId()
	{
		return $this->ConnectionId;
	}

	public function getFlightId()
	{
		return $this->FlightId;
	}
	public function getPNR()
	{
		return $this->PNR;
	}
	public function getPrice()
	{
		return $this->Price;
	}
}
?>