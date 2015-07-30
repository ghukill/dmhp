<?php

// config.php
$DB_HOST = 'localhost';
$DB_DATABASE = '';
$DB_USERNAME = '';
$DB_PASSWORD = '';

// file for MySQL Statement
$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD, array( PDO::ATTR_PERSISTENT => false));

?>

