<?php 
session_start();
session_destroy();
header("Location:PresentationLayer/home.php");
?>