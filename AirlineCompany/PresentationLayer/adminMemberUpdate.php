<?php
require_once("contains.php");
require_once("../LogicLayer/MemberManager.php");

$id="";
$errorMeesage="";
if(isset($_REQUEST['ID']))
{
   $id=$_REQUEST['ID'];
   $result=MemberManager::getMemberById($id);
   if($result->getID()!=NULL)
   {
   	   $name=$result->getName();
  	   $surname=$result->getSurname();
   	   $phone=$result->getPhoneNumber();
       $flightmoney=$result->getFlightMoney();
       $password=$result->getPassword();
       $email=$result->getEmail();
       $isAdmin=$result->getIsAdmin();
   }
   #$_GET['ID']="";
   #echo $id;
}
if(isset($_POST['memberName']) && isset($_POST['memberSurname'])&& isset($_POST['flightMoney'])&& isset($_POST['email']) && isset($_POST['phoneNo']))
{
	 #echo "girdi";
    $name=$_POST['memberName'];
    $surname=$_POST['memberSurname'];
    $flightmoney=$_POST['flightMoney'];
    $email=$_POST['email'];
    $phoneNo=$_POST['phoneNo'];
    $isAdmin=$_POST["isAdmin"];
    $newMember= new Member($id,$name,$surname,NULL,$email,$phoneNo,NULL,$flightmoney,$isAdmin);
    $update=MemberManager::updateMemberById($newMember);
    if(!$update)
    {
         $errorMeesage= "Please control above information update operation is not successful";
    }
    else
    {
    	header("Location:adminMembers.php");
    }
}


require_once("adminHeader.php");
?>
<!DOCTYPE html>
<html lang="en">
<style>


</style>
<body style="background-color: rgb(207,207,207);">
	<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Member Update</h3>
			 			</div>
			 			<div class="panel-body">

			    		<form method="POST" action="<?php $_PHP_SELF ?>">

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					 <label for="memberName">Name</label>
			                         <input type="text" name="memberName" value="<?php echo htmlspecialchars ($name); ?>" id="memberName" minlength="2" maxlegth="30" onkeypress="return lettersOnly(event)" class="form-control input-sm" >
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				   <div class="form-group">
			    				   <label for="memberSurname">Surname</label>
			    				   <input type="text" name="memberSurname" id="memberSurname" value="<?php echo htmlspecialchars ($surname); ?>" minleght="2" maxleght="30" class="form-control input-sm" onkeypress="return lettersOnly(event)" >
			    				   </div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				   <div class="form-group">
			    				   <label for="flightMoney">Flight Money</label>
			    				   <input type="text" name="flightMoney" id="flightMoney" min="0"  value="<?php echo htmlspecialchars ($flightmoney); ?>" class="form-control input-sm" onkeypress="return isNumber(event)" >
			    				   </div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    			    <label for="email">Email Address</label>
			    				<input type="email" name="email" id="email" value="<?php echo htmlspecialchars ($email); ?>" class="form-control input-sm" >
			    			</div>

                            <div class="form-group">
                                <label for="phoneNo">Phone Number</label>
			    				<input type="text"  name="phoneNo" id="phoneNo" minlength="11" maxlength="11" value="<?php echo htmlspecialchars ($phone); ?>" class="form-control input-sm"  onkeypress="return isNumber(event)">
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					    <label for="password">Password</label>
			    						<input type="password" name="password" id="password"  class="form-control input-sm" >
			    					</div>
			    				</div>

			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    				
			    						 <label class="radio-inline">
                                         <input type="radio" name="isAdmin" <?php if (isset($isAdmin) && $isAdmin=="N") echo "checked";?> value="N"> 
                                           Normal
                                         </label>
                                         <label class="radio-inline">
                                         <input type="radio" name="isAdmin" <?php if (isset($isAdmin) && $isAdmin=="A") echo "checked";?> value="A"> 
                                          Admin
                                         </label>
			    					
			    						
			    					</div>
			    				</div>
			    			</div>
			    			<input type="submit" value="Update" class="btn btn-info btn-block">
			    				<?php 
									if(isset($errorMeesage)) 
									{
										echo "<br>" . "<span style='color: red;'>" . $errorMeesage . "</span>";
									}
								?>
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
</body>
<script type="text/javascript">     
function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if ( (charCode > 31 && charCode < 48) || charCode > 57) {
            return false;
        }
        return true;
    }
function lettersOnly(evt) {
       evt = (evt) ? evt : event;
       var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
          ((evt.which) ? evt.which : 0));
       if (charCode > 31 && (charCode < 65 || charCode > 90) &&
          (charCode < 97 || charCode > 122)) {

          return false;
       }
       return true;
     }
</script>
</html>
