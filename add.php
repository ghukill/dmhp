<?php

// Detroit Medical History Project
require 'db/config.php';

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
					<p>This form is designed for quickly and easily entering information from digitized primary sources into a relational database that will serve as the underlying data and infrastructure for the project.</p>
				</div>
			</div>

			<div id="physician_entry" class="entry_form">
				<div class="row">
					<h4 id="physician_msg">Add / Locate Physician</h4>
				</div>
					

				<div class="overlay">					

					<form action="db/db.php" method="POST">
					  <div class="row">
					    <div class="six columns">					     
					      <label for="physician_auto">physician (attempts autocomplete)</label>
						  <input class="u-full-width" type="text" placeholder="start typing..." id="physician_auto" name="physician_auto">
						  <div id="physician_auto_results" class="autocomplete_results"></div>
						  <input type="hidden" name="found_physician_id" id="found_physician_id" value="NULL"></input>
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
			</div>


			


			<!-- prototype #########################################################################################################################################-->
			<div id="affiliation_entry" class="affiliation_entry">			
				<div class="row affiliation_entry">		
					<form action="db/db.php" method="POST">
						<div class="twelve columns">
							<label for="affiliation_type">Affiliation Type</label>				      
							<select class="u-full-width" id="affiliation_type" name="affiliation_type">
								<option value="NULL">select an affiliation type</option>
								<option value="home">Home</option>
								<option value="medical_school">Medical School</option>
								<option value="hospital">Hospital</option>
								<option value="company">Company</option>
							</select>
						</div>
						<div class="row">
							<div class="six columns">
								<label for="place.name">Place (attempts autocomplete)</label>
								<input class="u-full-width" type="text" placeholder="start typing..." id="place_auto" name="place_auto">
								<div id="place_auto_results" class="autocomplete_results"></div>
								<input type="hidden" name="found_place_id" id="found_place_id" value="NULL"></input>
							</div>
							<div class="six columns">
								<label for="address.address">Address (attempts autocomplete)</label>
								<input class="u-full-width" type="text" placeholder="start typing..." id="address_auto" name="address_auto">
								<div id="address_auto_results" class="autocomplete_results"></div>
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
						<input id="physician_id" type="hidden" name="physician_id" value="NULL"></input>
						<input id="add_affiliation" type="hidden" name="add_affiliation" value="1"></input>
						<input id="submit_button" class="button-primary" type="submit" value="Submit">
						<button id="another_button" class="button-primary" onclick="addAnotherAffiliation(); return false;">Add Another?</button>
					</form>
				</div>
			</div>
			<!-- prototype #########################################################################################################################################-->


			<!-- ADD AFFILS -->
			<div id="affiliation_container"></div>

		</div>


	</body>
	
</html>