<?php
  
    require_once("contains.php");
    session_start();

 if(isset($_GET["From"]))
{
     // session_start();
      //session_unset(); 
      session_destroy(); 
  require_once("header.php");
}

else if(isset($_SESSION['loginMember']))
{
  //session_start(); 
  $id=$_SESSION['loginMember'];
  //session_unset($_SESSION['loginMember']); 
      session_destroy();
      session_start(); 
   $_SESSION['loginMember']=$id;
  require_once("memberHeader.php");
}

else
{
  //echo  "else girdim";
	//session_unset(); 
  //session_start(); 
      session_destroy(); 
  require_once("header.php");
}
	
require_once("searchFlight.php");
  

	


?>