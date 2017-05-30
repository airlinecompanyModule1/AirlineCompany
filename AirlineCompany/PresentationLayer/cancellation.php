<?php
require_once("../PresentationLayer/header.php");
?>


<!DOCTYPE html>
<html> 
	<head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>Web Services</title>
		<style type="text/css">
			#dvMain {
			width: 500px;
			margin-left: auto;
			margin-right: auto;
			padding: 15px;
			background-color: #FAFAFA;
			}
			.dvInner {
			border: 1px solid #ddd;
			padding: 10px;
			margin-bottom: 10px;
			}
			td {
			padding: 4px;
			}
			#divCallResult {
			border: 1px solid #ddd;
			padding: 10px;
			}
		</style>
	</head>
	<body> 
		<div id="dvMain">
			<div class="dvInner">
				<h2>Ticket Cancellation</h2>
				<form  method="POST" action="<?php $_PHP_SELF ?>"> 
					<table>
						<tr>
							<td>
								PNR No:
							</td>
							<td>
								<input type="text" name="PNRTXT" id="PNRTXT" title="Örn: TU" required />
							</td>
						</tr>
					
						
						<tr>
							<td>
								<input type="button" value="OK" id="bttnpnr"/>
							</td>
							
						</tr>
					</table>
				</form> 
			</div>
			
			<div class="dvInner">
				
				<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
				
				
				<h3>Result:</h3>
				<div id="divCallResult">
					Please call the service
				</div>
			</div>
			
		</div>
		<script>
			// JQuery 
			$(document).ready(function() { // when DOM is ready, this will be executed
			
			$("#bttnpnr").click(function(e) { // click event for "btnCallSrvc"
				
				var cntrPNR = $("#PNRTXT").val(); // get country code
				if(cntrPNR == "") {
					alert("Enter PNR!");
					$("#PNRTXT").focus();
					return;
				}
				
				
				$.ajax({ // start an ajax POST 
					type	: "get",
					url		: "../LogicLayer/WSTicketCancellation.php",
					data	:  { 
						"PNR"	: cntrPNR, 
						
					},
					success : function(reply) { // when ajax executed successfully
						console.log(reply);
					
						$("#divCallResult").html( JSON.stringify(reply) );
					
					},
					error   : function(err) { // some unknown error happened
						console.log(err);
						alert(" There is an error! Please try again. " + err); 
					}
				});
				
			});
			
		});
		</script>
	</body> 
</html>
