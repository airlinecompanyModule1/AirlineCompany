<?php
require_once("contains.php");
require_once("../LogicLayer/MemberManager.php");
require_once("adminHeader.php");
$errormessage="";
#if(isset($_REQUEST['Del']))
#{

	#$control=$_REQUEST["Del"];
	#$control=0;
	#if($control="0")
	#{
     #  $errormessage="Delete operation is not successfull";
	#}
	#echo $errormessage;
	#$_REQUEST["Del"]="";
#}
if(isset($_POST["flag"]))
{
	$id=$_POST["flag"];
    $control=MemberManager::deleteMemberById($id);
    
    if(!$control)
    {
         $errormessage="Delete operation is not successfull!!!";
         #echo $id;
    }

}
?>
<!DOCTYPE html>
<html>
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
    <div class="row col-md-6 col-md-offset-1 custyle">
    <form method="POST" action="<?php $_PHP_SELF ?>" id="myform">
    <div class="row">
	
			<div class="col-xs-6 col-sm-6 col-md-6">
            <input type="button" class="btn btn-danger btn-xs" name="bttninsert" id="bttninsert"  value="New Member" onclick="insertFunction()" >
           
           </div>
    </div>
    <table class="table table-striped custab" id="tbl">
    <thead>
    
        <tr>
			<th>ID</th>
			<th>IsAdmin</th>
			<th>Name</th>
			<th>Surname</th>
			<th>Email</th>	
			<th>PhoneNo</th>
			<th>Password</th>
			<th>FlightMoney</th>
			<th>Gender</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
            <?php 
				$memberList = MemberManager::getAllMembers();
							
				for($i = 0; $i < count($memberList); $i++) {
			 ?>
				<tr>
					<td><?php echo $memberList[$i]->getID(); ?></td>
					<td><?php echo $memberList[$i]->getIsAdmin(); ?></td>
					<td><?php echo $memberList[$i]->getName(); ?></td>
					<td><?php echo $memberList[$i]->getSurname(); ?></td>
					<td><?php echo $memberList[$i]->getEmail(); ?></td>
					<td><?php echo $memberList[$i]->getPhoneNumber(); ?></td>
					<td><?php echo $memberList[$i]->getPassword(); ?></td>
					<td><?php echo $memberList[$i]->getFlightMoney(); ?></td>
					<td><?php echo $memberList[$i]->getGender(); ?></td>
					<td><input type="button" class="btn btn-info btn-xs"   value="Update" onclick="updateFunction(this)"></td>
					<td><input type="button" class="btn btn-danger btn-xs" name="delete" id="bttndelete"  value="Delete" onclick="deleteFunction(this)"></td>
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
	window.location.href="adminMemberUpdate.php?ID= + "+new_row;;

}
function deleteFunction(row)
{
	var i=row.parentNode.parentNode.rowIndex;
    var x=document.getElementById('tbl');
       // deep clone the targeted row
    var new_row = x.rows[i].cells[0].innerHTML;
        
    document.getElementById('flag').value=new_row;
     
    document.getElementById('myform').submit();
}
function insertFunction()
{
	window.location.href="adminMemberInsert.php";
}
</script>
</body>
</html>