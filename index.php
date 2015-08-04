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
					<p>Welcome!  These websites support the creation of a database around medical practioners in Detroit from the lat 1800's to the early 1900's.  These forms are intputting information into a normalized, relational MySQL database.</p>
					<ul>
						<li><a href="./add.php">Add Physician via Form</a></li>
						<li><a href="https://docs.google.com/spreadsheets/d/1zXRnH4Xfjd2cnKLKxMOHb6OMr-5QrpZhA1ogZpii8dI/edit#gid=0">Add Physician via Spreadsheet</a></li>
					</ul>
				</div>
			</div>

		</div>

			


	</body>
	
</html>
