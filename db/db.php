<?php

require 'config.php';

// DEBUG
// print_r($_REQUEST);

// physician add
if (array_key_exists('table_name', $_REQUEST) && $_REQUEST['table_name'] == 'physician'){

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

	$lastId = $dbh->lastInsertId();
	echo $lastId;
}


// affiliation add
if (array_key_exists('add_affiliation', $_REQUEST)){

	echo "adding affiliation...";

	// add address if need be
	$address_id = handleAddress($dbh, $_REQUEST);
	
	// add place if need be
	

	// finally, add to affiliations
	$target_table_id_array = explode("|",$_REQUEST['affiliation_type_combined']);
	$target_table_id = $target_table_id_array[0];
	$target_table_name = $target_table_id_array[1];
	$stmt = $dbh->prepare("INSERT INTO affiliation ($target_table_id) VALUES (:target_table_id)");
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




// // address
// if ($_REQUEST['table_name'] == 'address') {

// 	// prepare
// 	$stmt = $dbh->prepare("INSERT INTO address (address) VALUES (:address)");
// 	$stmt->bindParam(':address', $_REQUEST['address_address']);

// 	// execute	
// 	$stmt->execute();

// }

// // hospital
// if ($_REQUEST['table_name'] == 'hospital') {

// 	// prepare
// 	$stmt = $dbh->prepare("INSERT INTO hospital (name, address_id) VALUES (:name, :address_id)");
// 	$stmt->bindParam(':name', $_REQUEST['hospital_name']);
// 	$address_id = handleAddress($dbh, $_REQUEST);
// 	$stmt->bindParam(':address_id', $address_id, PDO::PARAM_INT);

// 	// execute	
// 	$stmt->execute();

// }



?>