<?php
if(isset($_GET["name"])&& isset($_GET["surname"])&& isset($_GET["cardno"])&&isset($_GET["security"]) && isset($_GET["exdate"]) && isset($_GET["totalprice"]) && isset($_GET["type"]))
{


		header('Content-type: application/json');

		$result="false";
		echo json_encode(array("result"=>$result);
		
}

?>