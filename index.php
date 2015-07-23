<?php

// Detroit Medical History Project

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

			<div class="row">
				<div class="twelve columns">					
					<ul class="inline">
						<li><button onclick="$('#physician_entry').fadeToggle();">Physician</button></li>
						<li><button onclick="$('#address_entry').fadeToggle();">Address</button></li>
						<li><button onclick="$('#hospital_entry').fadeToggle();">Hospital</button></li>
					</ul>
				</div>
			</div>


			<div id="physician_entry" class="entry_form">

				<div class="row">
					<h4>Physician <span id="physician_msg" class="msg" ></span></h4>
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

			<!-- ADDRESS -->
			<div id="address_entry" class="entry_form">

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

			</div>


			<!-- HOSPITAL -->
			<div id="hospital_entry" class="entry_form">

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

	</body>

</html>