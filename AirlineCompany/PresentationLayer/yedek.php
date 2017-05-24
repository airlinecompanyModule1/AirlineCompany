<?php
require_once("contains.php");
require_once("../LogicLayer/PassengerManager.php");
require_once("adminHeader.php");
$errormessage="";

?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
	.custab{
    border: 1px solid #ccc;
    padding: 5px;
    margin: 5% 0;
    box-shadow: 3px 3px 2px #ccc;
    transition: 0.5s;
    }
.custab:hover{
    box-shadow: 3px 3px 0px transparent;
    transition: 0.5s;
    }
</style>
<body>
<div class="container">
    <div class="row col-md-6  custyle" >
    <form method="POST" action="<?php $_PHP_SELF ?>" id="myform">
    <table class="table table-striped custab" id="tbl">
    <thead>
    
        <tr>
			<th>ID</th>
			<th>Name</th>
			<th>Surname</th>
			<th>TC</th>
			<th>Brithdate</th>	
			<th>Gender</th>
            <th>Update</th>
        </tr>
    </thead>
            <?php 
				$passList = PassengerManager::getAllPassengers();
							
				for($i = 0; $i < count($passList); $i++) {
			 ?>
				<tr>
					<td><?php echo $passList[$i]->getID(); ?></td>
					<td><?php echo $passList[$i]->getName(); ?></td>
					<td><?php echo $passList[$i]->getSurname(); ?></td>
					<td><?php echo $passList[$i]->getTC(); ?></td>
					<td><?php echo $passList[$i]->getBrithdate(); ?></td>
					<td><?php echo $passList[$i]->getGender(); ?></td>
					<td><input type="button" class="btn btn-info btn-xs"   value="Update" onclick="updateFunction(this)"></td>
				</tr>
				<?php
				}
			?>
    </table>
  	<?php 
		if(isset($errormessage)) 
		{
			echo "<br>" . "<span style='color: red;'>" . $errormessage . "</span>";
		}

	?>
	<input id="flag" type="text" name="flag" style="display: none">
<h2>Basic Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
    </form>
    </div>
    <div class="row col-md-6  custyle" >
    <form method="POST" action="<?php $_PHP_SELF ?>" id="formUpdate" >
     <div class="col-xs-6 col-sm-6 col-md-6">
      <label>Passenger Update Panel</label>
		<div class="form-group">
		<label for="passName">Name</label>
		<input type="text" name="passName" id="passName" minlength="2" maxlegth="30" onkeypress="return lettersOnly(event)" class="form-control input-sm" >
		
		<label for="passSurname">Surname</label>
		<input type="text" name="passSurname" id="passSurname" minlength="2" maxlegth="30" onkeypress="return lettersOnly(event)" class="form-control input-sm" >
	
		<label for="passTC">Tc</label>
		<input type="text" name="passTC" id="passTC" minlength="11" maxlegth="11" onkeypress="return isNumber(event)" class="form-control input-sm" >
        <label><span class="glyphicon glyphicon-calendar"></span> Brithdate
         <input type="date" name="brithdate" id="brithdate"  class="form-control input-sm" placeholder="Brithdate">
                       
        </label>
        <br>
		<label class="radio-inline">
            <input type="radio" name="gender" value="M"> 
              Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="gender"  value="F"> 
                Female
        </label>
			    					
		</div>
		</div>
     </div>
	<input id="flag" type="text" name="flag" style="display: none">
    </form>
    </div>
</div>
<script type="text/javascript">
function updateFunction(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    var x=document.getElementById('tbl');
       // deep clone the targeted row
    var new_row = x.rows[i].cells[0].innerHTML;
	window.location.href="adminPassengerUpdate.php?ID= + "+new_row;;

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
function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if ( (charCode > 31 && charCode < 48) || charCode > 57) {
            return false;
        }
        return true;
    }

</script>
</body>
</html>