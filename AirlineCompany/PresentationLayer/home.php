<?php
   session_start();
    require_once("contains.php");
	require_once("header.php");
	require_once("searchFlight.php");
	 if(isset($_GET["From"]))
    {
    	
      session_unset(); 
      session_destroy(); 
     
     if(isset($_SESSION['loginMember']))
     {
        echo "id ".$_SESSION['loginMember'];
     }
     
    }
?>