<?php
session_start();
require_once("contains.php");
if(isset($_SESSION['loginMember']))
{
  require_once("memberHeader.php");
}
else
{
  require_once("header.php");
}


//require_once("../LogicLayer/TicketInformation.php");
/*$json_string = 'tickets.json';
$errormessage="";


//result post ile gelecek search ekranından sonra burada decode edilip gerisi aynı

$jsondata = file_get_contents($json_string);
$obj = json_decode($jsondata,true);*/

#print_r($obj);
#echo "content:".$obj["Tickets"][0]["id"];
#echo "count".count($obj["Tickets2"]);
#echo "type:".$obj["type"];

#echo "elma";
 
$obj="";
$flightType="";
$totalPassenger=0;


if(isset($_GET["type"])&& isset($_GET["from"]) && isset($_GET["to"])&&isset($_GET["ddate"])&&isset($_GET["selAdult"])&& isset($_GET["selChild"])&& isset($_GET["selInfant"])&& isset($_GET["rdate"]))
{

    
    
     // prepare GET query
       $headers = array(
        "Content-Type: application/json"
        );
        // can be tested by web browser, http://md5.jsontest.com/?text=hello%20world
       $fields = array(
        "type" => $_GET["type"],
        "from" => $_GET["from"],
        "to" => $_GET["to"],
        "ddate" => $_GET["ddate"],
        "rdate" => $_GET["rdate"],

        "selAdult" => $_GET["selAdult"],
        "selChild" => $_GET["selChild"],
        "selInfant" => $_GET["selInfant"]

        );
    
       $_SESSION['selAdult'] =$_GET["selAdult"];
       $_SESSION['selChild'] =$_GET["selChild"];
       $_SESSION['selInfant'] =$_GET["selInfant"];
       $totalPassenger=$_GET["selAdult"]+$_GET["selChild"];
       //echo $totalPassenger;
       $_SESSION["totalPassenger"]= $totalPassenger;
        $url = "http://localhost:8080/AirlineCompany/LogicLayer/WSTicket.php/?" . http_build_query($fields);
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
        $flightType=$obj["type"];
        $_SESSION["flightType"] =$flightType;
         //echo "type:".$flightType;
         
}

