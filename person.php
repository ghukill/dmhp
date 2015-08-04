<?php

// Detroit Medical History Project
require 'db/config.php';

$physician_id = $_REQUEST['id'];

// get physician info
$stmt = $dbh->prepare("SELECT * FROM `physician` WHERE id = :physician_id");
$stmt->bindParam(":physician_id", $physician_id, PDO::PARAM_INT);
$isQueryOk = $stmt->execute();
$results = array();
if ($isQueryOk) {
  $results = $stmt->fetchAll();
} else {
  trigger_error('Error executing statement.', E_USER_ERROR);
}
$person_array = $results[0];
// print_r($person_array);


// get affiliations
$stmt = $dbh->prepare("SELECT affiliation.affiliation_type, affiliation.date_start, affiliation.date_end, place.name, address.address
FROM affiliation
	INNER JOIN address
		ON address.id = affiliation.address_id
	INNER JOIN place
		ON place.id = affiliation.place_id
WHERE affiliation.physician_id = :physician_id");
$stmt->bindParam(":physician_id", $physician_id, PDO::PARAM_INT);
$isQueryOk = $stmt->execute();
$results = array();
if ($isQueryOk) {
  $results = $stmt->fetchAll();
} else {
  trigger_error('Error executing statement.', E_USER_ERROR);
}
$affiliations_array = $results;
// print_r($affiliations_array);

?>

<html>
	
	<head>
		<!--skeleton css-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css">
		<!--jquery-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<!--jquery forms-->
		<script src="http://malsup.github.com/jquery.form.js"></script>
		<!--local css-->
		<link rel="stylesheet" href="css/style.css">
		<!--local js-->
		<script type="text/javascript" src="js/main.js"></script>

	</head>

	<body>

		<div class="container">

			<div class="row">
				<div class="twelve columns">
					<a href="."><h2>Detroit Medical History Project</h2></a>
					<p>This page is designed to view and edit information already entered into the database.</p>
				</div>
			</div>

			<div class="row">
				<div class="twelve columns">
					<h4><?php echo $person_array['name']; ?></h4>
				</div>

				<div class="row">
					<h5 id="physician_msg">Edit Physician <span style="font-size:.5em;">(<a href="#" onclick="$('#physician_entry').fadeToggle(); return false;">click to toggle</a>)</span></h5>
				</div>

				<div id="physician_entry" class="entry_form hidden">

					<div class="overlay">					

						<form action="db/db.php" method="POST">
						  <input type="hidden" name="found_physician_id" id="found_physician_id" value="<?php echo $physician_id; ?>"></input>

						  <div class="row">	
						  	<div class="six columns">
							  <label for="physician_auto">physician name</label>
							  <input class="u-full-width" type="text" placeholder="start typing..." id="physician_auto" name="physician_auto" value="<?php echo $person_array['name']; ?>">
						    </div>
						    <div class="six columns">
						      <label for="physician.dob">Date of Birth (yyyy-mm-dd)</label>
						      <input class="u-full-width" type="text" placeholder="e.g. 1865-03-15" id="physician.dob" name="physician.dob" value="<?php echo $person_array['dob']; ?>">
						    </div>
						  </div>

						  <div class="row">
						    <div class="six columns">
						      <label for="physician.med_school_grad_year">Year Graduated Medical School (yyyy)</label>
						      <input class="u-full-width" type="text" placeholder="e.g. 1875" id="physician.med_school_grad_year" name="physician.med_school_grad_year" value="<?php echo $person_array['med_school_grad_year']; ?>">
						    </div>
						    <div class="six columns">
						      <label for="physician.med_specialty">Medical Specialty</label>
						      <input class="u-full-width" type="text" placeholder="e.g. blood letting" id="physician.med_specialty" name="physician.med_specialty" value="<?php echo $person_array['med_specialty']; ?>">
						    </div>
						  </div>

						  <div class="row">
						    <div class="six columns">
						      <label for="physician.philosophy">Medical Philosophy</label>
						      <input class="u-full-width" type="text" placeholder="e.g. homepathy" id="physician.philosophy" name="physician.philosophy" value="<?php echo $person_array['philosophy']; ?>">
						    </div>
						    <div class="six columns">
						      <label for="physician.gender">Gender</label>
						      <input class="u-full-width" type="text" placeholder="'m' or 'f', not required" id="physician.gender" name="physician.gender" value="<?php echo $person_array['gender']; ?>">
						    </div>
						  </div>

						  <div class="row">
						    <div class="twelve columns">
						      <label for="physician.source">Information Source</label>
						      <input class="u-full-width" type="text" placeholder="e.g. HathiTrust (maybe URL)" id="physician.source" name="physician.source" value="<?php echo $person_array['source']; ?>">
						    </div>
					      </div>
						    

						   <label for="physician.misc_notes">Add Misc. Notes</label>
						  <textarea class="u-full-width" placeholder="Any additional notes" id="physician.misc_notes" name="physician.misc_notes"></textarea>
						  
						  <input type="hidden" name="table_name" value="physician_update"></input>
						  <input class="button-primary" type="submit" value="Submit">

						</form>

					</div>
				</div>
			</div>

			<!-- CURRENT AFFILS -->
			<div id="current_affiliations">

				<div class="row">
					<h5>Current Affiliations <a href="#" style="font-size:.5em;" onclick="$('.currrent_affiliations_table').fadeToggle(200); return false;">(click to toggle)</a></h5>
				</div>

				<div class="row currrent_affiliations_table">
					<div class="twelve columns">
						<table class="u-full-width">
						  <thead>
						    <tr>
						      <th>Type</th>
						      <th>Name</th>
						      <th>Address</th>
						      <th>Date Start</th>
						      <th>Date End</th>
						    </tr>
						  </thead>
						  <tbody>
						    <?php
						    	// loop through affiliations here
						    	foreach ($affiliations_array as $affiliation){
						    		echo "<tr>";
							    		echo "<td>{$affiliation['affiliation_type']}</td>";
							    		echo "<td>{$affiliation['name']}</td>";
							    		echo "<td>{$affiliation['address']}</td>";
							    		echo "<td>{$affiliation['date_start']}</td>";
							    		echo "<td>{$affiliation['date_end']}</td>";
						    		echo "</tr>";
						    	}
						    ?>
						  </tbody>
						</table>
					</div>
				</div>

			</div>

			<div class="map">
				<div class="row">
					<div class="twelve columns">
						<h5>Map of Affiliations <a href="#" style="font-size:.5em;" onclick="$('#map_container').fadeToggle(200); return false;">(click to toggle)</a></h5>
					</div>
				</div>
				<div id="map_container" class="row">
					<div class="twelve columns">
						<p>Map here...</p>
					</div>
				</div>
			</div>


			
		</div>	


	</body>
	<script type="text/javascript">
		var update_physician = true; //prevents affiliation creation and physician setting
	</script>
	
</html>