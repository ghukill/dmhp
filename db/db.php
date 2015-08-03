<?php

require 'config.php';

// physician add
if (array_key_exists('table_name', $_REQUEST) && $_REQUEST['table_name'] == 'physician'){

	// ADD PHYS
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

	// ADD MISC NOTE
	$lastId = $dbh->lastInsertId();
	echo trim($lastId);

}


// affiliation add
if (array_key_exists('add_affiliation', $_REQUEST)){

	print_r($_REQUEST);

	// data work
	$physician_id = $_REQUEST['physician_id'];
	$address_id = handleAddress($dbh, $_REQUEST);
	$place_id = handlePlace($dbh, $_REQUEST);
	echo "$physician_id / $address_id / $place_id";

	$physician_id = 11;

	// finally, add to affiliations
	$stmt = $dbh->prepare("INSERT INTO affiliation (`physician_id`, `affiliation_type`, `date_start`, `date_end`, `address_id`, `place_id`) VALUES (:physician_id, :affiliation_type, :affiliation_date_start, :affiliation_date_end, :address_id, :place_id)");
	$stmt->bindParam(':physician_id', $physician_id, PDO::PARAM_INT);
	$stmt->bindParam(':affiliation_type', $_REQUEST['affiliation_type']);
	$stmt->bindParam(':affiliation_date_start', $_REQUEST['affiliation_date_start'], PDO::PARAM_INT);
	$stmt->bindParam(':affiliation_date_end', $_REQUEST['affiliation_date_end'], PDO::PARAM_INT);
	$stmt->bindParam(':address_id', $address_id, PDO::PARAM_INT);
	$stmt->bindParam(':place_id', $place_id, PDO::PARAM_INT);

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


function handlePlace($dbh, $args){

	// if found_address_id is not NULL, add address_auto
	if (array_key_exists('found_place_id', $args) && $args['found_place_id'] != 'NULL'){
		return $args['found_place_id'];
	}

	// elseif, if address_auto not NULL, add to address table
	else {
		// prepare
		$stmt = $dbh->prepare("INSERT INTO place (name) VALUES (:name)");
		$stmt->bindParam(':name', $args['place_auto']);
		// execute	
		$stmt->execute();
		$lastId = $dbh->lastInsertId();
		return $lastId;
	}

}


function addNote($dhb, $args){
	echo "tron";
}







?>