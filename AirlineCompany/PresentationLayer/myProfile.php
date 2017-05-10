<?php
  
    session_start();
	$memberId=null;
	$errorMeesage=null;
	 require_once("../LogicLayer/MemberManager.php");
	 require_once("memberHeader.php");
	if(isset($_SESSION['loginMember']))
	{
       
        $memberId=$_SESSION['loginMember'];
        #echo "id: ".$memberId;
        $member=MemberManager::getMemberById($memberId);
        $memberName=$member->getName();
        $memberSurname=$member->getSurname();
        $memberEmail=$member->getEmail();
        $memberPhone=$member->getPhoneNumber();
        $memberMoney=$member->getFlightMoney();

	}
    if(isset($_POST["memberName"]) && isset($_POST["memberSurname"]) && isset($_POST["email"])&&isset($_POST["phoneNo"]))
    {
          $updatedMember = new Member($memberId,$_POST["memberName"], $_POST["memberSurname"], null, $_POST["email"], $_POST["phoneNo"], null, null,null);

          $result=MemberManager::updateMemberByIdMember($updatedMember);
          if(!$result)
          {
                $errorMeesage="Update operation is not successfull !!!";
          } 
          else
          {

             $memberId=$_SESSION['loginMember'];
       		 $member=MemberManager::getMemberById($memberId);
        	 $memberName=$member->getName();
             $memberSurname=$member->getSurname();
             $memberEmail=$member->getEmail();
             $memberPhone=$member->getPhoneNumber();
             $memberMoney=$member->getFlightMoney();

          	 header("myProfile.php");
          }
    }

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
			    		<h3 class="panel-title">My Profile</h3>
			 			</div>
			 			<div class="panel-body">

			    		<form method="POST" action="<?php $_PHP_SELF ?>" id="myform">

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					 <label for="memberName">Name</label>
			                         <input type="text" name="memberName" value="<?php echo htmlspecialchars ($memberName); ?>" id="memberName" minlength="2" maxlegth="30" onkeypress="return lettersOnly(event)" class="form-control input-sm" disabled>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				   <div class="form-group">
			    				   <label for="memberSurname">Surname</label>
			    				   <input type="text" name="memberSurname" id="memberSurname" value="<?php echo htmlspecialchars ($memberSurname); ?>" minleght="2" maxleght="30" class="form-control input-sm" onkeypress="return lettersOnly(event)" disabled>
			    				   </div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				   <div class="form-group">
			    				   <label for="flightMoney">Flight Money</label>
			    				   <input type="text" name="flightMoney" id="flightMoney" min="0"  value="<?php echo htmlspecialchars ($memberMoney); ?>" class="form-control input-sm" onkeypress="return isNumber(event)" disabled>
			    				   </div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    			    <label for="email">Email Address</label>
			    				<input type="email" name="email" id="email" value="<?php echo htmlspecialchars ($memberEmail); ?>" class="form-control input-sm" disabled>
			    			</div>

                            <div class="form-group">
                                <label for="phoneNo">Phone Number</label>
			    				<input type="text"  name="phoneNo" id="phoneNo" minlength="11" maxlength="11" value="<?php echo htmlspecialchars ($memberPhone); ?>" class="form-control input-sm"  onkeypress="return isNumber(event)" disabled>
			    			</div>

			    			<input type="button" value="Update" class="btn btn-info btn-block" onclick="updateFunction()" id="bttnupdate">
			    			<input type="button" value="Save" class="btn btn-info btn-block" id="bttnsave" style="display: none" onclick="saveFunction()">
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

     function updateFunction()
     {
     	document.getElementById('bttnupdate').style.display="none";
     	document.getElementById('bttnsave').style.display="block";
        document.getElementById('memberName').disabled=false;
        document.getElementById('memberSurname').disabled=false;
        document.getElementById('email').disabled=false;
        document.getElementById('phoneNo').disabled=false;
     }
     function saveFunction()
     {
     	document.getElementById('myform').submit();
        
     }
</script>
</html>