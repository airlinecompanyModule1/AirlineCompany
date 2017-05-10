
<?php
 include_once("contains.php");

?>
<!DOCTYPE html>
<html lang="en">
<style type="text/css">
  .new {

    color: rgb(158,158,158);
    background-color: Transparent;
   
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
    

}
input[type="button"]:hover{
   color :white; 
}
</style>
<head>


</head>

<body role="document">

  

<nav class="navbar navbar-inverse" style="background-color:rgb(0,102,102); border-color:rgb(0,102,102);">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">P'airlines</a>
    </div>
    <ul class="nav nav-pills " >
      <li><a href="memberHome.php"><font color="rgb(0,206,209)" > <b>Flight Planning</b></font></a></li>
      <li><a href="checkin.php"><font color="rgb(204,102,0)" > <b>Check-in</b></font></a></li>
      <li><a href="#"><font color="rgb(204,102,0)" > <b>Cancellation</b></font></a></li>
      
      <ul class="nav navbar-nav navbar-right">
     
      <li><a href="myProfile.php"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
      <li>
      <input type="button" value="Log Out" class="new" id="al" style="outline: none;background-color: transparent; margin-top: 14px; margin-right:5px;" onclick="logoutFunction()">
      </ul>

    </ul>
 
  </div>

</nav>
  

</body>
<script type="text/javascript">
  function logoutFunction() 
  {
    window.location.href="home.php?From=log";
  }
</script>
</html>

