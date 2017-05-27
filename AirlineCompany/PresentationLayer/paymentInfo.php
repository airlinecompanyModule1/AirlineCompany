<?php

require_once("contains.php");
require_once("header.php");
require_once("../LogicLayer/PassengerManager.php");
require_once("../LogicLayer/ConnectionManager.php");

session_start();
$totalPrice=0;
if(isset( $_SESSION["totalPrice"]))
{
    $totalPrice=$_SESSION["totalPrice"];
}
if(isset($_POST["cname"]) && isset($_POST["csurname"]) && isset($_POST["cno"]) && isset($_POST["exYear"]) && isset($_POST["exMonth"]) && isset($_POST["sno"]) )
{
    $headers = array(
        "Content-Type: application/json"
        );
        // can be tested by web browser, http://md5.jsontest.com/?text=hello%20world
       $fields = array(
        "type" => "buying",
        "name" => $_POST["cname"],
        "surname" => $_POST["csurname"],
        "cardno" => $_POST["cno"],
        "security" => $_POST["sno"],
        "exdate" => $_POST["exMonth"]."-".$_POST["exYear"],
        "totalprice" => $_SESSION["totalPrice"]

        );
     $url = "http://localhost:8080/AirlineCompany/LogicLayer/WSPayment.php/?" . http_build_query($fields);
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
        $control=$obj["result"];
        if($control=="true")
        {
            if(isset($_SESSION["totalPass"]))
            {
                $total=$_SESSION["totalPass"];
                for($i=0;$i<$toal;$i++)
                {
                    if(isset($_SESSION[$i."Name"]) && isset($_SESSION[$i."Surname"]) && isset($_SESSION[$i."Gender"]) && isset($_SESSION[$i."Birthdate"]))
                    {
                        //$flag="TRUE";
                        //echo $_POST[$i."Name"];
                        $name=$_SESSION[$i."Name"] ;
                        $surname=$_SESSION[$i."Surname"] ; 
                        $gender=$_SESSION[$i."Gender"] ; 
                        $birthdate=$_SESSION[$i."Birthdate"]; 
                        $tc=NULL;
                        if(isset($_SESSION[$i."tc"]))
                        {
                            $tc=$_POST[$i."tc"];
                        }
                     
                        $newPass=new Passenger(NULL,$name,$surname,$gender,$birthdate,$tc);
                        $result=PassengerManager::insertNewPassenger($newPass);
                        if($result)
                        {

                            
                        }
                    }
                }

                if(isset($_SESSION["conName"]) && isset($_SESSION["conSurname"]) && isset($_SESSION["conPhone"]) && isset($_SESSION["conEmail"]))
                {

                    $conName = $_SESSION["conName"];
                    $conSurname = $_SESSION["conSurname"];
                    $conPhone = $_SESSION["conPhone"];
                    $conEmail= $_SESSION["conEmail"];

                    $newConn= new Connection(NULL,$conName,$conSurname,$conPhone ,$conEmail );
                    $result = ConnectionManager::insertNewConnection($newConn);

                }
        }
        else
        {
            echo "<script> alert('Please control card information !!!');</script>";
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
<head>

  <title>PAIRLINES</title>
  <link rel="shortcut icon" href="air2.png" />
</head>
<body>
<div class="container">
    <div class="row col-md-6 col-md-offset-1 custyle">
    <form method="POST" action="<?php $_PHP_SELF ?>" id="myform">
           		<div style="background-color: #4BBED5 ;">
			    		<label >  &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-plane"><font size="4"><b> Going Ticket Detail</b></font></span></label>
			 			
    <table class="table table-striped  table-bordered" id="tblGoing">

    <thead>
    
  
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
    </thead>
                <tr>
                    <td><?php if(isset( $_SESSION["goFrom"])) echo  $_SESSION["goFrom"]?></td>
                    <td><?php  if(isset( $_SESSION["goTo"])) echo  $_SESSION["goTo"]?></td>
                    <td><?php  if(isset( $_SESSION["goFrom"])) echo  $_SESSION["goFrom"]?></td>
                    <td><?php  if(isset( $_SESSION["goTime"])) echo  $_SESSION["goTime"]?></td>
                   
                    
                </tr>
    </table></div>
    <div style="background-color: #4BBED5 ; <?php if(isset( $_SESSION["flightType"]) && $_SESSION["flightType"]=="oneway") echo "display:none;"?>;" id="returnDiv">
			    		<label >  &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-plane"><font size="4"><b> Return Ticket Detail</b></font></span></label>
			 			
    <table class="table table-striped  table-bordered" id="returntbl">

    <thead>
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Date</th>
            <th>Time</th>
        </tr>
    </thead>
                <tr>
                    <td><?php if(isset( $_SESSION["returnFrom"])) echo  $_SESSION["returnFrom"]?></td>
                    <td><?php  if(isset( $_SESSION["returnTo"])) echo  $_SESSION["returnTo"]?></td>
                    <td><?php  if(isset( $_SESSION["returnFrom"])) echo  $_SESSION["returnFrom"]?></td>
                    <td><?php  if(isset( $_SESSION["returnTime"])) echo  $_SESSION["returnTime"]?></td>
                   
                    
                </tr>
    </table>
    </div>
   
    <div style="background-color: #4BBED5 ;height:30px ">
			    		<label >  &nbsp;&nbsp;&nbsp;<span class="	glyphicon glyphicon-credit-card"><font size="4"><b> Credit Card Information</b></font></span></label>	</div>
                        <div class="row">
                            
                       
			    		<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					<label for="cname">Name</label>
			                         <input type="text" name="cname" id="cname" minlength="2" maxlegth="30" onkeypress="return lettersOnly(event)" class="form-control input-sm"></div>
			                         </div>
			                         <div class="col-xs-6 col-sm-6 col-md-6">
			                         <div class="form-group">
			    				<label for="csurname">Surname</label>
			                         <input type="text" name="csurname" id="csurname" minlength="2" maxlegth="30" onkeypress="return lettersOnly(event)" class="form-control input-sm">
			    					</div>
                                     </div>
			    					</div>
                                    <div class="row"> 
                                    
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                     <div class="form-group">
                                <label for="cno">Security Number</label>
                                     <input type="text" name="sno" id="sno" minlength="3" maxlength="3" pattern="\d{3}" onkeypress="return isNumber(event)" class="form-control input-sm" >
                                    </div>
                                    </div>
			    				    
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label>Expiration Date</label><br>
                                        <select class="selectpicker" name="exMonth" >
                                        <option value='1'>1</option>
                                        <option value='2'>2</option>
                                        <option value='3'>3</option>
                                        <option value='4'>4</option>
                                        <option value='5'>5</option>
                                        <option value='6'>6</option>
                                        <option value='7'>7</option>
                                        <option value='8'>8</option>
                                        <option value='9'>9</option>
                                        <option value='10'>10</option>
                                        <option value='11'>11</option>
                                        <option value='12'>12</option>
                                        </select>

                                        <select class="selectpicker" name="exYear">
                                        <option value='2017'>2017</option>
                                        <option value='2018'>2018</option>
                                        <option value='2019'>2019</option>
                                        <option value='2020'>2020</option>
                                        <option value='2021'>2021</option>
                                        <option value='2022'>2022</option>
                                        <option value='2023'>2023</option>
                                        <option value='2024'>2024</option>
                                        </select>
                                        </div>

                                    </div>
                                
                                    </div>
			    					
                                    <div class="row"> 
                                     <div class="col-xs-6 col-sm-6 col-md-6">
                                     <div class="form-group">
                                <label for="cno">Card No</label>
                                     <input type="text" name="cno" id="cno"  maxlength="16" onkeypress="return isNumber(event)" class="form-control input-sm" pattern="\d{16}">
                                    </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group" >
                                    <br>
                                    <label for="cname"><font size="4" color="green"><?php echo "Total Price: $totalPrice $" ?></font></label>
                                    </div></div>

			    					<div class="col-xs-6 col-sm-6 col-md-2" style="margin-left: 180px">
			                     <br>
			    				
			                         <input type="button" class="btn btn-danger btn-block" value="Next" onclick="selectFunction()">
			    				
			    					</div>
                                    </div>

			    		
    <?php 
        if(isset($errormessage)) 
        {
            echo "<br>" . "<span style='color: red;'>" . $errormessage . "</span>";
        }

    ?>
   
    </form>
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
     function selectFunction()
     {

          document.getElementById('myform').submit();
     }

</script>
    </html>

