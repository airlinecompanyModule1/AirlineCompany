<?php
 session_start();
 require_once("contains.php");
 
  //require_once("header.php");


$passArray=array();
$passCount=0;
$errorMeesage="";
if(isset($_SESSION['selAdult']) && isset($_SESSION['selChild']) && isset($_SESSION['selInfant']))
{
	$countAdult=$_SESSION['selAdult'];
	$countChild=$_SESSION['selChild'];
	$countInfant=$_SESSION['selInfant'];
	for($i=1;$i<=$countAdult;$i++)
	{
		array_push($passArray, $i.".Adult");
	}
	for($i=1;$i<=$countChild;$i++)
	{
		array_push($passArray, $i.".Child");
	}
	for($i=1;$i<=$countInfant;$i++)
	{
		array_push($passArray, $i.".Infant");
	}
	$passCount=count($passArray);
	
	//echo $_SESSION["totalPrice"];
}
    $tc="";
    $flag="TRUE";
	for($i=0;$i<count($passArray);$i++)
	{


		if(isset($_POST[$i."Name"]) && isset($_POST[$i."Surname"]) && isset($_POST[$i."genderradio"]) && isset($_POST[$i."Birthdate"]))
		{
			//$flag="TRUE";
			//echo $_POST[$i."Name"];
			$_SESSION[$i."Name"] = $_POST[$i."Name"]; 
			$_SESSION[$i."Surname"] = $_POST[$i."Surname"]; 
			$_SESSION[$i."Gender"] = $_POST[$i."genderradio"]; 
			$_SESSION[$i."Birthdate"] = $_POST[$i."Birthdate"]; 
		    if(isset($_POST[$i."tc"]))
		    {
		    	$tc=$_POST[$i."tc"];
		    }
			$_SESSION[$i."tc"] = $tc; 
			if($_SESSION[$i."tc"]!="")
			{
				$headers = array("Content-Type: application/json");
        // can be tested by web browser, http://md5.jsontest.com/?text=hello%20world
       		   $fields = array("TCNumber" => $_SESSION[$i."tc"]);
		 		// http://civilregistry.webege.com/validatePerson.php/?TCNumber=12345678900
		        //$url = "http://192.168.43.249:81/TheLast/persons.php/?" . http_build_query($fields);
		 	 	$url = "http://civilregistry.webege.com/validatePerson.php/?" . http_build_query($fields);
		         //$con='http://localhost:8080/AirlineCompany/LogicLayer/WSPnrValidation.php/?PNR='.$original_text;
		        // $jsondata=file_get_contents($url);
		        // initialize a cURL session
		        $ch = curl_init();
		        
		        // set the url, number of GET vars, GET data
		        curl_setopt($ch, CURLOPT_URL, $url);
		        curl_setopt($ch, CURLOPT_POST, false);
		        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		        // TRUE to return the transfer as a string of the return value of curl_exec() 
		        // instead of outputting it out directly
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		        // FALSE to stop cURL from verifying the peer's certificate.
		        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		        
		        // execute request
		        $result = curl_exec($ch);
		        $obj = json_decode($result, true);
		       
		        curl_close($ch);
		        if($obj["persons"]=="FALSE")
		        {
		        	//echo $obj["persons"];
		        	 $flag=$obj["persons"];
		        }
		       
		    
		        //$flag="TRUE";

				
			}

			//echo $_SESSION[$i."Name"];

			
		}
	}
	if(isset($_POST["conName"]) && isset($_POST["conSurname"])&&isset($_POST["conPhone"])&&isset($_POST["conEmail"]))
	{
		
		$_SESSION["conName"]=$_POST["conName"];
		$_SESSION["conSurname"]=$_POST["conSurname"];
		$_SESSION["conPhone"]=$_POST["conPhone"];
		$_SESSION["conEmail"]=$_POST["conEmail"];
		$_SESSION["totalPass"]=$passCount;
	}
	if($flag=="TRUE" && isset($_POST["0Name"]))
	{
		header("Location:http://localhost:8080/AirlineCompany/PresentationLayer/paymentInfo.php");
	}
	if($flag=="FALSE" && isset($_POST["0Name"]))
	{
		$errorMeesage="Please control TC fields !!!";
	}
	