else if(isset($_GET["goID"] ))
{

       
        
        $_SESSION["goID"]=$_GET["goID"];
        $_SESSION["goFrom"]=$_GET["goFrom"];
        $_SESSION["goTo"]=$_GET["goTo"];
        $_SESSION["goTime"]=$_GET["goTime"];
        $_SESSION["goPrice"]=$_GET["goPrice"];
        $_SESSION["goDate"]=$_GET["goDate"];
       
        $multiple=$_GET["goPrice"]/3;
        $totalPriceGoing= $_SESSION["totalPassenger"] * $_GET["goPrice"]+ $_SESSION['selInfant']*$multiple;
        $totalPriceReturn=0;
        //echo $_GET["goPrice"];
        $flightType=$_SESSION["flightType"];
    if($flightType=="roundtrip")

    {
        //echo "elma:".$_GET["returnPrice"];
        $multiple=$_GET["returnPrice"]/3;
        $totalPriceReturn=$_SESSION["totalPassenger"]*$_GET["returnPrice"]+$_SESSION['selInfant']*$multiple;
         $_SESSION["returnID"]=$_GET["returnID"];
         $_SESSION["returnFrom"]=$_GET["returnFrom"];
         $_SESSION["returnTo"]=$_GET["returnTo"];
         $_SESSION["returnTime"]=$_GET["returnTime"];
         $_SESSION["returnPrice"]=$_GET["returnPrice"];
         $_SESSION["returnDate"]=$_GET["returnDate"];
        
    }
    //echo $flightType;
   // echo "going:".$totalPriceGoing;
    $price=$totalPriceGoing+$totalPriceReturn;
    $price=number_format((float)$price, 2, '.', '');
    $_SESSION["totalPrice"]=$price;
    header("Location:http://localhost:8080/AirlineCompany/PresentationLayer/passengerInfo.php");
    
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


</head>
<body >

<div class="container" >

    <div class="row col-md-6 col-md-offset-1 custyle">
    <form method="POST" action="<?php $_PHP_SELF ?>" id="myform">
    <h2 style="text-align: center">Ticket List(<?php echo $flightType ?>)</h2>
    <table class="table table-striped custab" id="tblGoing">
    <h2 style="text-align: center">Going Tickets</h2>
    <thead>
    
        <tr>
            <th>ID</th>
            <th>From</th>
            <th>To</th>
            <th>Date</th>
            <th>Time</th>
            <th>Price</th>  
            <th>Select</th>
        </tr>
    </thead>
            <?php           
                for($i = 0; $i < count($obj[0]["TicketGoing"]); $i++) {
             ?>
                <tr>
                    <td><?php echo $obj[0]["TicketGoing"][$i]["id"] ?></td>
                    <td><?php echo $obj[0]["TicketGoing"][$i]["from"]?></td>
                    <td><?php echo $obj[0]["TicketGoing"][$i]["to"] ?></td>
                    <td><?php echo $obj[0]["TicketGoing"][$i]["date"] ?></td>
                    <td><?php echo $obj[0]["TicketGoing"][$i]["time"] ?></td>
                    <td><?php echo $obj[0]["TicketGoing"][$i]["price"] ?></td>
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
    <h2 style="text-align: center">Return Tickets</h2>
    <table class="table table-striped custab" id="tblReturn">
    <thead>
    
        <tr>
            <th>ID</th>
            <th>From</th>
            <th>To</th>
            <th>Date</th>
            <th>Time</th>
            <th>Price</th>  
            <th>Select</th>
        </tr>
    </thead>
            <?php           
                for($i = 0; $i < count($obj[1]["TicketReturn"]); $i++) {
             ?>
                <tr>
                    <td><?php echo $obj[1]["TicketReturn"][$i]["id"] ?></td>
                    <td><?php echo $obj[1]["TicketReturn"][$i]["from"]?></td>
                    <td><?php echo $obj[1]["TicketReturn"][$i]["to"] ?></td>
                    <td><?php echo $obj[1]["TicketReturn"][$i]["date"] ?></td>
                    <td><?php echo $obj[1]["TicketReturn"][$i]["time"] ?></td>
                    <td><?php echo $obj[1]["TicketReturn"][$i]["price"] ?></td>
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
    <button type="button" id="search-flights" class="btn btn-danger" onclick="bttnSelectFunction()"> Select</button>
    </div>
    </div>
  
        
        
</div>
</body>
<script type="text/javascript">
    

    var goingId;
    var goingFrom;
    var goingTo;
    var goingTime;
    var goingPrice;
    var goingDate;

    var returnId;
    var returnFrom;
    var returnTo;
    var returnTime;
    var returnPrice;
    var returnDate;
    var type= '<?php echo $flightType ?>';
    var i=0;
    var iReturn=0;
    function selectGoingFunction(row)
    {
         /*document.getElementById('flagGoing').style.display="block";*/
         i=row.parentNode.parentNode.rowIndex;
         b=row.parentNode.parentNode.rowIndex;
         var x=document.getElementById('tblGoing');
         // deep clone the targeted row
         goingId = x.rows[i].cells[0].innerHTML;
         goingFrom=x.rows[i].cells[1].innerHTML;
         goingTo=x.rows[i].cells[2].innerHTML;
         goingDate=x.rows[i].cells[3].innerHTML;
         goingTime=x.rows[i].cells[4].innerHTML;
         goingPrice=x.rows[i].cells[5].innerHTML;
        
         if(type=="roundtrip")
         {

            document.getElementById('myform2').style.display="block";
      
         }
         //document.getElementById('flagGoing').value=goingId;
         //document.getElementById('flagGoing').style.display="block";
        
    }
     function selectReturnFunction(row)
    {
         iReturn=row.parentNode.parentNode.rowIndex;
         c=row.parentNode.parentNode.rowIndex;
         var x=document.getElementById('tblReturn');
         // deep clone the targeted row
         returnId = x.rows[iReturn].cells[0].innerHTML;
         returnFrom=x.rows[iReturn].cells[1].innerHTML;
         returnTo=x.rows[iReturn].cells[2].innerHTML;
         returnDate=x.rows[iReturn].cells[3].innerHTML;
         returnTime=x.rows[iReturn].cells[4].innerHTML;
         returnPrice=x.rows[iReturn].cells[5].innerHTML;
       

        
    }
    function bttnSelectFunction()
    {
               if(type=="oneway")
                {
                    if(i!=0)
                    {

                         window.location.href="http://localhost:8080/AirlineCompany/PresentationLayer/ticketList.php/?goID=  "+goingId+"&goFrom="+goingFrom+"&goTo="+goingTo+"&goTime="+goingTime+"&goPrice="+goingPrice+"&goDate="+goingDate;                        
                    }
                    else
                    {
                        alert("Please choose ticket !!!");
                    }

                }
                else if(type=="roundtrip")
                {

                    if(i!=0 && iReturn!=0)
                    {
                        
                        
                       window.location.href="http://localhost:8080/AirlineCompany/PresentationLayer/ticketList.php/?goID="+goingId+"&goFrom="+goingFrom+"&goTo="+goingTo+"&goTime="+goingTime+"&goPrice="+goingPrice+"&returnID="+returnId+"&returnFrom="+returnFrom+"&returnTo="+returnTo+"&returnTime="+returnTime+"&returnPrice= "+returnPrice+"&returnDate="+returnDate+"&goDate="+goingDate;
                    }
                    else
                    {
                        alert("Please choose ticket !!!");
                    }
                }
           

    }

</script>

</html>