<?php
 require_once("contains.php");
 
$rdate="";
if(isset($_POST["travel_type"]) && isset($_POST["from"])&& isset($_POST["to"])&& isset($_POST["ddate"]) && isset($_POST["selAdult"]) && isset($_POST["selChild"]) && isset($_POST["selInfant"]))
    {
        if($_POST["travel_type"]=="round trip" && isset($_POST["rdate"]))
        {
            
            $rdate = $_POST["rdate"];
        }

            $type = $_POST["travel_type"];
            $from = $_POST["from"];
            $to = $_POST["to"];
            $ddate = $_POST["ddate"];
            $selAdult = $_POST["selAdult"];
            $selChild = $_POST["selChild"];
            $selInfant = $_POST["selInfant"];

         
        
        // query string for sending our text parameter
        $fields = array(
        "type" => $type,
        "from" => $from,
        "to" => $to,
        "ddate" => $ddate,
        "rdate" => $rdate,
        "selAdult" => $selAdult,
        "selChild" => $selChild,
        "selInfant" => $selInfant

        );
        $fields=http_build_query($fields);
       // print_r($fields);
        $con="Location:ticketList.php/?type=$type&from=$from&to=$to&ddate=$ddate&rdate=$rdate&selAdult=$selAdult&selChild=$selChild&selInfant=$selInfant" ;
       // echo "con:".$con;
        header("Location:ticketList.php/?$fields");
    }
    



?>
<!DOCTYPE html>
<head>
	<style type="text/css">
.kolon
 { 
    float:left; padding:0px; 
    margin-left:0px;
    margin-top:10px; 
    margin-bottom: 10px;
    margin-right: 10px;
}
</style>
</head>
<html lang="en">
<body role="document">
	<div class="container" style="background-image:url('plane.png');background-repeat:no-repeat;   background-attachment: fixed;
    background-position: center; ">
		<div class="row" style="border: 2px solid gray;
     padding-top: 40px;
    padding-right: 20px;
    padding-bottom: 40px;
    padding-left: 40px;" >
			<div class="col-md-4 column" >
				<form method="POST" action="<?php $_PHP_SELF ?>" id="myform">
					<div class="radio-inline">
					  <label>
					    <input type="radio" name="travel_type" value="oneway" checked  onclick="oneFunction()">One way
					  </label>
					</div>
					<div class="radio-inline">
						<label>
					  	<input type="radio" name="travel_type" value="roundtrip" id="roundtrip" onclick="roundFunction()">Round trip
					  </label>
					</div>
					<div class="form-group">
						<label for="from"><span class="glyphicon glyphicon-plane"></span>From</label>
						<select class="form-control" id="from" name="from">
							
							<option value="AM">Izmir Adnan Menderes Airport</option>
							<option value="IST">Istanbul Ataturk Airport</option>
							<option value="SAW">Istanbul Sabiha Gokcen Airport</option>
							<option value="ESB">Ankara Esenboga Airport</option>
						
						</select>
					</div>
					<div class="form-group">
						<label for="to"><span class="glyphicon glyphicon-plane"></span>To</label>
						<select class="form-control" id="to" name="to">
                            <option value="AM">Izmir Adnan Menderes Airport</option>
                            <option value="IST">Istanbul Ataturk Airport</option>
                            <option value="SAW">Istanbul Sabiha Gokcen Airport</option>
                            <option value="ESB">Ankara Esenboga Airport</option>
						</select>
					</div>
					
					<div class="form-group">
                        <label><span class="glyphicon glyphicon-calendar"></span> Departure Date
                        <input type="date" name="ddate" id="ddate"  class="form-control input-sm" placeholder="Departure Date">
                       
                        </label>
					</div>

					<div class="form-group" id="rdiv" >
                        <label><span class="glyphicon glyphicon-calendar"></span> Return Date
                        <input type="date" name="rdate" id="rdate" class="form-control input-sm" placeholder="Return Date" disabled="true">
                        </label>
					</div>
					
					
                    <div class="kolon">
                    	<div style="width: 60px;">
                         <div class="form-group">
                         <label for="selAdult">Adult</label>
                         <select class="form-control" id="selAdult" name="selAdult">
                         <option>0</option>
                         <option>1</option>
                         <option>2</option>
                         <option>3</option>
                         <option>4</option>
                         <option>5</option>
                         </select>
                         </div>	
                        </div>
                    </div>                  
                   
                    <div class="kolon">
                    	<div style="width: 60px;">
                         <div class="form-group">
                         <label for="selChild">Child</label>
                         <select class="form-control" id="selChild" name="selChild">
                         <option>0</option>
                         <option>1</option>
                         <option>2</option>
                         <option>3</option>
                         <option>4</option>
                         <option>5</option>
                         </select>
                         </div>	
                        </div>
                    </div>
                    <div class="kolon">
                        <div style="width: 60px;">
                         <div class="form-group">
                         <label for="sel">Infant</label>
                         <select class="form-control" id="selInfant" name="selInfant">
                         <option>0</option>
                         <option>1</option>
                         <option>2</option>
                         <option>3</option>
                         <option>4</option>
                         <option>5</option>
                         </select>
                         </div>	
                        </div>                    	
                    </div>
                    <div style="margin-left: 270px; margin-top: 100px;">
					<button type="button" id="search-flights" class="btn btn-danger" onclick="searchFunction();"> <span class="glyphicon glyphicon-search"></span>Search</button>
					</div>
				</form>
			</div>
			
		</div>
      
	</div>

