<?php

// Detroit Medical History Project
require 'db/config.php';

function populateAffilType($dbh){
	// prepare
	$stmt = $dbh->prepare("SELECT id, type FROM affiliation_type");	
	// execute	
	$stmt->execute();
	$data = $stmt->fetchAll();
	return $data;
}


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
		<script type="text/javascript" src="js/autocomplete.js"></script>

	</head>

	<body>

		<div class="container">
			
			<div class="row">
				<div class="twelve columns">
					<h2>Detroit Medical History Project</h2>
					<p>This form is dedicated to entering information from digitized primary sources into a relational database that will serve as the underlying data and infrasturcture for the project.</p>
				</div>
			</div>

			<div id="physician_entry" class="entry_form">
				<div class="overlay">

					<div class="row">
						<h4>Physician <span id="physician_msg" class="msg"></span></h4>
					</div>

					<form action="db/db.php" method="POST">
					  <div class="row">
					    <div class="six columns">
					      <label for="physician.name">Physician Name</label>
					      <input class="u-full-width" type="text" placeholder="e.g. Avia Spencer" id="physician.name" name="physician.name">
					    </div>
					    <div class="six columns">
					      <label for="physician.dob">Date of Birth (yyyy-mm-dd)</label>
					      <input class="u-full-width" type="text" placeholder="e.g. 1865-03-15" id="physician.dob" name="physician.dob">
					    </div>
					  </div>

					  <div class="row">
					    <div class="six columns">
					      <label for="physician.med_school_grad_year">Year Graduated Medical School (yyyy)</label>
					      <input class="u-full-width" type="text" placeholder="e.g. 1875" id="physician.med_school_grad_year" name="physician.med_school_grad_year">
					    </div>
					    <div class="six columns">
					      <label for="physician.med_specialty">Medical Specialty</label>
					      <input class="u-full-width" type="text" placeholder="e.g. blood letting" id="physician.med_specialty" name="physician.med_specialty">
					    </div>
					  </div>

					  <div class="row">
					    <div class="six columns">
					      <label for="physician.philosophy">Medical Philosophy</label>
					      <input class="u-full-width" type="text" placeholder="e.g. homepathy" id="physician.philosophy" name="physician.philosophy">
					    </div>
					    <div class="six columns">
					      <label for="physician.gender">Gender</label>
					      <input class="u-full-width" type="text" placeholder="'m' or 'f', not required" id="physician.gender" name="physician.gender">
					    </div>
					  </div>

					  <div class="row">
					    <div class="twelve columns">
					      <label for="physician.source">Information Source</label>
					      <input class="u-full-width" type="text" placeholder="e.g. HathiTrust (maybe URL)" id="physician.source" name="physician.source">
					    </div>
				      </div>
					    

					   <label for="physician.misc_notes">Misc. Notes</label>
					  <textarea class="u-full-width" placeholder="Any additional notes" id="physician.misc_notes" name="physician.misc_notes"></textarea>
					  
					  <input type="hidden" name="table_name" value="physician"></input>
					  <input class="button-primary" type="submit" value="Submit">

					</form>

				</div>
				<hr>
			</div>


			<!-- CURRENT AFFILS -->
			<div id="current_affiliations">

				<div class="row">
					<h4>Current Affiliations <a href="#" style="font-size:.5em;" onclick="$('.currrent_affiliations_table').fadeToggle(200); return false;">(click to view)</a></h4>
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
						    <tr>
						      <td>Hospital</td>
						      <td>Saint Mercy Jesus</td>
						      <td>33 Cass Ave., Detroit, MI 48201</td>
						      <td>1875</td>
						      <td>1890</td>
						    </tr>
						    <tr>
						      <td>Home</td>
						      <td></td>
						      <td>600 Cass Ave., Detroit, MI 48201</td>
						      <td>1875</td>
						      <td>1890</td>
						    </tr>
						  </tbody>
						</table>
					</div>
				</div>
				<hr>
			</div>

			


			<!-- ADD AFFILS -->
			<div id="add_affiliation_entry" class="entry_form">

				<div class="row">
					<div class="twelve columns">
						<h4>Add Affiliation</h4>
					</div>
				</div>

				<!-- Generic -->
				<div class="row affiliation_entry">		

					<form action="db/db.php" method="POST">
						<div class="twelve columns">
							<label for="affiliation_type_combined">Affiliation Type</label>				      
							<select class="u-full-width" id="affiliation_type_combined" name="affiliation_type_combined">
							<option value="NULL">select an affiliation type</option>
							<?php
								$data = populateAffilType($dbh);
								foreach ($data as $row){
									$id = $row['id'];
									$type = $row['type'];
									echo "<option value='$id|$type'>$type</option>";
								} 
							?>
							</select>
						</div>
						<div class="row">
							<div class="six columns">
								<label for="affiliation_name">Name (attempts autocomplete)</label>
								<input class="u-full-width" type="text" placeholder="start typing..." id="affiliation_name" name="affiliation_name">
								<div id="affiliation_name_results"></div>
								<input type="hidden" name="found_affiliation_name" id="found_affiliation_name" value="NULL"></input>
							</div>
							<div class="six columns">
								<label for="address.address">Address (attempts autocomplete)</label>
								<input class="u-full-width" type="text" placeholder="start typing..." id="address_auto" name="address_auto">
								<div id="address_auto_results"></div>
								<input type="hidden" name="found_address_id" id="found_address_id" value="NULL"></input>
							</div>
						</div>

						<div class="row">					    
							<div class="six columns">
								<label for="affiliation.date_start">Date Start</label>
								<input class="u-full-width" type="text" placeholder="e.g. 1875" id="affiliation.date_start" name="affiliation.date_start" >
							</div>
							<div class="six columns">
								<label for="affiliation.date_end">Date End</label>
								<input class="u-full-width" type="text" placeholder="e.g. 1901" id="affiliation.date_end" name="affiliation.date_end" >
							</div>
						</div>


						<label for="affiliation.misc_notes">Misc. Notes</label>
						<textarea class="u-full-width" placeholder="Any additional notes" id="affiliation.misc_notes" name="affiliation.misc_notes" ></textarea>

						<input id="physician_id" type="hidden" name="phsyician_id" value="NULL"></input>
						<input id="add_affiliation" type="hidden" name="add_affiliation" value="1"></input>
						<input class="button-primary" type="submit" value="Submit">
					</form>

				</div>

			</div>



			<!-- ADDRESS -->
			<!-- <div id="address_entry" class="entry_form">

				<div class="row">
					<h4>Address <span id="physician_msg" class="msg" ></span></h4>
				</div>

				<form action="db/db.php" method="POST">
				  <div class="row">				    
				    <div class="six columns">
				      <label for="address.address">Address String</label>
				      <input class="u-full-width" type="text" placeholder="e.g. 03-15-1865" id="address.address" name="address.address">
				    </div>
				  </div>				  				  
				  
				  <input type="hidden" name="table_name" value="address"></input>
				  <input class="button-primary" type="submit" value="Submit">

				</form>

			</div> -->


			<!-- HOSPITAL -->
			<!-- <div id="hospital_entry" class="entry_form">

				<div class="row">
					<h4>Hospital <span id="physician_msg" class="msg" ></span></h4>
				</div>

				<form action="db/db.php" method="POST">
				  <div class="row">
				    <div class="six columns">
				      <label for="hospital.name">Name</label>
				      <input class="u-full-width" type="text" placeholder="e.g. Rolling Pines Acres" id="hospital.name" name="hospital.name" >
				    </div>
				    <div class="six columns">
				      <label for="address.address">Address (attempts autocomplete)</label>
				      <input class="u-full-width" type="text" placeholder="start typing..." id="address_auto" name="address_auto">
					  <div id="results"></div>
					  <input type="hidden" name="found_address_id" id="found_address_id" value="NULL"></input>
				    </div>
				  <input type="hidden" name="table_name" value="physician"></input></div>


				  <label for="hospital.misc_notes">Misc. Notes</label>
				  <textarea class="u-full-width" placeholder="Any additional notes" id="hospital.misc_notes" name="hospital.misc_notes" ></textarea>
				  
				  <input type="hidden" name="table_name" value="hospital"></input>
				  <input class="button-primary" type="submit" value="Submit">

				</form>

			</div>
 -->
	</body>

</html>