<?php

require 'config.php';


// Address
/* --------------------------------------------------------------------------------------------------------------------------------------------- */
if ($_REQUEST['type'] == "address"){
  function getDbConnection($DB_HOST,$DB_DATABASE,$DB_USERNAME,$DB_PASSWORD) {
    $db = new PDO("mysql:host=$DB_HOST;dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD, array( PDO::ATTR_PERSISTENT => false));
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    return $db;
  }


  function searchForKeyword($keyword,$DB_HOST,$DB_DATABASE,$DB_USERNAME,$DB_PASSWORD) {
      $db = getDbConnection($DB_HOST,$DB_DATABASE,$DB_USERNAME,$DB_PASSWORD);
      $stmt = $db->prepare("SELECT id, address FROM `address` WHERE address LIKE ? GROUP BY address ORDER BY address");

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
}
/* --------------------------------------------------------------------------------------------------------------------------------------------- */

// Address
/* --------------------------------------------------------------------------------------------------------------------------------------------- */
if ($_REQUEST['type'] == "affiliation_name"){
   function getDbConnection($DB_HOST,$DB_DATABASE,$DB_USERNAME,$DB_PASSWORD) {
      $db = new PDO("mysql:host=$DB_HOST;dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD, array( PDO::ATTR_PERSISTENT => false));
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
      return $db;
    }


    function searchForKeyword($keyword,$DB_HOST,$DB_DATABASE,$DB_USERNAME,$DB_PASSWORD) {
        $db = getDbConnection($DB_HOST,$DB_DATABASE,$DB_USERNAME,$DB_PASSWORD);
        $target_table_name = $_REQUEST['affiliation_autocomplete_table'];
        $stmt = $db->prepare("SELECT $target_table_name.id, $target_table_name.name, address.address FROM `$target_table_name` JOIN address ON $target_table_name.address_id = address.id WHERE name LIKE ? GROUP BY name ORDER BY name");

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
}
/* --------------------------------------------------------------------------------------------------------------------------------------------- */  


?>