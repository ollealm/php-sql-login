<?php

$host = "localhost";
$database = "login_nti";
$username = "root";
$password = "";

// Variabel mysqli, innehåller ett mysqli object, och använder uppgifterna till detta
$mysqli = new mysqli($host, $username, $password, $database);

// Felmeddelande om anslutningen misslyckas
if ($mysqli->connect_errno) {
  echo "Connection failed: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>