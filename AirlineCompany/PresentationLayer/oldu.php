<?php

//session_destroy();
//echo "oldu";

/*$letters=array();
$j=0;
for($i="a";$i<"z";$i++)
{
array_push($letters,$i);
echo "<br>";
echo $letters[$j];

echo "<br>";
echo $j;
$j++;*/

session_start();
session_destroy();
header("Location:home.php");
/*if(isset($_SESSION["loginMember"]))
{
	echo $_SESSION["loginMember"];
}*/
?>