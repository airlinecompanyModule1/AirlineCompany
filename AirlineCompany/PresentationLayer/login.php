<?php

require_once("../LogicLayer/MemberManager.php");
#require_once("../LogicLayer/ControlManager.php");
$errorMeesage = "";
	
	if( isset($_POST["phoneNo"])&& isset($_POST["password"])) 
	{

        	$password = $_POST["password"];
			$phone=$_POST["phoneNo"];

        	#$flag=ControlManager::controlRegistration($name,$surname,$phone);
        	
        		$result = MemberManager::controlLogin($phone,$password);
				if($result->getID()!=NULL)
				{
					if($result->getIsAdmin()=="N")
					{
						header("Location:../index.php");
					}
					else
					{
						header("Location:adminHeader.php");
					}
                   	#$errorMeesage="OLDU";
                   	session_start();
					$_SESSION['activeUser'] = $result->getID();
				}
       			 else
        		{
        			$errorMeesage="Please control phone number and password!!!";
        		}

		
	}
	#header2 olacak session
	require_once("header.php");
    require_once("contains.php");
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
			    		<h3 class="panel-title">Log In</h3>
			 			</div>
			 			<div class="panel-body">

			    		<form method="POST" action="<?php $_PHP_SELF ?>">
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

			    			<input type="submit" value="Login" class="btn btn-info btn-block">
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
</script>
</html>