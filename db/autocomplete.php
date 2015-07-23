<?php

require 'config.php';

// We will use PDO to execute database stuff. 
// This will return the connection to the database and set the parameter
// to tell PDO to raise errors when something bad happens
function getDbConnection($DB_HOST,$DB_DATABASE,$DB_USERNAME,$DB_PASSWORD) {
  $db = new PDO("mysql:host=$DB_HOST;dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD, array( PDO::ATTR_PERSISTENT => false));
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
  return $db;
}


// This is the 'search' function that will return all possible rows starting with the keyword sent by the user
function searchForKeyword($keyword,$DB_HOST,$DB_DATABASE,$DB_USERNAME,$DB_PASSWORD) {
    $db = getDbConnection($DB_HOST,$DB_DATABASE,$DB_USERNAME,$DB_PASSWORD);
    $stmt = $db->prepare("SELECT id, address FROM `address` WHERE address LIKE ? ORDER BY address");

    $keyword = '%' . $keyword . '%';
    $stmt->bindParam(1, $keyword, PDO::PARAM_STR, 100);

    $isQueryOk = $stmt->execute();
  
    $results = array();
    
    if ($isQueryOk) {
      $results = $stmt->fetchAll();
    } else {
      trigger_error('Error executing statement.', E_USER_ERROR);
    }

    $db = null; 

    return $results;
}

if (!isset($_GET['keyword'])) {
	die();
}

$keyword = $_GET['keyword'];
$data = searchForKeyword($keyword,$DB_HOST,$DB_DATABASE,$DB_USERNAME,$DB_PASSWORD);
echo json_encode($data);

?>