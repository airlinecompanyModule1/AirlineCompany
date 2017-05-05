<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Flight search - Thoughtworks</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Client side flight searching application">
  <meta name="author" content="Bhavesh Furia - 8Rays Technosoft">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="Styles/css/bootstrap.min.css" rel="stylesheet">
	<link href="Styles/css/style.css" rel="stylesheet">
	<link href="Styles/js/select/select2.css" rel="stylesheet">
	<link href="Styles/js/select/select2-bootstrap.css" rel="stylesheet">
	<link href="Styles/css/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
	<link href="Styles/css/jquery.datetimepicker.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->
  
  <!--Js-->
	<script type="text/javascript" src="Styles/js/jquery.min.js"></script>
	<script type="text/javascript" src="Styles/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="Styles/js/underscore.js"></script>
	<script type="text/javascript" src="Styles/js/select/select2.min.js"></script>
	<script type="text/javascript" src="Styles/js/jquery-ui-1.10.4.custom.min.js"></script>
	<script type="text/javascript" src="Styles/js/jquery.datetimepicker.js"></script>
  <script type="text/javascript" src="Styles/js/linq/jquery.linq.min.js"></script>
  <script type="text/javascript" src="Styles/js/linq/linq.min.js"></script>
  <script type="text/javascript" src="Styles/js/date.js"></script>

  <!--App related JS-->
  <script type="text/javascript" src="js/flightClass.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>

</head>

<body role="document">
<nav class="navbar navbar-inverse" style="background-color:rgb(0,102,102); border-color:rgb(0,102,102);">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
      </li>
      <li><a href="#">Page 2</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-4 column">
				<form role="form">
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
						<label for="from">From</label>
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
						<label for="to">To</label>
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
						<label for="ondate">On</label><input type="text" class="form-control" id="ondate" required>
					</div>
					<div class="form-group">
						<label for="returndate">Return</label><input type="text" class="form-control" id="returndate">
					</div>
					<div class="form-group">
						<label for="returndate">Price</label>
						<span id="amount"></span>
						<div id="slider-range"></div>
					</div>
					<button type="button" id="search-flights" class="btn btn-default">Submit</button>
				</form>
			</div>
			<div class="col-md-8 column">
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Number</th>
							<th>Dep.</th>
							<th>Arr.</th>
							<th>Price</th>
							<th>Dep. Time</th>
						</tr>
					</thead>
					<tbody id="flights_info"></tbody>
				</table>
			</div>
		</div>
	</div>
<!--
Template for underscore but couldnt make it work :(
<script type="text/template" id="flights_template">
	<% _.each(flights, function(flight){ %>
		<tr>
			<td><%= flight.name %></td>
			<td><%= flight.from %></td>
			<td><%= flight.to %></td>
			<td><%= flight.price %></td>
		</tr>
	<% }%>	
</script>
-->
<script type="text/javascript">
	FlightSearch.init();
</script>
</body>
</html>
