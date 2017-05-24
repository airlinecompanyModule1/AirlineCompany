<?php
require_once("contains.php");
require_once("../LogicLayer/TicketManager.php");
require_once("adminHeader.php");

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
<h2 style="text-align: center">Tickets List</h2>
    <div class="row  custyle">
    <form method="POST" action="<?php $_PHP_SELF ?>" id="myform">
    <table class="table table-striped custab table-bordered" id="tbl">
    <thead>
    
        <tr>
			<th>ID</th>
			<th>PassengerId</th>
			<th>Name</th>
			<th>Surname</th>
			<th>TC</th>
			<th>ConnectionId</th>
			<th>Phone</th>
			<th>Email</th>
			<th>FlightId</th>	
			<th>PNR</th>
			<th>Price</th>
			<th>From</th>
			<th>To</th>
			<th>Date</th>
			<th>Time</th>
        </tr>
    </thead>
            <?php 
				$ticketList = TicketManager::getAllTickets();
							
				for($i = 0; $i < count($ticketList); $i++) {
                  
                 $headers = array("Content-Type: application/json");
        // can be tested by web browser, http://md5.jsontest.com/?text=hello%20world
	       			$fields = array("FlightId" => "1");
       
			        $url = "http://localhost:8080/AirlineCompany/LogicLayer/WSFlight.php/?" . http_build_query($fields);
			        $ch = curl_init();
			        
			        curl_setopt($ch, CURLOPT_URL, $url);
			        curl_setopt($ch, CURLOPT_POST, false);
			        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			        
			        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
			      
			        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			        
			        // execute request
			        $result = curl_exec($ch);
			        $obj = json_decode($result, true);
			        curl_close($ch);
			        $from=$obj["information"][0]["from"];
			        $to=$obj["information"][0]["to"];
			        $date=$obj["information"][0]["date"];
			        $time=$obj["information"][0]["time"];
			        
			 ?>
				<tr>
					<td><?php echo $ticketList[$i]->getID(); ?></td>
					<td><?php echo $ticketList[$i]->getPassengerId(); ?></td>
					<td><?php echo $ticketList[$i]->getpName() ?></td>
					<td><?php echo $ticketList[$i]->getpSurname(); ?></td>
					<td><?php echo $ticketList[$i]->getpTC() ?></td>
					<td><?php echo $ticketList[$i]->getConnectionId(); ?></td>
					<td><?php echo $ticketList[$i]->getPhone() ?></td>
					<td><?php echo $ticketList[$i]->getEmail() ?></td>
					<td><?php echo $ticketList[$i]->getFlightId(); ?></td>
					<td><?php echo $ticketList[$i]->getPNR(); ?></td>
					<td><?php echo $ticketList[$i]->getPrice(); ?></td>
					<td><?php echo $from ?></td>
					<td><?php echo $to?></td>
					<td><?php echo $date ?></td>
					<td><?php echo $time?></td>
				
				</tr>
				<?php
				}
			?>
    </table>
  	
	
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