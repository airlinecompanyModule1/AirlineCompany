<?php
session_start();
//session_destroy();
echo "oldu";
if(isset($_SESSION["totalPrice"]))
{
	echo "totalPrice".$_SESSION["totalPrice"];
}
?>