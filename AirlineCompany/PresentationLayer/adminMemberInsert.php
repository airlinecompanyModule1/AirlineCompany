<?php

require_once("../LogicLayer/MemberManager.php");
#require_once("../LogicLayer/ControlManager.php");
$errorMeesage = "";
	
	if(isset($_POST["memberName"]) && isset($_POST["memberSurname"])&& isset($_POST["phoneNo"])&& isset($_POST["email"])&& isset($_POST["password"]) && isset($_POST["genderradio"])) 
    {
		    $password=trim($_POST["password"]);
        	$name = trim($_POST["memberName"]);
			$surname = trim($_POST["memberSurname"]);
			$phone=trim($_POST["phoneNo"]);
        	$email=trim($_POST["email"]);	
        	#$flag=ControlManager::controlRegistration($name,$surname,$phone);
        	
        		$result = MemberManager::insertNewMember($name, $surname,$email,$phone,$_POST["genderradio"],$password);
				if(!$result) 
				{
					$errorMeesage = "Yeni kullanıcı kaydı başarısız!";
				}
        	    else
        	    {
        	    	header("Location:adminMembers.php");
        	    }
       

	}
	require_once("adminHeader.php");
    require_once("contains.php");
?>
<!DOCTYPE html>
<html lang="tr">
<style>


</style>
<body style="background-color: rgb(207,207,207);">
	<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">New Member</h3>
			 			</div>
			 			<div class="panel-body">

			    		<form method="POST" action="<?php $_PHP_SELF ?>">

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                         <input type="text" name="memberName"  id="memberName" minlength="2" maxlegth="30" onkeypress="return lettersOnly(event)" class="form-control input-sm" placeholder="Name">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				   <div class="form-group">
			    				   <input type="text" name="memberSurname" id="memberSurname" minleght="2" maxleght="30" class="form-control input-sm" onkeypress="return lettersOnly(event)" placeholder="Surname">
			    				   </div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div>

                            <div class="form-group">
			    				<input type="text"  name="phoneNo" id="phoneNo" minlength="11" maxlength="11" class="form-control input-sm" placeholder="PhoneNo" onkeypress="return isNumber(event)">
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
			    					</div>
			    				</div>

			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    				
			    						 <label class="radio-inline">
                                         <input type="radio" name="genderradio" value="F"> 
                                          Female
                                         </label>
                                         <label class="radio-inline">
                                         <input type="radio" name="genderradio" value="M"> 
                                          Male
                                         </label>
			    					
			    						
			    					</div>
			    				</div>
			    			</div>
			    			<input type="submit" value="Insert" class="btn btn-info btn-block">
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