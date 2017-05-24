<?php

class Passenger
{

	private $ID;
	private $Name;
	private $Surname;
	private $Gender;
	private $Brithdate;
	private $TC;
	
	function __construct($ID=NULL,$Name=NULL,$Surname=NULL,$Gender=NULL,$Brithdate=NULL,$TC=NULL)
	{
		$this->ID=$ID;
		$this->Name=$Name;
		$this->Surname=$Surname;
		$this->Gender=$Gender;
		$this->Brithdate=$Brithdate;
		$this->TC=$TC;
	}

	public function getID()
	{
		return $this->ID;
	}
	public function getName()
	{
		return $this->Name;
	}
	public function getSurname()
	{
		return $this->Surname;
	}
	public function getGender()
	{
		return $this->Gender;
	}
	public function getBrithdate()
	{
		return $this->Brithdate;
	}
	public function getTC()
	{
		return $this->TC;
	}
}


?>