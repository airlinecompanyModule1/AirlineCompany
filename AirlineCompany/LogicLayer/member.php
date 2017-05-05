<?php

class Member 
{
	
	private $id;
	private $name;
	private $surname;
	private $password;
	private $email;
	private $phonenumber;
	private $gender;
	private $flightmoney;
    private $isadmin;
	function __construct($id=NULL,$name=NULL,$surname=NULL,$password=NULL,$email=NULL,$phonenumber=NULL,$gender=NULL,$flightmoney=NULL,$isadmin=NULL)
	{
		$this->id=$id;
		$this->name=$name;
		$this->surname=$surname;
		$this->password=$password;
        $this->email=$email;
        $this->phonenumber=$phonenumber;
        $this->gender=$gender;
        $this->flightmoney=$flightmoney;
        $this->isadmin=$isadmin;


	}

	public function getID()
	{
		return $this->id;
	}
    public function getName()
    {
        return  $this->name;
    }
    public function getSurname()
    {
    	return  $this->surname;
    }
    public function getPassword()
    {
    	return  $this->password;
    }
    public function getEmail()
    {
    	return  $this->email;
    }
    public function getPhoneNumber()
    {
    	return  $this->phonenumber;
    }
    public function getGender()
    {
    	return  $this->gender;
    }
    public function getFlightMoney()
    {
    	return  $this->flightmoney;

    }
    public function getIsAdmin()
    {
    	return  $this->isadmin;
    }

}
?>