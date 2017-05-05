<?php
 require_once("PresentationLayer/contains.php");
?>
<!DOCTYPE html>
<head>
	<style type="text/css">
.kolon { float:left; padding:10px; margin:10px; }
</style>
</head>
<html lang="en">
<body role="document">
	<div class="container">
		<div class="row">
			<div class="col-md-4 column">
				<form method="POST" action="<?php $_PHP_SELF ?>">
					<div class="radio-inline">
					  <label>
					    <input type="radio" name="travel_type" value="oneway" checked>One way
					  </label>
					</div>
					<div class="radio-inline">
						<label>
					  	<input type="radio" name="travel_type" value="roundtrip">Round trip
					  </label>
					</div>
					<div class="form-group">
						<label for="from"><span class="glyphicon glyphicon-plane"></span>From</label>
						<select class="form-control" id="from">
							<option></option>
							<option value="BOM">Mumbai - BOM</option>
							<option value="DEL">Delhi - DEL</option>
							<option value="BLR">Bangalore - BLR</option>
							<option value="PUN">Pune - PUN</option>
							<option value="KOL">Kolkatta - KOL</option>
						</select>
					</div>
					<div class="form-group">
						<label for="to"><span class="glyphicon glyphicon-plane"></span>To</label>
						<select class="form-control" id="to">
							<option></option>
							<option value="BOM">Mumbai - BOM</option>
							<option value="DEL">Delhi - DEL</option>
							<option value="BLR">Bangalore - BLR</option>
							<option value="PUN">Pune - PUN</option>
							<option value="KOL">Kolkatta - KOL</option>
						</select>
					</div>
					
					<div class="form-group">
					   <label for="datepickerDeparture">Departure Date</label>
						<div class='input-group date' id='datepickerDeparture'>
                        <input type='text' class="form-control"  />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                       </span>
                       </div>
					</div>

					<div class="form-group">
					   <label for="datepickerReturn">Return Date</label>
						<div class='input-group date' id='datepickerReturn'>
                        <input type='text' class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                       </span>
                       </div>
					</div>
					
					<div>
                    <div class="kolon">
                    	<div style="width: 60px;">
                         <div class="form-group">
                         <label for="selAdult">Adult</label>
                         <select class="form-control" id="selAdult" >
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
                         <select class="form-control" id="selChild" >
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
                         <select class="form-control" id="selInfant" >
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
                    <div style="margin-left: 270px; ">
					<button type="button" id="search-flights" class="btn btn-danger" > <span class="glyphicon glyphicon-search"></span>Search</button>
					</div>
				</form>
			</div>
			
		</div>
	</div>

<script type="text/javascript">
	FlightSearch.init();
</script>
          <script type="text/javascript">
            $(function () {
                $('#datepickerDeparture').datetimepicker();
                $('#datepickerReturn').datetimepicker();
            });
        </script>
</body>
</html>