<script type="text/javascript">
	function searchFunction()
    {
        var adult = document.getElementById("selAdult");
        var countAdult = adult.options[adult.selectedIndex].value;

        var child=document.getElementById("selChild");
        var countChild = child.options[child.selectedIndex].value;

        var infant=document.getElementById("selInfant");
        var countInfant=infant.options[infant.selectedIndex].value;
        
        var total=parseInt(countAdult,10)+parseInt(countChild,10);
        var dDate=document.getElementById("ddate").value;
     
        var rDate=document.getElementById("rdate").value;
        var today = new Date();
        var res = today.toISOString().slice(0,10).replace(/-/g,"-");
        var control = document.getElementById("roundtrip").checked;

        var to=document.getElementById("to");
        var toValue = to.options[to.selectedIndex].value;

        var from=document.getElementById("from");
        var fromValue = from.options[from.selectedIndex].value;



        if(toValue==fromValue)
        {
             alert("To Airport and From Airport are not same !!!");
        }
        else if(total>5 )
        {
            alert("Count of total passengers must be lower than 5 or equal !!!"+total);
        }
        else if( dDate.length==0 || (Date.parse(res) > Date.parse(dDate) || ( control==true &&Date.parse(res) > Date.parse(rDate)) ))
        {
              alert("Please choose a day after"+res);
        }
        else if(parseInt(countInfant,10)>parseInt(countAdult,10))
        {
            alert("Count of Infant passenger must be lower than count of Adult passenger or equal !!!");
        }
        else if( (dDate.length==0  || rDate.length==0) && (Date.parse(dDate) > Date.parse(rDate) && control==true))
        {
            alert("Return date  must be lower than  departure date or equal !!!");
        }
        else if(parseInt(countAdult,10)==0 && (parseInt(countInfant,10)==0 || parseInt(countChild,10)==0) )
        {
                alert("Amount of adult passenger must be more than zero !!!");
        }

        else
        {
            document.getElementById('myform').submit();
        }
    
    }

    function oneFunction()
    {
         var flag = document.getElementById("rdate");
         flag.disabled = true;
    }
    function roundFunction()
    {
         var flag = document.getElementById("rdate");
         flag.disabled = false;;
    }
</script>

</body>
</html>
