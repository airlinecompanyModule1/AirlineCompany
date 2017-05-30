<?php
require_once("contains.php");
require_once("../LogicLayer/PassengerManager.php");
require_once("adminHeader.php");
$errormessage="";

if(isset($_POST["passName"]) && isset($_POST["passSurname"]) && isset($_POST["passTC"]) && isset($_POST["updatedId"])&& isset($_POST["gender"]) && isset($_POST["brithdate"]))
{
	$id=$_POST["updatedId"];
	$name=$_POST["passName"];
	$surname=$_POST["passSurname"];
	$tc=$_POST["passTC"];
	$gender=$_POST["gender"];
	$brithdate=$_POST["brithdate"];
	$updatedPassenger=new Passenger($id,$name,$surname,$gender,$brithdate,$tc);
	$result=PassengerManager::updatePassenger($updatedPassenger);
	//$result=0;
	if(!$result)
    {
      echo "<script type='text/javascript'>alert('Update operation is not successfull !!! Try again...');</script>";
    }
}
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
    <div class="row  custyle" >
    <form method="POST" action="<?php $_PHP_SELF ?>" id="myform">
    <h2 style="text-align: center">Passengers List</h2>
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
					<td><input type="button" class="btn btn-info btn-xs"   value="Update" data-toggle="modal" onclick="updateFunction(this)" id=<?php echo "updatebttn".$passList[$i]->getID()?>></td>
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
	<input id="updatedId" type="text" name="updatedId" style="display: none">

  <!-- Trigger the modal with a button -->
  

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Passenger Panel</h4>
        </div>
        <div class="modal-body">
         <div class="form-group">
		<label for="passName">Name</label>
		<input type="text" name="passName" id="passName" minlength="2" maxlength="30" onkeypress="return lettersOnly(event)" class="form-control input-sm" >
		
		<label for="passSurname">Surname</label>
		<input type="text" name="passSurname" id="passSurname" minlength="2" maxlength="30" onkeypress="return lettersOnly(event)" class="form-control input-sm" >
	
		<label for="passTC">Tc</label>
		<input type="text" name="passTC" id="passTC" minlength="11" maxlength="11" onkeypress="return isNumber(event)" class="form-control input-sm" >
        <label><span class="glyphicon glyphicon-calendar"></span> Brithdate
         <input type="date" name="brithdate" id="brithdate"  class="form-control input-sm" placeholder="Brithdate">
                       
        </label>
        <br>
		<label class="radio-inline">
            <input type="radio" name="gender" value="M" id="genderM"> 
              Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="gender"  value="F" id="genderF"> 
                Female
        </label>
			    					
		</div>
        </div>
        <div class="modal-footer">
        <input type="button" class="btn btn-info btn-xs"   value="Save" data-toggle="modal" onclick="saveFunction()">
         
        </div>
      </div>
      
    </div>
  </div>
    </form>
    </div>
</div>
<script type="text/javascript">
var tbl=document.getElementById('tbl');
for (var i = 1; i < tbl.rows.length; i++) 
{
    tbl.rows[i].style.cursor = "pointer";
     tbl.rows[i].onmousemove = function () { this.style.backgroundColor = "#008B8B"; this.style.color = "#FFFFFF"; };
    tbl.rows[i].onmouseout = function () { this.style.backgroundColor = ""; this.style.color = ""; };
}



function updateFunction(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    var x=document.getElementById('tbl');
       // deep clone the targeted row
    var id = x.rows[i].cells[0].innerHTML;
    var name=x.rows[i].cells[1].innerHTML;
    var surname=x.rows[i].cells[2].innerHTML;
    var TC=x.rows[i].cells[3].innerHTML;
    var brithdate=x.rows[i].cells[4].innerHTML;
    var gender=x.rows[i].cells[5].innerHTML;
    document.getElementById('passName').value=name;
    document.getElementById('passSurname').value=surname;
    document.getElementById('passTC').value=TC;
    document.getElementById('brithdate').value=brithdate;
    document.getElementById('updatedId').value=id;
    if(gender=="M")
    {
       document.getElementById('genderM').checked=true;
    	
    }
    else if(gender=="F")
    {
		document.getElementById('genderF').checked=true;
    	
    }
    //alert(brithdate);
    var bttn="#updatebttn"+id;
 	$(bttn).attr('data-target','#myModal');
    

}
function saveFunction()
{
	var tc= document.getElementById('passTC').value;
	var lenName=document.getElementById('passName').value.length;
	var lenSurname=document.getElementById('passSurname').value.length;
	var lenbdate=document.getElementById('brithdate').value.length;
	var len=tc.length;
  

	
	if(lenbdate==0 || lenName==0 || lenSurname==0)
	{
		alert("Fields must not be empty !!!");
	}
	else
	{
		  document.getElementById('myform').submit();
	}
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