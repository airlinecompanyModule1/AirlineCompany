<?php

class Connection
{

	private $ID;
	private $Name;
	private $Surname;
	private $Phone;
	private $Email;

	function __construct($ID=NULL,$Name=NULL,$Surname=NULL,$Phone=NULL,$Email=NULL)
	{
		$this->ID=$ID;
		$this->Name=$Name;
		$this->Surname=$Surname;
		$this->Phone=$Phone;
		$this->Email=$Email;
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
	public function getPhone()
	{
		return $this->Phone;
	}
	public function getEmail()
	{
		return $this->Email;
	}
}
?>