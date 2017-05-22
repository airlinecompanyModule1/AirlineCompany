<?php

class TicketInformation
{
	private $id;
	private $to;
	private $from;
	private $price;
	private $time;


	function __construct($id=NULL,$to=NULL,$form=NULL,$price=NULL,$time=NULL)
	{
          $this->id=$id;
          $this->to=$to;
          $this->form=$from;
          $this->price=$price;
          $this->time=$time;
	}

	public function getID()
	{
		return $this->id;
	}
	public function getTo()
	{
		return $this->to;
	}
	public function getFrom()
	{
		return $this->from;
	}
    public function getPrice()
    {
    	return $this->price;
    }
    public function getTime()
    {
    	return $this->time;
    }

}


?>