?>
<!DOCTYPE html>
<html lang="tr">
<head>

  <title>PAIRLINES</title>
  <link rel="shortcut icon" href="air2.png" />
</head>
<body style="background-image: url('background.jpg');" >
<div style="float: right; margin-right: 250px">
	<img src="pass.jpg" >	
	<a href="http://localhost:8080/AirlineCompany/PresentationLayer/home.php"><span class="glyphicon glyphicon-remove" style="color: red"></span> <font color="red" ><b>Exit</b> </font></a>			
</div>




	<div class="container">
        <div class="row centered-form" >
        <div class="col-md-12 ">
        	<div class="panel panel-default" style="width: 1000px; margin-left: 20px"  >
        		<div style="background-color: #4BBED5 ;height: 30px;">
			    		<label >  &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-edit"><font size="4"><b> Passenger Information</b></font></span></label>
			 			</div>
			 			<div class="panel-body">
			 			<form method="POST" action="<?php $_PHP_SELF ?>" id="myform">
						<?php for($i=0;$i<count($passArray);$i++){

						?>
			    		
							<label name="pasType"><span class="glyphicon glyphicon-user"><b>  <u><?php echo $passArray[$i]?></u></b></span></label>
			    			<div class="row" style="width: 1000px; " >
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<div class="form-group">
			    					<label for="Name">Name</label>
			                         <input type="text" name=<?php echo $i."Name"?>  id="Name" minlength="2" maxlength="30" onkeypress="return lettersOnly(event)" class="form-control input-sm" value=<?php if(isset($_SESSION["0Name"])) echo $_SESSION["0Name"] ?> >
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				   <div class="form-group">
			    				   <label for="Surname">Surname</label>
			    				   <input type="text" name=<?php echo $i."Surname"?> id="Surname" minlenght="2" maxleght="30" class="form-control input-sm" onkeypress="return lettersOnly(event)" value=<?php if(isset($_SESSION[$i."Surname"])) echo $_SESSION[$i."Surname"] ?>>
			    				   </div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				   
			    				  	<div class="form-group">
			    					<label >Gender</label><br>
			    						 <label class="radio-inline">
                                         <input type="radio" name=<?php echo $i."genderradio"?> value="F" checked> 
                                          Female
                                         </label>
                                         <label class="radio-inline">
                                         <input type="radio" name=<?php echo $i."genderradio"?> value="M"> 
                                          Male
                                         </label>
			    					</div>
			    				   
			    				</div>
			    			</div>
			    				<div class="row" style="width: 1000px ;border-bottom: 1px solid #ccc">
			    				<div class="col-xs-6 col-sm-6 col-md-4">
                            <div class="form-group">
                            <label >TC NO</label>
			    				<input type="text"  name=<?php echo $i."tc"?> id="tc" minlength="11" maxlength="11" class="form-control input-sm"  onkeypress="return isNumber(event)" value=<?php if(isset($_SESSION[$i."tc"])) echo $_SESSION[$i."tc"] ?>>
			    				<label style="font-size:12px"><font color="#B43335" >Mandatory field only for Turkish Citizens</font></label>
			    			</div>
						</div>
							<div class="col-xs-6 col-sm-6 col-md-4">
                            <div class="form-group">
			    				<label><span class="glyphicon glyphicon-calendar"></span> Birthdate 
                            <input type="date" name=<?php echo $i."Birthdate"?> id="Birthdate"  class="form-control input-sm" value=<?php if(isset($_SESSION[$i."Birthdate"])) echo $_SESSION[$i."Birthdate"] ?>>
                       
                        </label>
			    			</div>
						</div>
						</div>

			    			
			    		
			    		<?php
			    	}
			    	?>
			    		
			    		</div>
			    		<div style="background-color: #4BBED5 ;height: 30px; " >
			    		<label >  &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-phone-alt"><font size="4"><b> Contact Details</b></font></span></label>
			 			</div>
			    		<div class="panel-body">

			 			<div class="row" style="width: 1000px; " >
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<div class="form-group">
			    					<label for="conName">Name</label>
			                         <input type="text" name="conName"  id="conName" minlength="2" maxlength="30" onkeypress="return lettersOnly(event)" class="form-control input-sm" value=<?php if(isset($_SESSION["conName"])) echo $_SESSION["conName"] ?>>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				   <div class="form-group">
			    				   <label for="conSurname">Surname</label>
			    				   <input type="text" name="conSurname" id="Surname" minleght="2" maxlenght="30" class="form-control input-sm" onkeypress="return lettersOnly(event)" value=<?php if(isset($_SESSION["conSurname"])) echo $_SESSION["conSurname"] ?>>
			    				   </div>
			    				</div>
			    				</div>
			    		<div class="row" style="width: 1000px; " >
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<div class="form-group">
			    					<label for="conPhone"><span class="glyphicon glyphicon-earphone"></span> Phone</label>
			                         <input type="text" name="conPhone"  id="conPhone" minlength="11" maxlength="11" pattern="\d{11}" onkeypress="return isNumber(event)" class="form-control input-sm" value=<?php if(isset($_SESSION["conPhone"])) echo $_SESSION["conPhone"] ?> >
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    				   <div class="form-group">
			    				   <label for="conEmail"><span class="glyphicon glyphicon-envelope"></span> Email</label>
			    				   <input type="text" name="conEmail" id="conEmail" minleght="2" maxlenght="30" class="form-control input-sm" onkeypress="return lettersOnly(event)" value=<?php if(isset($_SESSION["conEmail"])) echo $_SESSION["conEmail"] ?>>
			    				   </div>
			    				</div>
			    				</div>
			    		</div>
			    		<div class="row" style="width: 1000px" >
						<div class="col-xs-6 col-sm-6 col-md-2" style="margin-left: 400px">
							<input type="button" value="Save" class="btn btn-info btn-block" onclick="subfunc()">
			    				<?php 
									if(isset($errorMeesage)) 
									{
										echo "<br>" . "<span style='color: red;'>" . $errorMeesage . "</span>";
									}
								?>
								</div>
						</div>
						</div>
						</form>
			    	
	    		
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
     function subfunc()
     {
     	var count="<?php echo $passCount ?>";
     	

     	for (var i =0; i <count; i++) 
     	{
     		var stringName=i+"Name";
     		var stringSurname=i+"Surname";
     		var stringBirthdate=i+"Birthdate";
     		var name = document.getElementsByName(stringName)[0].value;
     		var surname = document.getElementsByName(stringSurname)[0].value;
     		var brithdate = document.getElementsByName(stringBirthdate)[0].value;

     		var birth = new Date(brithdate);
			var check = new Date();
			var milliDay = 1000 * 60 * 60 * 24; // a day in milliseconds;
			var ageInDays = (check - birth) / milliDay;
			var ageInYears =  Math.floor(ageInDays / 365 );

			//alert(ageInYears);

     		var title= document.getElementsByName("pasType")[i].textContent;
     		var control="true";
    		//alert(title);
     		if(name=="" || surname=="" || brithdate=="")
     		{
     			alert("Please fill the necessary fields!!!");
     			control="false";
     			break;
     		}
     		 
     		if(title.includes("Adult") && ageInYears<12)
     		{
     			alert("Age of Adult Passenger is 12-...");
     			control="false";
     			break;
     		}
     		if(title.includes("Child") && ageInYears>12 && ageInYears<2)
     		{
     			alert("Age of Child Passenger is 2-12");
     			control="false";
     			break;
     		}
     		if(title.includes("Infant")&& ageInYears>2)
     		{
     			alert("Age of Infant Passenger is 0-2");
     			control="false";
     			break;
     		}
     	}
     		

     	
     	var conName=document.getElementsByName("conName")[0].value;
     	
     	var conSurname=document.getElementsByName("conSurname")[0].value;
     	var conPhone=document.getElementsByName("conPhone")[0].value;
     	var conEmail=document.getElementsByName("conEmail")[0].value;
     	if(conName=="" || conSurname=="" || (conPhone=="" && conEmail==""))
     	{
     		alert("Please fill the necessary fields!!!");
     	}
     	if(control=="true")
     	{
     		document.getElementById('myform').submit();
     	}
     	

     }
</script>
</html>