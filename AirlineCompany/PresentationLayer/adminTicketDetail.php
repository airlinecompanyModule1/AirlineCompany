<?php


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
			    		<h3 class="panel-title">Passenger Information</h3>
			 			</div>
			 			<div class="panel-body">

			    		<form method="POST" action="<?php $_PHP_SELF ?>" id="passengerForm">

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					 <label for="passName">PassengerName</label>
			                         <input type="text" name="passName" value="<?php echo htmlspecialchars ($passName); ?>" id="passName" minlength="2" maxlegth="30" onkeypress="return lettersOnly(event)" class="form-control input-sm" disabled>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				   <div class="form-group">
			    				   <label for="passSurname">Surname</label>
			    				   <input type="text" name="passSurname" id="passSurname" value="<?php echo htmlspecialchars ($passSurname); ?>" minleght="2" maxleght="30" class="form-control input-sm" onkeypress="return lettersOnly(event)" disabled>
			    				   </div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				   <div class="form-group">
			    				   <label for="brithdate">Brithdate</label>
			    				    <input type="date" name="brithdate" id="brithdate"  class="form-control input-sm"      value="<?php echo htmlspecialchars ($brithdate); ?>"disabled>
			    				   </div>
			    				</div>
			    			</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    				   <div class="form-group">
			    				   <label for="passTc">Surname</label>
			    				   <input type="text" name="passTc" id="passTc" value="<?php echo htmlspecialchars ($passTc); ?>" minleght="11" maxleght="11" class="form-control input-sm" onkeypress="return isNumber(event)" disabled>
			    				   </div
			    			<input type="button" value="Update" class="btn btn-info btn-block" onclick="passUpdateFunction()" id="passUpdate">
			    			<input type="button" value="Save" class="btn btn-info btn-block" id="passSave" style="display: none" onclick="passSaveFunction()">
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

     function passUpdateFunction()
     {
     	document.getElementById('passUpdate').style.display="none";
     	document.getElementById('passSave').style.display="block";
        document.getElementById('passName').disabled=false;
        document.getElementById('passSurname').disabled=false;
        document.getElementById('brithdate').disabled=false;
        document.getElementById('phoneNo').disabled=false;
     }
     function saveFunction()
     {
     	document.getElementById('myform').submit();
        
     }
</script>
</html>
