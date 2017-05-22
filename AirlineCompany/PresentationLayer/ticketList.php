<?php
require_once("contains.php");
require_once("header.php");
require_once("../LogicLayer/TicketInformation.php");
$json_string = 'tickets.json';
$errormessage="";


//result post ile gelecek search ekranından sonra burada decode edilip gerisi aynı

$jsondata = file_get_contents($json_string);
$obj = json_decode($jsondata,true);
#print_r($obj);
#echo "content:".$obj["Tickets"][0]["id"];
#echo "count".count($obj["Tickets2"]);
#echo "type:".$obj["type"];
$flightType=$obj["type"];
#echo "elma";
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
    <table class="table table-striped custab" id="tblGoing">
    <thead>
    
        <tr>
			<th>ID</th>
			<th>From</th>
			<th>To</th>
			<th>Time</th>
			<th>Price</th>	
            <th>Select</th>
        </tr>
    </thead>
            <?php			
				for($i = 0; $i < count($obj["TicketGoing"]); $i++) {
			 ?>
				<tr>
					<td><?php echo $obj["TicketGoing"][$i]["id"] ?></td>
					<td><?php echo $obj["TicketGoing"][$i]["from"]?></td>
					<td><?php echo $obj["TicketGoing"][$i]["to"] ?></td>
					<td><?php echo $obj["TicketGoing"][$i]["time"] ?></td>
					<td><?php echo $obj["TicketGoing"][$i]["price"] ?></td>
					<td> <input type="radio" name="goingradio" onclick="selectGoingFunction(this)"> 
					</td>
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
	<input id="flagGoing" type="text" name="flagGoing" style="display: none">
    </form>
    <form method="POST" action="<?php $_PHP_SELF ?>" id="myform2" style="display: none">
    <table class="table table-striped custab" id="tblReturn">
    <thead>
    
        <tr>
			<th>ID</th>
			<th>From</th>
			<th>To</th>
			<th>Time</th>
			<th>Price</th>	
            <th>Select</th>
        </tr>
    </thead>
            <?php			
				for($i = 0; $i < count($obj["TicketGoing"]); $i++) {
			 ?>
				<tr>
					<td><?php echo $obj["TicketGoing"][$i]["id"] ?></td>
					<td><?php echo $obj["TicketGoing"][$i]["from"]?></td>
					<td><?php echo $obj["TicketGoing"][$i]["to"] ?></td>
					<td><?php echo $obj["TicketGoing"][$i]["time"] ?></td>
					<td><?php echo $obj["TicketGoing"][$i]["price"] ?></td>
					<td><input type="radio" name="returnradio" onclick="selectReturnFunction(this)"></td>
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
    </form>
    <div style="margin-left: 480px; margin-bottom: 100px">
    <button type="button" id="search-flights" class="btn btn-danger" > Select</button>
    </div>
    </div>
  
		
		
</div>

<script type="text/javascript">
	

    var goingId;
    var goingFrom;
    var goingTo;
    var goingTime;
    var goingPrice;

    var returnId;
    var returnFrom;
    var returnTo;
    var returnTime;
    var returnPrice;
 
	function selectGoingFunction(row)
	{
         /*document.getElementById('flagGoing').style.display="block";*/
		 var i=row.parentNode.parentNode.rowIndex;
         var x=document.getElementById('tblGoing');
         // deep clone the targeted row
         goingId = x.rows[i].cells[0].innerHTML;
         goingFrom=x.rows[i].cells[1].innerHTML;
         goingTo=x.rows[i].cells[2].innerHTML;
         goingTime=x.rows[i].cells[3].innerHTML;
         goingPrice=x.rows[i].cells[4].innerHTML;
         var type= '<?php echo $flightType ?>';
         if(type=="round trip")
         {

         	document.getElementById('myform2').style.display="block";
          /*window.location.href="passergerInfo.php?goID= + "+goingId+"goFrom=+"+goingFrom+"goTo=+"+goingTo+"goTime=+"+goingTime+"goPrice=+"+goPrice;*/
         }
         document.getElementById('flagGoing').value=goingId;
         document.getElementById('flagGoing').style.display="block";
        
	}
     function selectReturnFunction(row)
	{
		 var i=row.parentNode.parentNode.rowIndex;
         var x=document.getElementById('tblReturn');
         // deep clone the targeted row
         returnId = x.rows[i].cells[0].innerHTML;
         returnFrom=x.rows[i].cells[1].innerHTML;
         returnTo=x.rows[i].cells[2].innerHTML;
         returnTime=x.rows[i].cells[3].innerHTML;
         returnPrice=x.rows[i].cells[4].innerHTML;
         var type= '<?php echo $flightType ?>';

        
       window.location.href="passergerInfo.php.php?goID= + "+goingId+"goFrom=+"+goingFrom+"goTo=+"+goingTo+"goTime=+"+goingTime+"goPrice=+"+goPrice+"returnID= + "+returnId+"returnFrom=+"+returnFrom+"returnTo=+"+returnTo+"returnTime=+"+returnTime+"returnPrice=+"+returnPrice;
         

        
	}

</script>
</body>
</html>