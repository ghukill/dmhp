<?php

require 'config.php';

// FIRE AUTOCOMPLETE
function getDbConnection($DB_HOST,$DB_DATABASE,$DB_USERNAME,$DB_PASSWORD) {
    $db = new PDO("mysql:host=$DB_HOST;dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD, array( PDO::ATTR_PERSISTENT => false));
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    return $db;
  }

function searchForKeyword($dbh, $keyword, $table_name, $table_column) {
    $stmt = $dbh->prepare("SELECT id, $table_column FROM `$table_name` WHERE $table_column LIKE ? GROUP BY $table_column ORDER BY $table_column");

    $keyword = '%' . $keyword . '%';
    $stmt->bindParam(1, $keyword, PDO::PARAM_STR, 100);

    $isQueryOk = $stmt->execute();
  
    $results = array();
    
    if ($isQueryOk) {
      $results = $stmt->fetchAll();
    } else {
      trigger_error('Error executing statement.', E_USER_ERROR);
    }

    return $results;
}

if (!isset($_GET['keyword'])) {
 die();
}


$keyword = $_GET['keyword'];
$table_name = $_GET['table_name'];
$table_column = $_GET['table_column'];
$data = searchForKeyword($dbh, $keyword, $table_name, $table_column);
echo json_encode($data);


?>