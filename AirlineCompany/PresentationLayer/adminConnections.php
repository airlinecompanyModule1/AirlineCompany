<?php
require_once("contains.php");
require_once("../LogicLayer/ConnectionManager.php");
require_once("adminHeader.php");
$errormessage="";
if(isset($_POST["conName"]) && isset($_POST["conSurname"]) && isset($_POST["conPhone"]) && isset($_POST["updatedId"])&& isset($_POST["conEmail"]))
{
	$id=$_POST["updatedId"];
	$name=$_POST["conName"];
	$surname=$_POST["conSurname"];
	$phone=$_POST["conPhone"];
	$email=$_POST["conEmail"];
	
	$updatedConnection=new Connection($id,$name,$surname,$phone,$email);
	$result=ConnectionManager::updateConnection($updatedConnection);
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
    <h2 style="text-align: center">Connections List</h2>
    <table class="table table-striped custab" id="tbl">
    <thead>
    
        <tr>
			<th>ID</th>
			<th>Name</th>
			<th>Surname</th>
			<th>Phone</th>
			<th>Email</th>	
            <th>Update</th>
        </tr>
    </thead>
            <?php 
				$conList = ConnectionManager::getAllConnections();
							
				for($i = 0; $i < count($conList); $i++) {
			 ?>
				<tr>
					<td><?php echo $conList[$i]->getID(); ?></td>
					<td><?php echo $conList[$i]->getName(); ?></td>
					<td><?php echo $conList[$i]->getSurname(); ?></td>
				    <td><?php echo $conList[$i]->getPhone(); ?></td>
				    <td><?php echo $conList[$i]->getEmail(); ?></td>
					<td><input type="button" class="btn btn-info btn-xs"   value="Update" data-toggle="modal" onclick="updateFunction(this)" id=<?php echo "updatebttn".$conList[$i]->getID()?>></td>
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
          <h4 class="modal-title">Update Connection Panel</h4>
        </div>
        <div class="modal-body">
         <div class="form-group">
		<label for="conName">Name</label>
		<input type="text" name="conName" id="conName" minlength="2" maxlength="30" onkeypress="return lettersOnly(event)" class="form-control input-sm" >
		
		<label for="conSurname">Surname</label>
		<input type="text" name="conSurname" id="conSurname" minlength="2" maxlength="30" onkeypress="return lettersOnly(event)" class="form-control input-sm" >
	
		<label for="conPhone">Phone</label>
		<input type="text" name="conPhone" id="conPhone"  onkeypress="return isNumber(event)" minlength="11" maxlength="11" class="form-control input-sm" >
       
         <label for="conEmail">Email</label>
		<input type="email" name="conEmail" id="conEmail"  class="form-control input-sm" >
	    				
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
    var phone=x.rows[i].cells[3].innerHTML;
    var email=x.rows[i].cells[4].innerHTML;
 
    document.getElementById('conName').value=name;
    document.getElementById('conSurname').value=surname;
    document.getElementById('conPhone').value=phone;
    document.getElementById('conEmail').value=email;
    document.getElementById('updatedId').value=id;
   
    //alert(brithdate);
  var bttn="#updatebttn"+id;
  $(bttn).attr('data-target','#myModal');
    

}
function saveFunction()
{
	var phone= document.getElementById('conPhone').value;
	var lenName=document.getElementById('conName').value.length;
	var lenSurname=document.getElementById('conSurname').value.length;
    var lenEmail=document.getElementById('conEmail').value.length;
	var len=phone.length;
  

	if(len!=11)
	{
		alert("Length of Phone must be 11");
	}
	else if(lenName==0 || lenSurname==0)
	{
		alert("Fields must not be empty !!!");
	}
	else if(len==0 && lenEmail==0)
	{
		alert("Phone or Email must be full");
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