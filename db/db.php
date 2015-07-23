<?php

require 'config.php';

// file for MySQL Statement
$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD, array( PDO::ATTR_PERSISTENT => false));


// DEBUG
print_r($_REQUEST);



// react to 'table_name' field and act accordingly

// address
if ($_REQUEST['table_name'] == 'physician') {

	echo "FIRING!";

	// prepare
	$stmt = $dbh->prepare("INSERT INTO physician (name, dob, med_school_grad_year, med_specialty, philosophy, gender, source) VALUES (:name, :dob, :med_school_grad_year, :med_specialty, :philosophy, :gender, :source)");
	$stmt->bindParam(':name', $_REQUEST['physician_name']);
	$stmt->bindParam(':dob', $_REQUEST['physician_dob']);
	$stmt->bindParam(':med_school_grad_year', $_REQUEST['physician_med_school_grad_year'], PDO::PARAM_INT);
	$stmt->bindParam(':med_specialty', $_REQUEST['physician_med_specialty']);
	$stmt->bindParam(':philosophy', $_REQUEST['physician_philosophy']);
	$stmt->bindParam(':gender', $_REQUEST['physician_gender']);
	$stmt->bindParam(':source', $_REQUEST['physician_source']);

	// execute	
	$stmt->execute();

}

// address
if ($_REQUEST['table_name'] == 'address') {

	// prepare
	$stmt = $dbh->prepare("INSERT INTO address (address) VALUES (:address)");
	$stmt->bindParam(':address', $_REQUEST['address_address']);

	// execute	
	$stmt->execute();

}

// hospital
if ($_REQUEST['table_name'] == 'hospital') {

	// prepare
	$stmt = $dbh->prepare("INSERT INTO hospital (name, address_id) VALUES (:name, :address_id)");
	$stmt->bindParam(':name', $_REQUEST['hospital_name']);
	$address_id = handleAddress($dbh, $_REQUEST);
	$stmt->bindParam(':address_id', $address_id, PDO::PARAM_INT);

	// execute	
	$stmt->execute();

}


function handleAddress($dbh, $args){

	// if found_address_id is not NULL, add address_auto
	if (array_key_exists('found_address_id', $args) && $args['found_address_id'] != 'NULL'){
		return $args['found_address_id'];
	}

	// elseif, if address_auto not NULL, add to address table
	else {
		// prepare
		$stmt = $dbh->prepare("INSERT INTO address (address) VALUES (:address)");
		$stmt->bindParam(':address', $args['address_auto']);
		// execute	
		$stmt->execute();
		$lastId = $dbh->lastInsertId();
		return $lastId;
	}


}




?>