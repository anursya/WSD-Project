<?php 
	require_once 'db.php';
	$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	$sql = "SELECT * FROM incident_type";
	$result = $conn->query($sql);
	$incidentTypes = [];
	while ($row = $result->fetch_assoc()) {
		$id = $row['incident_type_id'];
		$type = $row['incident_type_desc'];
		$incidentType = ["id" => $id, "type" => $type];
		array_push($incidentTypes, $incidentType);
	}
	$conn->close();
?>

<script type="text/javascript">
	function validateForm()
	{
		var x=document.forms["frmLogCall"]["callerName"].value;
		+if (x==null || x=="")
		{
			alert("Caller Name is required.");
			return false;
		}
	}
</script>

<!doctype html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>Log Call</title>
			<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
		</head>
		<body>
			<div class="container" style="width: 80%">
<!-- Use php require_once expression to include header image and navigation bar from nav.php -->
	<?php require_once 'nav.php' ?>

<!-- Create section container to place web form -->
	<section style="margin-top:20px">

<!-- Create web form with Caller Name, Contact number, Location of Incident, Type of Incident, Description of Incident input fields-->	
	<form action="dispatch.php" method="post">

<!-- Row for Caller Name label and textbox input-->
<div class="form-group row">
 	<label for="callerName" class="col-sm-4 col-form-label">Caller's Name</label>
	<div class="col-sm-8">
	<input type="text" class="form-control" id="callerName" name="callerName" required pattern="[A-Za-z]{1,20}" title="Caller Name must contain alphabet characters only.">
	</div>
</div><br>

<!-- Row for Contact No label and textbox input-->
<div class="form-group row">
	<label for="contactNo" class="col-lg-4 col-form-label">Contact Number (Required)</label>

	<div class="col-lg-8">
	<input type="text" class="form-control" id="contactNo" name="contactNo" required pattern="[0-9]{8}" title="Contact number must be 8 digits.">
	</div>
</div><br>

<!-- Row for Location of Incident label and textbox input-->
 <div class="form-group row">
	<label for="locationofIncident" class="col-lg-4 col-form-label">Location of Incident (Required)</label>
	<div class="col-lg-8">
	<input type="text" class="form-control" id="locationofIncident" name="locationofIncident" required title="Location of Incident is required.">
 	</div>
</div><br>

<!-- Row for Type of Incident label and drop down input-->
<div class="form-group row">
	<label for="typeofIncident" class="col-sm-4 col-form-label">Type of Incident (Required)</label>
	<div class="col-lg-8">
	<select id="typeofIncident" class="form-control" name="typeofIncident" title="Please select Type of Incident." required>
		<option value="">Select</option>
			<?php 
			/*using for loop to retrieve the data from array var incidentType*/
			for ($i = 0;$i < count($incidentTypes);$i++)
			{
				$incidentType = $incidentTypes[$i];
				echo '<option value="' . $incidentType['id'] . '">' . $incidentType['type'] . '</option>';
			}
				
			?>
	</select>
	</div>
</div>

<br>

<!-- Row for Description of Incident label and large textbox input-->
<div class="form-group row">
	<label for="descriptionofIncident" class="col-sm-4 col-form-label">Description of Incident (Required)</label>
	<div class="col-sm-8">
	<textarea class="form-control" rows="5" id="descriptionofIncident" name="descriptionofIncident" required title="Description of Incident is required."></textarea>
	</div>
</div><br>

<div class="form-group row">
	<div class="col-sm-4"></div>
	<div class="col-sm-8" style="text-align:center">
		<input class="btn btn-primary" name="btnProcessCall" type="submit" value="Process Call">
		<input class="btn btn-primary" name="btnReset" type="reset" value="Reset">
	</div>
</div><br>
<!--end of web form-->
</form>
<!--end of section-->
</section>
	<footer class="page-footer font-small blue pt-4 footer-copyright text-center py-3">&copy; 2022 Copyright
	</footer>
</div>

<script type="text/javascript" src="js/jquery-3.5.0.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
		</body>
	</html>