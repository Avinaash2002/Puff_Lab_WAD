<?php

$servername = "localhost";
$username = "puff3so19_user";
$password = "2(*1rCT-Nd9oiWfk";
$dbname = "puff03lab#wad";

//create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
global $conn;

?>